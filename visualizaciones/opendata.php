<?php
///este archivo debe estar un nivel superior al directorio milfs 
session_start();
//ini_set('display_errors', 'On');
require ('milfs/xajax/xajax.inc.php');
$xajax = new xajax();
require ('milfs/funciones/funciones.php');
require ('milfs/funciones/experimentales.php');
//require ('milfs/funciones/convert.php');
require ('milfs/funciones/login.php');
require_once ('milfs/includes/markdown.php');
require ("milfs/funciones/conex.php");

$xajax->processRequests(); 
$logo = remplacetas('empresa','id','1','imagen') ;
$direccion = remplacetas('empresa','id','1','direccion') ;
$telefono = remplacetas('empresa','id','1','telefono') ;
$email = remplacetas('empresa','id','1','email') ;
if($_REQUEST['formulario'] !="") {
$formulario = $_REQUEST['formulario'];
											}
else {
	$formulario = "40";
	}
	$id_campo = $_REQUEST['campo'];
	
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
	<link href="milfs/css/font-awesome/css/font-awesome.css" rel="stylesheet">
<!-- 		<link rel="stylesheet" href="milfs/css/style.css" media="screen" /> -->
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

font-size: 18px;
color: black;
}

.modal-dialog {
  width: 95%;
  height: 95%;
  padding: 0;
}

.modal-content {
  /*height: 100%;*/
  border-radius: 0;
}
.container-fluid {
	padding: 0px !important;
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


/*
.dropdown:hover{
background-color: #fd0;
font-weight: normal !important;
color: black !important;
}
.dropdown-toggle:hover{
background-color: #fd0;
color: black !important;
font-weight: normal !important;

}
.dropdown .open{
background-color: #fd0;
color: black !important;
font-weight: normal !important;

}
a.menu:hover{
background-color: #fd0 !important;
color: black !important;
}
.dropdown-menu:hover{
background-color: #fd0 !important;
color: black !important;
font-weight: normal !important;

}
ul.dropdown-menu{
background-color: black !important;
font-weight: normal !important;
}
ul.dropdown-menu:hover{
background-color: #fd0;
color: black !important;
font-weight: normal !important;

}
*/
	</style>
</head>
<body   >
      <!-- Static navbar -->

      <div class="navbar navbar-fixed-top "style='color:black; background-color:white' role="navigation">

    
         <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">
     
        <img class="img img-responsive" style="max-height:30px; display:inline" src="milfs/images/secure/?file=150/<?php echo $logo[0] ?>" >
        <span>
       <?php echo "<strong title='$formulario_descripcion[0]'>$formulario_nombre[0]</strong>"; ?>
        </span>
		</a>
          </div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">

	<?php echo portal_listado_formularios(); ?>
				

            </ul>
			<?php  echo buscar_datos("","$formulario","","mostrar_contenido"); ?>
          </div><!--/.nav-collapse -->
       </div> <!--/.container-fluid -->
    
<!-- /container -->
	<br>	<br>
	<div id ='contenedor' style='  ' class="container">
		<div class='row'>
			<div class='col-md-3'>
			
				<div class='panel panel-default'>
					<div class='panel panel-heading'>
						 <ul class='list-unstyled'>
						 
						 <?php echo portal_listado_formularios(); ?>  
						 </ul>
					 </div>
					<div class='panel-body'>
						<?php 
						if($id_campo =="") {			
						echo portal_listado_campos("$formulario");
												}
						else {
						echo portal_filtro_campos($formulario,$id_campo);
						echo portal_filtro_campos_select($formulario,"$id_campo");
						}			
						?>
					</div>
				</div>
			</div>
			<div class='col-md-9'>
				<div id='mostrar_contenido'>
				<h1>Bienvenido a nuestro portal de datos</h1>
				</div>
			</div>
			
		</div>
	</div>

	<div class="" style="background-color: black; color:white; ">
<!-- 	<img class='img img-resposive' src="milfs/patos/images/pie.png" style="width:100%" alt=""> -->

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