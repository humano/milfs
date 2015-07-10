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
body {
    background: url("") no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    color: gray;
    background-color: black;}
.alert-info{
color: #341208;
border-color:  #341208;
background-image: url("");
}

.jumbotron {
/* background-image: url("milfs/images/secure/?file=full/<?php echo $logo[0];?>"); */
background-size: cover;
background-position: center;
/* text-shadow:  1px 1px 1px rgba(255,255,255,0.8) ; */
background-color: black;

}

.navbar-header > p { font-size:20px; color: white; font-family: "Open Sans",sans-serif; font-weight: normal;display:inline }
.navbar-header > strong{ font-size:20px; color: #802a2a; font-weight: normal; font-family: "Open Sans",sans-serif; ;display:inline}
.navbar-header {width: 50%;}

.div_aplicacion {
background-color: #f0eee1 !important;
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
<?php if($_REQUEST[id] !='' AND $_REQUEST[c]){$onload ="<script type=\"text/javascript\"> xajax_formulario_modal('$_REQUEST[id]','','$_REQUEST[c]','$_REQUEST[t]')</script>";} ?>
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
            
					<li><?php echo $ingresar; ?></li>
              
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
	<?php  
	if(isset($_REQUEST[id])){ echo contenido_aplicacion("$_REQUEST[id]","contenido"); }
	else{	
	
	//echo contenido_aplicacion_nombre("Portada","banner") ;
	//echo aplicaciones_listado("","grid");} ?>
	<div class="container" style="width:80%">
	<?php echo aplicaciones_listado("","carrusel");} 
	?>
	</div>
<br></br>
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