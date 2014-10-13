<?php 
//ini_set('display_errors', 'On');
require ('xajax/xajax.inc.php');
$xajax = new xajax();
//require ('json.lab.php');
require ('funciones/funciones.php');
//require ('funciones/convert.php');
$formulario_nombre = remplacetas('form_id','id',$_REQUEST[id],'nombre') ;
?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title><?php echo $formulario_nombre[0] ?> MILFS</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.2/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.2/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
</style>
</head>
<!DOCTYPE html>
<html lang="en">
   <head >
   <title><?php echo $formulario_nombre[0] ?> MILFS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width,  maximum-scale=1,  initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="fredyrivera" >
     <?php $xajax->printJavascript("xajax/");  ?>
    <link rel="shortcut icon" href="favicon-152.png">
	<link rel="apple-touch-icon-precomposed" href="favicon-152.png">
	<link href="css/font-awesome/css/font-awesome.css" rel="stylesheet">
 <link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">

<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.2/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.2/mapbox.css' rel='stylesheet' />

<!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" /> -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/estilos.php?hghgS" rel="stylesheet">
  <style type="text/css">
  body {  padding: 0; margin: 0;  }

  .leaflet-popup-content {     width:600px !important; }

    body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
  </style>

  <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <link rel="points" type="application/json" href="json.php?id=<?php echo $_REQUEST["id"] ?>">
</head>
<body>
<div id='map'></div>
<script>
L.mapbox.accessToken = 'pk.eyJ1IjoiaHVtYW5vIiwiYSI6IlgyRTFNdFEifQ.OmQBXmcVg_zq-vMpr8P5vQ';
var map = L.mapbox.map('map', 'humano.jki5hno0')
    .setView([40, -74.50], 8);

var geoJson = [ <?php echo imprime_geojson("$_REQUEST[id]");?> ];
var myLayer = L.mapbox.featureLayer()
  .setGeoJSON(geoJson)
  .addTo(map);
  
myLayer.on('layeradd', function(e) {
	    var marker = e.layer,
        feature = marker.feature;
           // Create custom popup content
    var popupContent =  '' + feature.properties.description + '';

    // http://leafletjs.com/reference.html#popup
    marker.bindPopup(popupContent,{
        closeButton: false,
        minWidth: 320
    });

         marker.setIcon(L.icon(feature.properties.icon));

});
 
map.fitBounds(myLayer.getBounds());
myLayer.setGeoJSON(geoJson);
</script>
<div  class="panel-map" id='panel_map_<?php echo $id ?>' style="">
  <div role='row' class='row center-block' style="; "><?php echo mapa_ficha("$_REQUEST[id]");?></div>
  </div>
  <!-- Modal -->

<div class='modal fade ' id='muestraInfo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog' >
    <div class='modal-content'>
      <div class='modal-header' >
        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
        <h4 class='modal-title' id='myModalLabel_info'><div id='titulo_modal'></div></h4>
      </div>
      <div class='modal-body'>
      
       <div id='muestra_form'></div>
      </div>
      <div class='modal-footer' id='pie_modal'>
        
       
      </div>
    </div>
  </div>
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     <script src="js/jquery.min.js"></script> 
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>