<?php
function Conectarse(){
	if ( !isset ( $link ) ) {
		
	@include("includes/datos.php");
   		if(!isset($db)) {
   include("milfs/includes/datos.php");
   		}

   if (!($link=mysql_connect($servidor,$usuario,$password)))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }
   if (!mysql_select_db($db,$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   
	$_SESSION['path']= $path_instalacion;
	$_SESSION['path_images_secure']= $path_images_secure;
	$_SESSION['url']= $url;
	$_SESSION['site']= $site;
	$_SESSION['analizador']= "$codigo_analizador";
	$_SESSION['upload_size']= $upload_size;
   return $link;
   }
}

?>