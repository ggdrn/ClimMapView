<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
      #floating-panel {
              position: absolute;
              top: 10px;
              left: 25%;
              z-index: 5;
              background-color: #fff;
              padding: 5px;
              border: 1px solid #999;
              text-align: center;
              font-family: 'Roboto','sans-serif';
              line-height: 30px;
              padding-left: 10px;
            }
            #floating-panel {
              position: absolute;
              top: 5px;
              left: 50%;
              margin-left: -180px;
              width: 350px;
              z-index: 5;
              background-color: #fff;
              padding: 5px;
              border: 1px solid #999;
            }
            #latlng {
              width: 225px;
            }
    </style>
    <!--- Bootstrap--->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Google maps -->
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD215PLR4mF-At90ezdd7t7yZc-H3JoBb8">
    </script>
    <!--- Dados do Meteoro --->
    <script src="data/dados.js"></script>
    <script type="text/javascript">
        //Define a imagem do ponto
        var image = {
          url: "icon/nuvem-azul.png", //
          scaledSize: new google.maps.Size(25,25), // scaled size
        };
        var pessoa = {
          url: "icon/pin.png", //
          scaledSize: new google.maps.Size(30,30), // scaled size
        };
        var marker_busca = {
          url: "icon/Map-Marker-Push-Pin-1-Azure-256.png", //
          scaledSize: new google.maps.Size(30,30), // scaled size
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
          //map.fitBounds(bounds);
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
       '<center><h5 id="firstHeading" class="firstHeading"> '+ nome +'</h5></center>'+
       '<div id="bodyContent">'+
       '<hr/>'+
       '<b><a href="downloadBruto.php?id='+id+'"><p align="center">DOWNLOAD DOS DADOS BRUTOS <span class="glyphicon glyphicon-download-alt"></span></p></a></b>'+
       '<hr/>'+
       '<b><a href="downloadCurado.php?id='+id+'"><p align="center">DOWNLOAD DOS DADOS CURADOS <span class="glyphicon glyphicon-download-alt"></span></p></a></b>'+
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
      // Da um zoom ao clicar na posição
      map.setZoom(13);
          map.setCenter(marker.getPosition());
   });
 }
     function initialize() {
       var mapOptions = {
           center: new google.maps.LatLng(-22.379999,-42.500000),
           zoom: 12,
           mapTypeId: 'roadmap'
        };
        map = new google.maps.Map(document.getElementById('ClimMapView'), mapOptions);
        // Para iniciar com a posição do usuário
        if(navigator.geolocation) { //checa se a geocalização esta ativa
          navigator.geolocation.getCurrentPosition(function(position){
            var myLatLng = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var posicao = new google.maps.Marker({
              position: myLatLng,
              map: map,
              title: 'Você está aqui',
              icon: pessoa
            });
        //Mesmo esquema de zoom do código a cima.
        posicao.addListener('click', function() {
          map.setZoom(13);
          map.setCenter(posicao.getPosition());
        });
        //Se achar a geolcalicação, inicar aqui!
          map.setCenter(myLatLng);
        });
        }
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
    <div id="floating-panel">
      <input id="latlng" type="text" value="-22.379999,-42.500000">
      <input id="submit" type="button" value="Pesquisar">
    </div>
    <div id="ClimMapView" style="width:100%; height:100%"></div>
    <script>

        var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;

        document.getElementById('submit').addEventListener('click', function() {
          geocodeLatLng(geocoder, map, infowindow);
        });

      function geocodeLatLng(geocoder, map, infowindow) {
        var input = document.getElementById('latlng').value;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(13);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: marker_busca
              });
              // Ao clicar, remove o pin
              google.maps.event.addListener(marker, 'click', function() {
                marker.setMap(null);
              });
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('Nenhum resultado foi encontrado');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
    </script>
  </body>
</html>
