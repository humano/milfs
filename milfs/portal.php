<?php
session_start();
//ini_set('display_errors', 'On');
require ('xajax/xajax.inc.php');
$xajax = new xajax();
require ('funciones/funciones.php');
require ('funciones/convert.php');
require ('funciones/login.php');
$xajax->processRequests(); 
$logo = remplacetas('empresa','id','1','imagen') ;
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
     <?php $xajax->printJavascript("xajax/");  ?>
    <link rel="shortcut icon" href="favicon-152.png">
	<link rel="apple-touch-icon-precomposed" href="favicon-152.png">
	<link href="css/font-awesome/css/font-awesome.css" rel="stylesheet">
<!--  <link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet"> -->

<!-- <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script> -->

<!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" /> -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/estilos.php" rel="stylesheet">
  <style type="text/css">
  body {  padding: 0; margin: 0;  }
  html, body, #cupcake-map { z-index: 10; position:absolute; top:0; bottom:0px; width:100%;  }
  .leaflet-popup-content {
     width:600px !important; 
}
  </style>

<!--   <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script> -->
<!--   <link rel="points" type="application/json" href="json.php?id=<?php echo $_REQUEST["id"] ?>"> -->
</head>
<body>
  <body>

	<div class="">

      <!-- Static navbar -->
      <img  style="max-height:50px;" src="images/secure/?file=150/<?php echo $logo[0] ?>" >
      <div class="navbar navbar-default " role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
					<?php echo aplicaciones_listado("","nav"); ?>
              
            </ul>

          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
	</div><!-- /container -->
	<div id ='contenedor' style='  margin-top:-10px; ' class="">
	<?php echo contenido_aleatorio("6"); ?>
	</div>
  <div  class="center-block" style="  z-index:10000; bottom:10px;">
  <div role='row' class='row center-block' style="width:95% ; "><?php //echo aplicacion_datos("$_REQUEST[id]");?></div>
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