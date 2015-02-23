<?php
/// ESTE ARCHIVO DEBE ESTAR UN NIVEL POR ENCIMA DEL DIRECTORIO milfs 
session_start();
//ini_set('display_errors', 'On');
require ('milfs/xajax/xajax.inc.php');
$xajax = new xajax();
require ('milfs/funciones/funciones.php');
require ('milfs/funciones/convert.php');
require ('milfs/funciones/login.php');
$xajax->processRequests(); 
$logo = remplacetas('empresa','id','1','imagen') ;
$direccion = remplacetas('empresa','id','1','direccion') ;
$telefono = remplacetas('empresa','id','1','telefono_1') ;
$email = remplacetas('empresa','id','1','email') ;
$razon_social = remplacetas('empresa','id','1','razon_social') ;
$sigla = remplacetas('empresa','id','1','sigla') ;
$facebook = remplacetas('empresa','id','1','facebook') ;
$twitter = remplacetas('empresa','id','1','twitter') ;
$slogan = remplacetas('empresa','id','1','slogan') ;
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
<!--  <link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet"> -->

<!-- <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script> -->

<!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" /> -->
<link href="milfs/css/bootstrap.min.css" rel="stylesheet">
<link href="milfs/css/estilos.php" rel="stylesheet">

<!--   <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script> -->
<!--   <link rel="points" type="application/json" href="json.php?id=<?php echo $_REQUEST["id"] ?>"> -->
<style type="text/css">

.jumbotron {
background-image: url("milfs/images/secure/?file=600/<?php echo $logo[0];?>");
background-size: cover;
background-position: center;}

.div_aplicacion:hover {
   -webkit-animation: animatedBackground 1s ease-out 1;
        -moz-animation: animatedBackground 1s ease-out 1;
        animation: animatedBackground 1s ease-out 1;
        -webkit-animation-fill-mode: forwards;
        animation-fill-mode: forwards;
        z-index: 10000;
}

    @-webkit-keyframes animatedBackground {
        0% {
            -webkit-transform: scale(1, 1);
            -moz-transform: scale(1, 1);
            -ms-transform: scale(1, 1);
            -o-transform: scale(1, 1);
            transform: scale(1, 1)
        }
        100% {
        -webkit-transform: scale(1.1, 1.1);
        -moz-transform: scale(1.1, 1.1);
        -ms-transform: scale(1.1, 1.1);
        -o-transform: scale(1.1, 1.1);
        transform: scale(1.1, 1.1)
        }

    }
    
    
    @-moz-keyframes animatedBackground {
        0% {
            -webkit-transform: scale(1, 1);
            -moz-transform: scale(1, 1);
            -ms-transform: scale(1, 1);
            -o-transform: scale(1, 1);
            transform: scale(1, 1)
        }
        100% {
            -webkit-transform: scale(1.1, 1.1);
            -moz-transform: scale(1.1, 1.1);
            -ms-transform: scale(1.1, 1.1);
            -o-transform: scale(1.1, 1.1);
            transform: scale(1.1, 1.1)
        }

    }
    @keyframes animatedBackground {
        0% {
            -webkit-transform: scale(1, 1);
            -moz-transform: scale(1, 1);
            -ms-transform: scale(1, 1);
            -o-transform: scale(1, 1);
            transform: scale(1, 1)
        }
        100% {
            -webkit-transform: scale(1.1, 1.1);
            -moz-transform: scale(1.1, 1.1);
            -ms-transform: scale(1.1, 1.1);
            -o-transform: scale(1.1, 1.1);
            transform: scale(1.1, 1.1)
        }

    }
</style>
</head>
<body>
  <body>

      <div class='col-sx-12 ' id='logo_cabecera' style='width:100%;left:40px; background-color: white; '>
      
      <div class='pull-right' >
      	<div style="">
      	<a target="_redes" href="mailto:<?php echo $email[0];?>"><span style='font-size:30px; color:black'><i class='fa fa-envelope'></i></span></a>
      	<a target="_redes" href="<?php echo $facebook[0];?>"><span style='font-size:30px; color:black'><i class='fa fa-facebook-square'></i></span></a>
      	<a target="_redes" href="https://twitter.com/<?php echo $twitter[0];?>"><span style='font-size:30px; color:black'<i class='fa fa-twitter'></i></span></a>
      	<img  style="max-height:38px;" src="milfs/images/100x100.png"  width='40px'>
      	</div>
      	
      </div>
      </div>
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
            
					<li><a target="" href="?"><span style='font-size:30px; color:black'><i class='fa fa-home'></i></span></a></li>
              
            </ul>

          </div><!--/.nav-collapse -->

      </div>
<div class="jumbotron">
    <h1><?php echo $razon_social[0]; ?></h1>
    <p><?php echo $slogan[0]; ?></p>
  </div>
    <div class="container">
	<?php  
	if(isset($_REQUEST[id])){ echo contenido_aplicacion("$_REQUEST[id]"); }
	else{	echo aplicaciones_listado("","grid");} ?>

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
	       <div class='pie' style=" position: fixed;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 50px;
  background-color: white;">
	      <p class='text-center'> <?php echo "$direccion[0] $telefono[0] $email[0]"; ?></p>
        <a class='pull-right' href='http://QWERTY.co/milfs'>Powered by: &copy; MILFS </a> 
        	</div> 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     <script src="milfs/js/jquery.min.js"></script> 
    <script src="milfs/js/bootstrap.min.js"></script>
    <script src="milfs/js/scripts.js"></script>
</body>
</html>