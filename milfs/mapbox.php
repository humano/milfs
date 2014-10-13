<?php 
//ini_set('display_errors', 'On');
require ('xajax/xajax.inc.php');
$xajax = new xajax();
//require ('json.lab.php');
require ('funciones/funciones.php');
//require ('funciones/convert.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Custom marker icons</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.2/mapbox.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.2/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
</style>
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
         marker.setIcon(L.icon(feature.properties.icon));

});
 
map.fitBounds(myLayer.getBounds());
myLayer.setGeoJSON(geoJson);
</script>
</body>
</html>