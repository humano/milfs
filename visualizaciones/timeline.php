<?php
/// ESTE ARCHIVO DEBE ESTAR UN NIVEL POR ENCIMA DEL DIRECTORIO milfs 
session_start();
//ini_set('display_errors', 'On');
require ('milfs/xajax/xajax.inc.php');
$xajax = new xajax();
require ('milfs/funciones/funciones.php');
require ('milfs/funciones/convert.php');
require ('milfs/funciones/login.php');
require ("milfs/funciones/conex.php");
require ("milfs/includes/markdown.php");
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
$web = remplacetas('empresa','id','1','web') ;
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
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700,300' rel='stylesheet' type='text/css'>
	<link rel="apple-touch-icon-precomposed" href="favicon-152.png">
	<link href="milfs/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<!--  <link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet"> -->

<!-- <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script> -->

<!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" /> -->
<link href="milfs/css/bootstrap.min.css" rel="stylesheet">
<link href="milfs/css/styletimeline.css" rel="stylesheet">

<!--   <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script> -->
<!--   <link rel="points" type="application/json" href="json.php?id=<?php echo $_REQUEST["id"] ?>"> -->
<style type="text/css">
.navbar-header > p { font-size:20px; color: white; font-family: "Open Sans",sans-serif; font-weight: normal;display:inline }
.navbar-header > strong{ font-size:20px; color: #802a2a; font-weight: normal; font-family: "Open Sans",sans-serif; ;display:inline}
.navbar-header {width: 50%;}
</style>
<?php
if(isset($_REQUEST[id])) {$id=$_REQUEST[id];
$onload ="<script type=\"text/javascript\"> xajax_contenido_timeline('$id');</script>";} ?>
</head>
<body>
     <script src="milfs/js/jquery.min.js"></script> 
    <script src="milfs/js/bootstrap.min.js"></script>
    <script src="milfs/js/scripts.js"></script>
    <script src="milfs/js/jquery.timelinr-0.9.54.js"></script>
<?php echo $onload; ?>

      <nav class="navbar navbar-inverse" role="navigation">
      	<div class="container-fluid">
      	  <div class='col-sx-12 ' id='logo_cabecera' style='width:100%;left:40px; background-color: white; '>
      	 
		      <div class='pull-right' >
		      	<div style="">
		      	<a title="Email" target="_redes" href="mailto:<?php echo $email[0];?>"><span style='font-size:20px; color:#E6E6E6'><i class='fa fa-envelope'></i></span></a>
		      	<a title="Facebook" target="_redes" href="<?php echo $facebook[0];?>"><span style='font-size:20px; color:#E6E6E6'><i class='fa fa-facebook-square'></i></span></a>
		      	<a title="Twitter" target="_redes" href="https://twitter.com/<?php echo $twitter[0];?>"><span style='font-size:20px; color:#E6E6E6'><i class='fa fa-twitter'></i></span></a>
		      	<a title="Inicio" target="" href="?"><span style='font-size:20px; color:#E6E6E6'><i class='fa fa-home'></i></span></a>
		      	
		      	</div>
		      	
		      </div>
	      </div>
          <div class="navbar-header" style="  ">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            
            	<p>|<?php echo $razon_social[0];?>|</p>
	<strong><?php echo $slogan[0];?></strong>
				
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            
					<li></li>
              
            </ul>

          </div><!--/.nav-collapse -->
		</div>
      </nav>


  
    <div class="container-fluid">

<div id='contenedor'>
	</div>

	</div>


       <div class='pie' style=" position: fixed; z-index: 10000;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 50px;
  background-color: black;
//background-image: url('milfs/images/menosmicos/background.jpg');
">
	      <p class='text-center'> <?php echo "$razon_social[0] $slogan[0] $direccion[0] $telefono[0] <a href ='$web[0]'>$web[0]</a>";  ?></p>
        <a class='pull-right' href='http://QWERTY.co/milfs'>Powered by: &copy; MILFS </a> 
        	</div> 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

</body>
</html>
