<?php
require_once("dbconnect.php");
error_reporting(E_ALL ^ E_DEPRECATED);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>ClimMapView</title>
	<!--- Bootstrap--->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- Custom styles for this template -->
	<link href="css/modern-business.css" rel="stylesheet">

	<style type="text/css">
		#link{
			color: #2E64FE;
			text-decoration:none;
		}

		#link:hover{
			color: black;
		}
	</style>


</head>

<body>
	<!-- Navigation -->
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
			<div class="container">
				<a class="navbar-brand" href="index.php"><img src="icon/nuvem-azul.png" width="5%" height="10%" title="ClimMapView" />ClimMapView</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="index.php">Estações Meteorológicas</a>
						</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<br/>
		<br/>
		<!-- Page Heading/Breadcrumbs -->
		<h1 class="mt-4 mb-3">DOWNLOAD
		</h1>

		<!-- Project One -->
		<div class="row">

			<?php
			$_GET["id"];
			dbconnect();
			$db = dbconnect();
			$query = "SELECT nome, inicio, fim FROM estacao WHERE ".$_GET["id"]." = idEstacao";
			$resultado = mysql_query($query);
			// var_dump($resultado);


			?>

			<form method="get" action="downloadBrutoFinal.php">

				<?php echo '<input type="hidden" name="id" value="'.$_GET["id"].'">'; ?>
				<br><br>

				<b><h5><u>DADOS BRUTOS</u></h5></b><br>

				<b>Nome:</b> <?php echo $nome; ?><br>
				<b>Período Início:</b> <?php echo $diaInicio."/".$mesInicio."/".$anoInicio; ?> <br>
				<b>Período Fim:</b> <?php echo $diaFim."/".$mesFim."/".$anoFim; ?> <br><br>

				<br>
				<b>Período Solicitado:</b><br> <br>
				<table>
					<tr>
						<td><b>Início: </b></td>
						<td><input type="date" name="dataInicio" class="form-control" required=""></td>
					</tr>
					<tr>
						<td><b>Fim: </b></td>
						<td><input type="date" name="dataFim" class="form-control" required=""></td>
					</table>

					<br>

					<br><br><input type="submit" value="Download" class="btn btn-primary">

				</form>
				<br>


			</div>
			<!-- /.row -->
			<br><br><br>


		</div>
		<!-- /.container -->

		<!-- Footer -->
		<footer class="py-5 bg-dark">
			<div class="container">
				<p class="m-0 text-center text-white">Copyright &copy; ClimMapView 2019 - <a href="http://r1.ufrrj.br/petsi/" target="_blank" id="link">PET-SI (UFRRJ)</a> e <a href="http://r1.ufrrj.br/labmaa/" target="_blank" id="link">LABMAA (UFRRJ)</a></p>
			</div>
			<!-- /.container -->
		</footer>

	</body>

	</html>
