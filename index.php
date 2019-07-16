<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD215PLR4mF-At90ezdd7t7yZc-H3JoBb8">
    </script>
    <script type="text/javascript">
      function initialize() {
        //Iniciar o mapa
        var mapOptions = {
          //Posição inicial que o mapa é inicializado
          center: new google.maps.LatLng(-22.379999,-42.500000),
          // Escolhe o zoom, quando maior o valor, mair o zoom do mapa
          zoom: 8,
          // Escolhe o tipo do mapa a ser iniciado, nesse caso, mapa de rodovia
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("ClimMapView"),mapOptions);

        var estacao = new google.maps.LatLng(-22.379999,-42.500000);

        var image = {
          url: "icon/nuvem-azul.png", // url MapMarker_Ball_Right_Azure
          scaledSize: new google.maps.Size(32,32), // scaled size
          //origin: new google.maps.Point(0,0), // origin
          //anchor: new google.maps.Point(0, 0) // anchor
        };
        var marker = new google.maps.Marker({
            position: estacao,
            title:"NOVA FRIBURGO",
            draggable: true,
            icon: image,
            animation: google.maps.Animation.DROP
        });
// To add the marker to the map, call setMap();
marker.setMap(map);
      }
    </script>
  </head>
  <body onload="initialize()">
    <div id="ClimMapView" style="width:100%; height:100%"></div>
  </body>
</html>
