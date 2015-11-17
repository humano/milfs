<?php
///este archivo debe estar un nivel superior al directorio milfs 
session_start();
        if(isset($_REQUEST[debug])) {ini_set('display_errors', 'On');}
require ('milfs/xajax/xajax.inc.php');
$xajax = new xajax();
require ('milfs/funciones/funciones.php');
require ('milfs/funciones/experimentales.php');
//require ('milfs/funciones/convert.php');
require ('milfs/funciones/login.php');
require_once ('milfs/includes/markdown.php');
require ("milfs/funciones/conex.php");
$formulario ="5";
$campo_filtro ="74";
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
$formulario_descripcion = remplacetas('form_id','id',"$formulario",'descripcion',"") ;
$formulario_nombre = remplacetas('form_id','id',"$formulario",'nombre',"") ;
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
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-k2/8zcNbxVIh5mnQ52A0r3a6jAgMGxFJFE2707UxGCk= sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg==" crossorigin="anonymous">
<link rel="stylesheet" href="milfs/css/style.css" media="screen" /> 
<!--  <link href="http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet"> -->

<!-- <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script> -->

<!-- <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css" /> -->
<link href="milfs/css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="milfs/css/estilos.php" rel="stylesheet">  -->
	<script src="milfs/js/jquery.min.js"></script>
<script src="milfs/js/jquery.timelinr-0.9.54.js"></script>
<style type="text/css">
/*@font-face {
font-family: Brandon_light;
src: url("milfs/patos/fuentes/Brandon_light.otf") format("opentype");
}*/
body{

}

.modal-dialog {
  padding: 5px;
  border-radius: 3px;
  max-width: 700px;
}

.modal-content {
  /*height: 100%;*/
  border-radius: 5px;;
}
.container-fluid {
	/*padding: 0px !important;*/
	}
a.pie{
color: white !important;
}
a.menu{
color: white !important;
}
a:active{
color: black !important;
}


	</style>
</head>
<body  >

    
<!-- /container -->
	<br>	<br>
	<div class='container'>
	<div class='jumbotron'>
		<div class='row'>
			<div class='col-md-3'>
			<img class="img img-responsive" style="width:100%; " src="milfs/images/secure/?file=600/<?php echo $logo[0] ?>" >
			
			</div>
			<div class='col-md-9'>
			<h1><?php echo $razon_social[0]; ?></h1>
			<?php echo "<h2>$formulario_nombre[0] <br><small>$formulario_descripcion[0]<small></h2> ";   ?>
			</div>
		</div>
	
	</div>
	
	<div class='row'>
		<div class='col-sm-7 col-md-2' >
		<div class='btn btn-success btn-block' onclick ="xajax_mostrar_modal('<?php echo $formulario; ?>','','');"> <i class='fa fa-plus-square'></i> Agregar </a></div>
		</div>
		<div class='col-sm-7 col-md-5' >
			<div class='input-group'>
			<span class='input-group-addon'>Filtro <i class='fa fa-filter'></i> </span>
		<?php echo portal_filtro_campos_select($formulario,"$campo_filtro","mostrar_resultado","grid");  ?>
			</div>
		</div>
		<?php  echo buscar_datos("","$formulario","grid","mostrar_resultado"); ?>
	</div>
		
	<br>
	<div id ='mostrar_resultado' style='  ' class="container">
	
	</div>

	<div class="" style="background-color: black; color:white; ">
<!-- 	<img class='img img-resposive' src="milfs/patos/images/pie.png" style="width:100%" alt=""> -->

	</div>
	</div>
</div>
  <!-- Modal -->

<div class='modal fade  ' id='muestraInfo' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-lg' style='  ' >
    <div class='modal-content'  style=' '>
    	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<br>
      </div>
      <div class='modal-body'>
       <div id='muestra_form' class="row"></div>
      </div>
    </div>
  </div>

<!-- 
	       <div class='pie' style=" position: fixed;
  bottom: 0; 
  width: 100%;
  /* Set the fixed height of the footer here */
  
 ">
	      
        	</div> -->  


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<!--      <script src="milfs/js/jquery.min.js"></script>  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<!--     <script src="milfs/js/bootstrap.min.js"></script>  -->
    <script src="milfs/js/scripts.js"></script> 
        
</body>
</html>
