<?php
session_start();
//ini_set('display_errors', 'On');
require ('xajax/xajax.inc.php');
$xajax = new xajax();
require ('funciones/funciones.php');
require ('funciones/convert.php');
require ('funciones/login.php');
$xajax->processRequests(); 


?>
<!DOCTYPE html>
<html lang="en">
   <head >
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width,  maximum-scale=1,  initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="fredyrivera" >
    
    <link rel="shortcut icon" href="favicon-152.png">
	<link rel="apple-touch-icon-precomposed" href="favicon-152.png">
	<link href="css/font-awesome/css/font-awesome.css" rel="stylesheet">
 <link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">

<script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>

<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/estilos.php" rel="stylesheet">
  <style type="text/css">
  body {  padding: 0; margin: 0;  }
  html, body, #cupcake-map { z-index: 10; position:absolute; top:0; bottom:0px; width:100%;  }
  .leaflet-popup-content {
    width:600px !important;
}
  </style>

  <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <link rel="points" type="application/json" href="json.php?id=<?php echo $_REQUEST["id"] ?>">
</head>
<body>
  <div id="cupcake-map"></div>
  <script>
  var cupcakeTiles = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZooom: 18  
  });

  $.getJSON($('link[rel="points"]').attr("href"), function(data) {
    var geojson = L.geoJson(data, {
      onEachFeature: function (feature, layer) {
        layer.bindPopup(feature.properties.name,"autoPan");
      }
    });
    var map = L.map('cupcake-map').fitBounds(geojson.getBounds());
    cupcakeTiles.addTo(map);
    geojson.addTo(map);
  });
  </script>
  <div  class="center-block" style="  z-index:10000; position:absolute; bottom:10px;">
  <div role='row' class='row center-block' style="width:95% ; "><?php echo aplicacion_datos("$_REQUEST[id]");?></div>
  </div>
</body>
</html>