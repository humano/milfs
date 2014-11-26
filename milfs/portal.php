<?php
///este archivo debe estar un nivel superior al directorio milfs 
session_start();
//ini_set('display_errors', 'On');
require ('milfs/xajax/xajax.inc.php');
$xajax = new xajax();
require ('milfs/funciones/funciones.php');
//require ('milfs/funciones/convert.php');
require ('milfs/funciones/login.php');
require_once ('milfs/includes/markdown.php');
$xajax->processRequests(); 
$logo = remplacetas('empresa','id','1','imagen') ;
$direccion = remplacetas('empresa','id','1','direccion') ;
$telefono = remplacetas('empresa','id','1','telefono') ;
$email = remplacetas('empresa','id','1','email') ;
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
     <?php $xajax->printJavascript("milfs/xajax/");  ?>
    <link rel="shortcut icon" href="favicon-152.png">
	<link rel="apple-touch-icon-precomposed" href="favicon-152.png">
	<link href="milfs/css/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link rel="stylesheet" href="milfs/css/style.css" media="screen" />
<!--  <link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet"> -->

<!-- <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script> -->

<!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" /> -->
<link href="milfs/css/bootstrap.min.css" rel="stylesheet">
<link href="milfs/css/estilos.php" rel="stylesheet"> 
	<script src="milfs/js/jquery.min.js"></script>
<script src="milfs/js/jquery.timelinr-0.9.54.js"></script>
      	<script>
		
	</script>
</head>
<body >
      <!-- Static navbar -->

      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class='col-sx-12 ' id='logo_cabecera' style='width:100%;left:40px; background-color: white; '>
      <br>
      <img  style="max-height:38px;" src="milfs/images/100x100.png"  width='40px'>
      <img  style="max-height:38px;" src="milfs/images/secure/?file=150/<?php echo $logo[0] ?>" >
      <img  style="max-height:38px;" src="milfs/images/100x100.png"  width='40px'>
      <div class='pull-right' >
      	<div style="">Follow us<br>
      	<a target="_facebook" href="https://www.facebook.com/casa3patios"><span style='font-size:30px; color:black'><i class='fa fa-facebook-square'></i></span></a>
      	<a target="_facebook" href="https://twitter.com/CasaTresPatios"><span style='font-size:30px; color:black'<i class='fa fa-twitter'></i></span></a>
      	<img  style="max-height:38px;" src="milfs/images/100x100.png"  width='40px'></div>
      	
      </div>
      </div>
       <!--  <div class="container-fluid"> -->
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
					<?php echo aplicaciones_listado("$_REQUEST[id]","nav"); ?>
              
            </ul>

          </div><!--/.nav-collapse -->
      <!--   </div> --><!--/.container-fluid -->
      </div>
<!-- /container -->
	<div id ='contenedor' style=' top: 100px; position:absolute; width:100%' class="">
	<?php echo contenido_aleatorio("9"); ?>
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
       <div style="position:fixed;
    bottom:5px;">
	       <div class="container">
	       <address style="padding:5px;background-color:white"><?php echo "$direccion[0] $telefono[0] $email[0]"; ?></address>
        <a class='pull-right' href='http://QWERTY.co/milfs'>Powered by: &copy; MILFS </a> 
        	</div> 
      </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<!--      <script src="milfs/js/jquery.min.js"></script>  -->
    <script src="milfs/js/bootstrap.min.js"></script> 
    <script src="milfs/js/scripts.js"></script> 
</body>
</html>