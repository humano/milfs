<?php session_start(); 
//ini_set('display_errors', 'On');
if(isset($_REQUEST['debug'])) {ini_set('display_errors', 'On');} 
	require ('xajax/xajax.inc.php');
	$xajax = new xajax();
	require ("funciones/conex.php");
   require ('funciones/funciones.php');
   require ("includes/markdown.php");
   require ("includes/simple_html_dom.php");
	$xajax->processRequests();  ?>
<!DOCTYPE html>
<html lang="en">
   <head >
   <meta http-equiv="Cache-control" content="public">
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width,  maximum-scale=1,  initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="fredyrivera" >
	<link rel="shortcut icon" href="favicon-152.png">
	<link rel="apple-touch-icon-precomposed" href="favicon-152.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<?php $xajax->printJavascript("xajax/");  ?>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-k2/8zcNbxVIh5mnQ52A0r3a6jAgMGxFJFE2707UxGCk= sha512-ZV9KawG2Legkwp3nAlxLIVFudTauWuBpC10uEafMHYL0Sarrz5A7G79kXh5+5+woxQ5HM559XX2UZjMJ36Wplg==" crossorigin="anonymous">

<?php 
	

   
//$xajax->debugOn('');
$embebido =0;
if( isset($_REQUEST['empresa']) OR empty($_REQUEST) OR isset($_REQUEST['set']) OR isset($_REQUEST['identificador']) ) {
$acceso = 0;
if(	@$_REQUEST['empresa'] =="") { $id_empresa = "1";}
else { $id_empresa = $_REQUEST['empresa'];}
$id = remplacetas('empresa','id',"$id_empresa",'id','') ;
if($id[0]=="") { $id_empresa = "1";}
	if(!isset($_REQUEST['set'])){
	$titulo = remplacetas('empresa','id',"$id_empresa",'razon_social','') ;
	$descripcion = remplacetas('empresa','id',"$id_empresa",'slogan','') ;
	$background_imagen = buscar_imagen('',"","","$id_empresa"); 
	$uri_set = "";
	$acceso = 1;
	}
	else {
		$empresa = 	remplacetas('form_id','id',$_REQUEST['set'],'id_empresa',"") ;
		$id_empresa = $empresa[0];
		$titulo = 	remplacetas('form_id','id',$_REQUEST['set'],'nombre',"") ;
		$descripcion = 	remplacetas('form_id','id',$_REQUEST['set'],'descripcion',"") ;
		$background_imagen = buscar_imagen($_REQUEST['set'],"","","$id_empresa"); 
		$uri_set = "";
		$publico = remplacetas('form_id','id',$_REQUEST['set'],'publico',"") ;
			if($publico[0] =='1') {$acceso = 1;}
	
	}
	if( isset($_REQUEST['identificador'])){
		$empresa = 	remplacetas('form_datos','control',$_REQUEST['identificador'],'id_empresa',"") ;	
		$id_empresa = $empresa[0];
		$form = 	remplacetas('form_datos','control',$_REQUEST['identificador'],'form_id',"") ;	
		$titulo = 	remplacetas('form_id','id',$form['0'],'nombre',"") ;
		$descripcion = 	remplacetas('form_id','id',$form['0'],'descripcion',"") ;
		$background_imagen = buscar_imagen("$form[0]",$_REQUEST['identificador'],"","$id_empresa");
		$uri_set = "<a class='' href='?set=$form[0]'>$titulo[0]</a>";
				$publico = remplacetas('form_id','id',$form[0],'publico',"") ;
			if($publico[0] =='1') {$acceso = 1;}
}
$logo = remplacetas('empresa','id',"$id_empresa",'imagen','') ;
$direccion = remplacetas('empresa','id',"$id_empresa",'direccion','') ;
$telefono = remplacetas('empresa','id',"$id_empresa",'telefono','') ;
$email = remplacetas('empresa','id',"$id_empresa",'email','') ;
$facebook = remplacetas('empresa','id',"$id_empresa",'facebook','') ;
$twitter = remplacetas('empresa','id',"$id_empresa",'twitter','') ;

$razon_social = remplacetas('empresa','id',"$id_empresa",'razon_social','') ;
$sigla = remplacetas('empresa','id',"$id_empresa",'sigla','') ;



	?>

    <!-- Custom CSS -->
    <!-- Custom Fonts -->
    
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
/*!
 * Start Bootstrap - Landing Page Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

body,
html {
	 background-color: #A4A4A4;
    width: 100%;
    height: 100%;
}

body,
h1,
h2,
h3,
h4,
h5,
h6 {
    font-family: "Lato","Helvetica Neue",Helvetica,Arial,sans-serif;
    font-weight: 700;
}

.topnav {
    font-size: 14px; 
}

.lead {
    font-size: 18px;
    font-weight: 400;
}

.intro-header {
    padding-top: 50px; /* If you're making other pages, make sure there is 50px of padding to make sure the navbar doesn't overlap content! */
    padding-bottom: 50px;
    text-align: center;
    color: #f8f8f8;
    background: url(images/secure/?file=600/<?php echo $background_imagen; ?> ) no-repeat center center;
    background-size: cover;
}

