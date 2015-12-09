<?php session_start();
//ini_set('display_errors', 'On');
require ('xajax/xajax.inc.php');
$xajax = new xajax();
//require ('json.lab.php');
require ('funciones/funciones.php');
require ("funciones/conex.php");
require_once ('includes/markdown.php');
//require ('funciones/convert.php');
$xajax->processRequests(); 
if($_REQUEST[id2] =='') {$agregar= $_REQUEST[id];}else {$agregar = $_REQUEST[id2];}
$formulario_nombre = remplacetas('form_id','id',$_REQUEST[id],'nombre') ;
$agregar_nombre = remplacetas('form_id','id',$agregar,'nombre') ;
$plantilla ="mapa";
?>

<!DOCTYPE html>
<html lang="en">
   <head >
   <title><?php echo $formulario_nombre[0] ?> MILFS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width,  maximum-scale=1,  initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
     <?php $xajax->printJavascript("xajax/");  ?>
    <link rel="shortcut icon" href="favicon-152.png">
	<link rel="apple-touch-icon-precomposed" href="favicon-152.png">

<script src='https://api.mapbox.com/mapbox.js/v2.2.2/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.2.2/mapbox.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />
<link href='https://mapbox.com/base/latest/base.css' rel='stylesheet' />

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-k2/8zcNbxVIh5mnQ52A0r3a6jAgMGxFJFE2707UxGCk= sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg==" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-markdown.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-markdown.min.css">

<!-- <link href="css/estilos.php?hghgSs" rel="stylesheet"> -->
<style type="text/css">
.navbar-default {
background:rgba(255,255,255,1)  ;

}
@media (max-width: 800px) {
    .panel-map{
        max-width: 970px;
    }
   
  
}
@media (min-width: 800px) {
    .panel-map{
        max-width: 200px;
    }
}

        
	.leaflet-popup-content {     width:600px !important; }

#map { position:absolute; top:0; bottom:0; width:100%;  }
  /* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
  padding: 0; margin: 0; 
}



/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */

body > .container {
  padding: 60px 15px 0;
}
.container .text-muted {
  margin: 20px 0;
}

.footer {
  position: absolute;
  bottom: 3px;
	width: 95%;
	margin: 0 auto;
	
	 height: 120px;
  
  /* Set the fixed height of the footer here */

   z-index: 999999;
}
.footer > .container {
  padding: 2px;
  background-color: white;
  border-radius: 3px;
  width: 90%;
  height: 120px;
  overflow-x: scroll;
  
  
  
 
}

code {
  font-size: 80%;
}
.modal-dialog {
  width: 98%;
  height: auto;
  padding: 0;
}

.modal-content {
  height: auto;
}
  </style>


<!-- <link rel="points" type="application/json" href="json.php?id=<?php echo $_REQUEST["id"] ?>">  -->
</head>
<body>
 
<div id='map'> 

	<?php  $categorias = lista_categorias($_REQUEST['id'],'','') ;
	if($categorias !="") {
	$pie="
<div class='footer' id='contenedor_pie' >
	<div  style='' class='container' >
	<a href='#' onclick=\"xajax_limpia_div('contenedor_pie'); \"><span class='pull-right'><i class='fa fa-times'></i></span></a>
	$categorias
		</div></div>
</div>";
	
		
	}else{
	
	}
	echo $pie;
	 ?>


<script>
L.mapbox.accessToken = 'pk.eyJ1IjoiZmNhc3Ryb3QiLCJhIjoiY2lnOWw1bmd1MG93eXVsbTJpcmluYTBxdCJ9.yG7C1rEH6-MpZBEEb68IVg';
/* var map = L.mapbox.map('map', 'examples.map-i86nkdio')*/
var map = L.mapbox.map('map', 'mapbox.streets')
    .setView([40, -74.50], 8);

var geoJson = [ <?php echo imprime_geojson("$_REQUEST[id]","$_REQUEST[id2]","$plantilla");?> ];
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

<?php echo mapa_ficha("$_REQUEST[id]");?>

   

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
	      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
			<script src="js/markdown.js"></script>
			<script src="js/to-markdown.js"></script>
			<script src="js/bootstrap-markdown.js"></script>
	      <script src="js/scripts.js"></script>

</body>
</html>