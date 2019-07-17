<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD215PLR4mF-At90ezdd7t7yZc-H3JoBb8">
    </script>
    <script src="data/dados.js"></script>
    <script type="text/javascript">
        //Define a imagem do ponto
        var image = {
          url: "icon/nuvem-azul.png", //
          scaledSize: new google.maps.Size(25,25), // scaled size
        };
        // Esta função vai percorrer a informação contida na variável dados
        // e cria os marcadores através da função createMarker
        function displayMarkers(){

          // esta variável vai definir a área de mapa a abranger e o nível do zoom
          // de acordo com as posições dos marcadores
          var bounds = new google.maps.LatLngBounds();

          // Loop que vai percorrer a informação contida em dados
          // para que a função createMarker possa criar os marcadores

        // console.log(dados.features[3].properties.RESPONSÁVEL); //
        for (var i = 0; i < dados.features.length; i++){
          var latlng = new google.maps.LatLng( dados.features[i].properties.Y,  dados.features[i].properties.X);
          var nome = dados.features[i].properties.NOME;
          var operadora = dados.features[i].properties.OPERADORA;
          var responsavel = dados.features[i].properties.RESPONSÁVEL;
          var altitude = dados.features[i].properties.ALTITUDE;
          var  x = dados.features[i].properties.X;
          var y = dados.features[i].properties.Y;
          var id = dados.features[i].properties.ID;
          var estado = dados.features[i].properties.ESTADO;
          var municipio = dados.features[i].properties.MUNICÍPIO;
          var bacia = dados.features[i].properties['BACIA'];
          var subbacia = dados.features[i].properties['SUB-BACIA'];
          var ec = dados.features[i].properties['ESTAÇĂO CLIMATOLÓGICA'];
          var ep = dados.features[i].properties['ESTAÇĂO PLUVIOMÉTRICA'];
          var rc = dados.features[i].properties['REGISTRADOR DE CHUVA'];

          createMarker(nome, operadora, responsavel, altitude, x, y, latlng, id, estado, municipio, bacia, subbacia, ec, ep, rc);
           // Os valores de latitude e longitude do marcador são adicionados à
           // variável bounds
          bounds.extend(latlng);
             }
         // Depois de criados todos os marcadores,
         // a API, através da sua função fitBounds, vai redefinir o nível do zoom
         // e consequentemente a área do mapa abrangida de acordo com
         // as posições dos marcadores
          map.fitBounds(bounds);
        }

// Função que cria os marcadores e define o conteúdo de cada Info Window.
function createMarker(nome, operadora, responsavel, altitude, x, y, latlng, id, estado, municipio, bacia, subbacia, ec, ep, rc){
   var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      title: nome,
      icon: image,
   });
   // Evento que dá instrução à API para estar alerta ao click no marcador.
   // Define o conteúdo e abre a Info Window.
   google.maps.event.addListener(marker, 'click', function() {
     // Variável que define a estrutura do HTML a inserir na Info Window.
     var conteudo = '<div id="content">'+
       '<div id="siteNotice">'+
       '</div>'+
       '<center><h1 id="firstHeading" class="firstHeading"> '+ nome +'</h1></center>'+
       '<div id="bodyContent">'+
       '<hr/>'+
       '<p><b>X:</b> '+ x +'<p>' +
       '<hr/>'+
       '<p><b>Y:</b> '+ y + '<p>' +
       '<hr/>'+
       '<p><b>ID:</b> '+ id +'</p>'+
       '<hr/>'+
       '<p><b>Estado:</b> '+ estado +'</p>'+
       '<hr/>'+
       '<p><b>Município:</b> '+ municipio +' </p>'+
       '<hr/>'+
       '<p><b>Bacia:</b>' + bacia +'</p>'+
       '<hr/>'+
       '<p><b>Sub-Bacia</b> '+ subbacia +'</p>'+
       '<hr/>'+
       '<p><b>Resposável:</b> '+ responsavel +'</p>'+
       '<hr/>'+
       '<p><b>Operadora:</b> ' + operadora + '</p>'+
       '<hr/>'+
       '<p><b>Altitude: </b>' + altitude +'</p>'+
       '<hr/>'+
       '<p><b>ESTAÇÃO PLUVIOMÉTRICA:</b> '+ ep +'</p>'+
       '<hr/>'+
       '<p><b>REGISTRADOR DE CHUVA:</b> '+ rc +'</p>'+
       '<hr/>'+
       '<p><b>ESTAÇĂO CLIMATOLÓGICA:</b> '+ ec +' </p>'+
       '<hr/>'+
       '</div>'+
       '</div>';

      // O conteúdo da variável conteudo é inserido na Info Window.
      infoWindow.setContent(conteudo);
      // A Info Window é aberta com um click no marcador.
      infoWindow.open(map, marker);
   });
 }
     function initialize() {
       var mapOptions = {
           center: new google.maps.LatLng(-22.379999,-42.500000),
           zoom: 8,
           mapTypeId: 'roadmap',
        };
        map = new google.maps.Map(document.getElementById('ClimMapView'), mapOptions);
        // Cria a nova Info Window com referência à variável infoWindow.
        // O conteúdo da Info Window é criado na função createMarker.
        infoWindow = new google.maps.InfoWindow();
        // Evento que fecha a infoWindow com click no mapa.
        google.maps.event.addListener(map, 'click', function() {
           infoWindow.close();
        });

        // Chamada para a função que vai percorrer a informação
        // contida na variável markersData e criar os marcadores a mostrar no mapa
        displayMarkers();
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
  </head>
  <body onload="initialize()">
    <div id="ClimMapView" style="width:100%; height:100%"></div>
  </body>
</html>
