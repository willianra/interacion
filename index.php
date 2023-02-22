 
  <?php
include 'connection.php';

$sql =  "SELECT *FROM direccion";

$result = $connect->query($sql);
        $resultado = "";
if($result->num_rows > 0) {    
    $data = array();
    while($row = $result->fetch_assoc()) {
       // $data[] = $row;
       $resultado .=  $row['latitud'].",".$row['longitud']."|"; 


    }
    //echo json_encode( $resultado);
}?>
 
 <!DOCTYPE html>
<html>
  <head>
    <title>Mapa  de busqueda</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      #map {
        height: 400px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <h1>LUGARES RECORRIDOS</h1>
    <div id="map"></div>
     
    <script>
        function initMap() {
         
          var divMapa = document.getElementById('map');
          var resultado = "<?php echo $resultado; ?>";
          var markers = [];
          var infowindowActivo = false;
          var myLatLng = {
              lat:-17.79507649387663,
              lng:  -63.17763100043501
          };
          var map = new google.maps.Map(divMapa,{
            zoom: 13,
            center: myLatLng
          });
          resultado2 = resultado.split("|");
         // alert(resultado2.length)
          for (var i = 0; i < resultado2.length; i++) {
            resultado2[i] = resultado2[i].split('|');
               //alert(resultado2[i])
            var latlong = resultado2[i][0].split(',');
             //alert(latlong[1]);
           //  alert(latlong[0]);
            myLatLng = {
                lat: Number(latlong[0]),
                lng: Number(latlong[1])
            };

            markers[i] = new google.maps.Marker({
              position: myLatLng,
              map: map,
              title: i
            });

            var contentString = '<h1 id="firstHeading" class="firstHeading">' +
                 i  + '</h1>'+ '<div id="bodyContent">'+
                '<p><b>' + resultado2[i][0] + '</b></p><p>' + resultado2[i][0] +
                '</p></div>';

            markers[i].infoWindow = new google.maps.InfoWindow({
              content: contentString
            });

            google.maps.event.addListener(markers[i], 'click', function(){     
              if(infowindowActivo){
                infowindowActivo.close();
              }                 
              infowindowActivo = this.infoWindow;
              infowindowActivo.open(map, this);
            });

          }
        }
    </script>
    <a href="usuario.php">Volver</a>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhgSSTzKOzLw-maUH2Q6DxF_7EBAQkdU0&callback=initMap"></script>
  </body>
</html>