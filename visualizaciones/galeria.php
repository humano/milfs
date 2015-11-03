<?php
session_start();
if(isset($_REQUEST[debug])) {ini_set('display_errors', 'On');}
/// ESTE ARCHIVO DEBE ESTAR UN NIVEL POR ENCIMA DEL DIRECTORIO milfs 
$id_form="1";
$plantilla ="galeria";
/*
EJEMPLO DE PLANTILLA PÁRA GALERIA

 <div class='  ' style=' position:relative;  text-align:center;  border-radius : 5px; width:100%; height:100% '> 
 <img  style=' height:100%; ' src ='/milfs/images/secure/?file=600/$campo_limpio[26] ' alt=' ' title=' '  class=''>  
<div style=' margin-left: auto;
        position:absolute;
	margin-right: auto;
	margin-top:30px;
	left:0;
	right:0;  bottom: 50px; 
        width:400px; ' >
    <h1> $campo_limpio[1]   $campo_limpio[3]  </h1>
</div>
 </div>

*/
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
	 if ( !isset( $_SESSION[id] ) ) {	$ingresar = "<a href='milfs'>Ingresar $_SESSION[id] </a>";}else{$ingresar = "<a class=' btn  ' onclick=\"xajax_login_boton('x') \"><i class='fa fa-sign-out fa-fw'></i> $_SESSION[username]</a>";}
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

<!-- <script src="/tbl_change.php?db=artessano_milfs&table=parametrizacion&where_clause=%60parametrizacion%60.%60id%60+%3D+4&clause_is_unique=1&sql_query=SELECT+%2A+FROM+%60parametrizacion%60&goto=sql.php&default_action=update&token=ad27979fbb9c2ce30fc9601060e980bbhttp://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script> -->

<!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" /> -->
<link href="milfs/css/bootstrap.min.css" rel="stylesheet">
<link href="milfs/css/estilos.php" rel="stylesheet">

<!--   <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script> -->
<!--   <link rel="points" type="application/json" href="json.php?id=<?php echo $_REQUEST["id"] ?>"> -->
<link href="milfs/css/carousel.css" rel="stylesheet">
<style type="text/css">


.navbar-header > p { font-size:20px; color: white; font-family: "Open Sans",sans-serif; font-weight: normal;display:inline }
.navbar-header > strong{ font-size:20px; color: #802a2a; font-weight: normal; font-family: "Open Sans",sans-serif; ;display:inline}
.navbar-header {width: 50%;}

.div_aplicacion {
/* background-color: #f0eee1 !important;*/
}
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
            
					              
            </ul>

          </div><!--/.nav-collapse -->
		</div>
      </nav>

  	
  
    <div class="container-fluid">
		<div class="row">
			<div class="col-sm-8">

			</div>
			<div class="col-sm-4">
			</div>
		</div>

	<div class="container" style="width:100%">
	<?php echo aplicacion_carrusel("","$id_form","galeria") ?>
	</div>

	</div>


	       <div class='pie' style=" position: fixed; z-index: 10000;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 50px;
  background-color: gray;
background-image: url('');
">
	      <p class='text-center'> <?php echo "$razon_social[0] $slogan[0] $direccion[0] $telefono[0] <a href ='$web[0]'>$web[0]</a>";  ?></p>
        <a class='pull-right' href='http://QWERTY.co/milfs'>Powered by: &copy; MILFS </a> 
        	</div> 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     <script src="milfs/js/jquery.min.js"></script> 
    <script src="milfs/js/bootstrap.min.js"></script>
    <script src="milfs/js/scripts.js"></script>
      <script src="milfs/js/bootstrap.js"></script>
  <script src="milfs/js/markdown.js"></script>
  <script src="milfs/js/to-markdown.js"></script>
  <script src="milfs/js/bootstrap-markdown.js"></script>

</body>
</html>