.intro-message {
    position: relative;
    padding-top: 20%;
    padding-bottom: 20%;
    /*background: url(images/transparente50.png ) ;*/
}

.intro-message > h1 {
    margin: 0;
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
    font-size: 5em;
    border-radius: 3px;
    background: url(images/oscuro40.png ) ;
}

.intro-divider {
    width: 400px;
    border-top: 1px solid #f8f8f8;
    border-bottom: 1px solid rgba(0,0,0,0.2);
}

.intro-message > h3 {
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
    background: url(images/oscuro40.png ) ;
    border-radius: 3px;
}

@media(max-width:767px) {
    .intro-message {
        padding-bottom: 15%;
    }

    .intro-message > h1 {
        font-size: 3em;
    }

    ul.intro-social-buttons > li {
        display: block;
        margin-bottom: 20px;
        padding: 0;
    }

    ul.intro-social-buttons > li:last-child {
        margin-bottom: 0;
    }

    .intro-divider {
        width: 100%;
    }
}

.network-name {
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 2px;
}

.content-section-a {
    padding: 50px 0;
    background-color: #f8f8f8;
}

.content-section-b {
    padding: 50px 0;
    border-top: 1px solid #e7e7e7;
    border-bottom: 1px solid #e7e7e7;
}

.section-heading {
    margin-bottom: 30px;
}

.section-heading-spacer {
    float: left;
    width: 200px;
    border-top: 3px solid #e7e7e7;
}

.banner {
    padding: 100px 0;
    color: #f8f8f8;
    background: url(../img/banner-bg.jpg) no-repeat center center;
    background-size: cover;
}

.banner h2 {
    margin: 0;
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
    font-size: 3em;
}

.banner ul {
    margin-bottom: 0;
}

.banner-social-buttons {
    float: right;
    margin-top: 0;
}

@media(max-width:1199px) {
    ul.banner-social-buttons {
        float: left;
        margin-top: 15px;
    }
}

@media(max-width:767px) {
    .banner h2 {
        margin: 0;
        text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
        font-size: 3em;
    }

    ul.banner-social-buttons > li {
        display: block;
        margin-bottom: 20px;
        padding: 0;
    }

    ul.banner-social-buttons > li:last-child {
        margin-bottom: 0;
    }
}

footer {
    padding: 50px 0;
    background-color: #f8f8f8;
}

p.copyright {
    margin: 15px 0 0;
}
</style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand topnav" href="?empresa=<?php echo $id_empresa; ?>"><i class='fa fa-home'></i> <?php echo $sigla[0]; ?></a>
                
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav ">
                <li><?php echo $uri_set; ?></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="?ingresar">Ingresar</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                   
                        <h1><?php echo $titulo[0]; ?></h1>
                        
                        <h3><?php echo $descripcion[0]; ?></h3>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a target='redes' href="https://twitter.com/<?php echo $twitter[0]; ?>" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">@<?php echo $twitter[0]; ?></span></a>
                            </li>
                            <li>
                                <a target='redes' href="https://github.com/humano/milfs/" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                            </li>
                            <li>
                                <a target='redes'  href="https://www.facebook.com/<?php echo $facebook[0]; ?>" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name"><?php echo $facebook[0]; ?></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->
    <a  name="formularios"></a>
    
