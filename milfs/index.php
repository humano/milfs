<?php
session_start();
        if(isset($_REQUEST[debug])) {ini_set('display_errors', 'On');}
require ('xajax/xajax.inc.php');
$xajax = new xajax();
require ('funciones/funciones.php');
require ('funciones/convert.php');
require ('funciones/login.php');
require ("includes/markdown.php");
require ("includes/simple_html_dom.php");
require ("funciones/conex.php");

$xajax->processRequests(); 
//$xajax->debugOn('');
$embebido =0;
if (isset($_REQUEST['form'])) {
	$form = $_REQUEST['form'];
	$opciones["formato"]= $_REQUEST['formato'];	
	} else {$form = "";}
	if($form !='') {$embebido = 1;}
if (isset($_REQUEST['identificador'])) {$identificador = $_REQUEST['identificador'];} else {$identificador = "";}
	if($identificador !='') {$embebido = 1;}
if (isset($_REQUEST['id'])) {$id = $_REQUEST['id'];} else {$id = "";}
if (isset($_REQUEST['c'])) {$c = $_REQUEST['c'];} else {$c = "";}
if (isset($_REQUEST['f'])) {$f = $_REQUEST['f'];} else {$f = "";}
if (isset($_REQUEST['t'])) {$t = $_REQUEST['t'];} else {$t = "";}
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
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-k2/8zcNbxVIh5mnQ52A0r3a6jAgMGxFJFE2707UxGCk= sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg==" crossorigin="anonymous">
	<?php if($form !='') { echo "<link href='css/embebidoXXX.css' rel='stylesheet'>";}else{ echo "<link href='css/estilos.php?dd' rel='stylesheet'>";} ?>

	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-markdown.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-markdown.min.css">


<style>
  #map {width: 500px;height:200px;}
  
</style>


    <title>I<3MILFS</title>

<?php

					if($id !='' OR $c ){$onload ="<script type=\"text/javascript\"> xajax_formulario_modal('".$id."','','".$c."','".$t."')</script>";}
					
?>

<!--      <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="js/markdown.js"></script>
  <script src="js/to-markdown.js"></script>
  <script src="js/bootstrap-markdown.js"></script>
      <script src="js/scripts.js"></script>
<script type="text/javascript">
 
//Recoger elemento arrastrable//
function evdragstart(ev,el) { //ev= el evento, el=elemento arrastrado.
    cont1=el.parentNode; //guardamos el elemento padre del elemento en una variable.
    ev.dataTransfer.setData("text",ev.target.id);	//guardamos datos del elemento. 
}
//mientras se arrastra:
function evdragover (ev) { //ev=el evento.
    ev.preventDefault(); //quitar comportamiento por defecto.
}
//Al soltar el elemento arrastrado
function evdrop(ev,el) { //ev=el evento; el=receptor de soltado
    ev.stopPropagation(); //impedir otras acciones 
    ev.preventDefault(); //quitar comportamiento por defecto
    var data=ev.dataTransfer.getData("text"); //recogemos datos del elemento
    mielem=ev.target.appendChild(document.getElementById(data)); //obtenemos el elemento arrastrado
    cont1.appendChild(mielem); //ponemos el elemento arrastrado en el mismo sitio donde estaba.
    mielem2=mielem.cloneNode(true); //creamos una copia del elemento arrastrado.
    mielem2.setAttribute("draggable","false"); //impedimos que el nuevo elemento pueda volver a arrastrarse
    el.appendChild(mielem2); //colocamos la copia en el receptor de soltado
}
</script>
<style>
.modal-dialog {
  width: 98%;
  height: auto;
  padding: 0;
}

.modal-content {
  height: auto;
}

</style>
</head>
<body  >

<?php if($embebido ==1) { 
if($form!=''){	 echo formulario_embebido($form,$opciones);}
elseif($identificador !='') { echo mostrar_identificador($identificador,$id);}
else{}

}else{

 ?>
<?php echo @$onload; ?>
<?php 
 if ( isset ( $_SESSION['id'] ) ) {	?>
<div class="navbar navbar-inverse nav-bar-fixed-top " role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">MILFS</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="favicon-152.png" style="width:60px" alt="MILFS" title="Multi Interactive Light Form System"></a>
    </div>

<?php  echo milfs() ?>
  </div><!-- /.container-fluid -->
</div>
<?php }else{ } ?>



	<div class='container'>
		<div id='contenido'>
		
		<?php 
		if(!isset($_SESSION['id_empresa'])) {$id_empresa_portada='1';} else{$id_empresa_portada = $_SESSION['id_empresa'];}
	$encabezado = empresa_datos("$id_empresa_portada",'encabezado');
	$pie = empresa_datos("$id_empresa_portada",'pie');
	echo "$encabezado";		
		?>
		
<?php if(isset($_REQUEST['change'])){
echo cambiar_password_formato("$_REQUEST[change]");
}
revisar_ingreso('');?>		

<?php echo $pie; ?>
<img class='img-responsive center-block' src="images/logo.png" alt="MILFS">
		</div>

<?php


?>


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

	</div>


       <div class="">
	       <div class="container">
        <a href='http://QWERTY.co/milfs'>&copy; MILFS Un proyecto de http://QWERTY.co</a> Se distribuye bajo licencia GPL V3
        <a target="_blank" href='http://qwerty.co/faq/category/19/privacidad-y-protecci%C3%B3n-de-datos.html'>Políticas de privacidad y protección de datos.</a> 
        	</div> 
      </div>
      <?php } ?>

</body>
</html>