<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
require_once("dbconnect.php");

$inicio = $_GET["dataInicio"];
$fim = $_GET["dataFim"];


$query = "SELECT dataMedicao, idEstacao, total FROM `dadospluv` WHERE (`dataMedicao` between ? and ?) and idEstacao = ?";

$query2 = "SELECT nome, municipio, latitude, longitude, altitude FROM `estacao` WHERE ".$_GET["id"]." = idEstacao";

$db = dbconnect();

if ($stmt2 = $db->prepare($query2)){
	
	$stmt2->execute();

	$result2 = $stmt2->get_result();

}

if ($stmt = $db->prepare($query)){

	$stmt->bind_param("ssi", $inicio, $fim, $_GET["id"]);

	$stmt->execute();

	$result = $stmt->get_result();

	/* Excluir da pasta tmp os arquivos mais antigos do que 1h */
	$data = strtotime('-1 hour', time());
	foreach(glob('./relatorioCurado/*.csv') as $file)
	{
		$filetime = filemtime($file);
		if( $data > $filetime )
		{
			unlink($file);
		}
	}
	
	$arquivo= "./relatorioCurado/dadoscurados_".$_GET["id"]."_".$inicio."_".$fim.".csv";

	$handler = fopen($arquivo,'w');

	if($result->num_rows===0){
		fwrite($handler,"Nenhum dado.\r\n");
	}
	else{

		fwrite($handler,"Periodo de solicitacao:\r\n");

		fwrite($handler, "".$inicio." a ".$fim."\r\n\n\n");

		fwrite($handler, "Estacao;Municipio;Latitude;Longitude;Altitude\r\n" );

		while ($dados2 = $result2->fetch_assoc()) {
			fwrite($handler,$dados2['nome'].";".$dados2['municipio'].";".$dados2['latitude'].";".$dados2['longitude'].";".$dados2['altitude']."\r\n\n\n" );
		}

		fwrite($handler,"ID Estacao;Data Medicao;Precipitacao Total\r\n");

		while($dados = $result->fetch_assoc()){
			fwrite($handler,$dados['idEstacao'].";".$dados['dataMedicao'].";".$dados['total']."\r\n");
		}
	}

	fclose($handler);

	header('Content-Description: File Transfer');
	header('Content-Disposition: attachment; filename="'.$arquivo.'"');
	header('Content-Type: application/octet-stream');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: ' . filesize($arquivo));
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Expires: 0');
	readfile($arquivo);

}

?>