<?php
if($acceso ==1) {
if(isset($_REQUEST['set'])) { 
	echo landingpage_contenido_formulario($_REQUEST['set']); }
	elseif(isset($_REQUEST['identificador'])) { echo landingpage_contenido_identificador($_REQUEST['identificador']); }
else{ echo landingpage_contenido($id_empresa);}
}
 ?>
	
    

	<a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <h2>Conéctate:</h2>
                </div>
                <div class="col-lg-8">
                    <ul class="list-inline banner-social-buttons">
                       <li>
                                <a target='redes' href="https://twitter.com/<?php echo $twitter[0]; ?>" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">@<?php echo $twitter[0]; ?></span></a>
                            </li>
                            <li>
                                <a target='redes' href="https://github.com/humano/milfs/" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                            </li>
                            <li>
                                <a target='redes'  href="https://www.facebook.com/<?php echo $facebook[0]; ?>" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name"><?php echo $facebook[0]; ?></span></a>
                            </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#formularios">Contenido</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="#contact">Contacto</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small"> <a href='http://QWERTY.co/milfs'>&copy; MILFS Un proyecto de http://QWERTY.co</a> Se distribuye bajo licencia GPL V3
        <a href="?psi" target="_psi"><i class="fa fa-smile-o "></i> Políticas de privacidad y protección de datos.</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
return;
}


//require ('funciones/funciones.php');
require ('funciones/convert.php');
require ('funciones/login.php');





if (isset($_REQUEST['form'])) {
	$form = $_REQUEST['form'];
	$opciones= array();
	if(isset($_REQUEST['formato']) ){	$opciones['formato']= $_REQUEST['formato'];	}
	} else {$form = "";}
	if($form !='') {$embebido = 1;}
if (isset($_REQUEST['identificador'])) {$identificador = $_REQUEST['identificador'];} else {$identificador = "";}
	if($identificador !='') {$embebido = 1;}
if (isset($_REQUEST['id'])) {$id = $_REQUEST['id'];} else {$id = "";}
if (isset($_REQUEST['c'])) {$c = $_REQUEST['c'];} else {$c = "";}
if (isset($_REQUEST['f'])) {$f = $_REQUEST['f'];} else {$f = "";}
if (isset($_REQUEST['t'])) {$t = $_REQUEST['t'];} else {$t = "";}
?>
	
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-markdown.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-markdown.min.css">
	<link href='css/estilos.php?dd' rel='stylesheet'>


<style>
  #map {width: 500px;height:200px;}
  
</style>


    <title>I<3MILFS</title>

<?php

					if($id !='' OR $c ){$onload ="<script type=\"text/javascript\"> xajax_formulario_modal('".$id."','','".$c."','".$t."')</script>";}
						if( isset($_REQUEST['psi'])){$onload ="<script type=\"text/javascript\"> xajax_mostrar_psi()</script>";}
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="js/markdown.js"></script>
  <script src="js/to-markdown.js"></script>
  <script src="js/bootstrap-markdown.js"></script>
      <script src="js/scripts.js"></script>

<script type="text/javascript">
 

function evdragstart(ev,el) { //ev= el evento, el=elemento arrastrado.
    cont1=el.parentNode; //guardamos el elemento padre del elemento en una variable.
    ev.dataTransfer.setData("text",ev.target.id);	//guardamos datos del elemento. 
}

function evdragover (ev) { //ev=el evento.
    ev.preventDefault(); //quitar comportamiento por defecto.
}

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
//elseif($_REQUEST['psi'] !='') { include("psi.php") ; echo $aviso;}
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
  </div>
</div>
<?php }else{ } ?>


<div id='debug'></div>
	<div class='container'>
		<div id='contenido'>
		
		<?php 
		if(!isset($_SESSION['id_empresa'])) {$id_empresa_portada='1';} else{$id_empresa_portada = $_SESSION['id_empresa'];}
	$encabezado = empresa_datos("$id_empresa_portada",'encabezado');
	$pie = empresa_datos("$id_empresa_portada",'pie');
	echo "$encabezado";		
		?>xxx
		<?php echo buscar_imagen("21","","",""); ?>
		xxx
<?php if(isset($_REQUEST['change'])){
echo cambiar_password_formato("$_REQUEST[change]");
}
revisar_ingreso('');
?>		

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
		<?php	include("psi.php") ;?>
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
        <a href="?psi" target="_psi"><i class="fa fa-smile-o "></i> Políticas de privacidad y protección de datos.</a>
        	</div> 
      </div>
      <?php } ?>

</body>
</html>