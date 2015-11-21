<?php

session_start();
// Comprobamos si existe la variable
/*if ( !isset ( $_SESSION['id'] ) ) {
 // Si no existe 
 header("Location: ../nodisponible.jpg");
// echo "hola mundo2";
}*/
if(!isset($_GET['file']) ){
	 header("Location: ../sinimagen.jpg");
	 
	}
	include("../../includes/datos.php");
$dir="$path_images_secure/";
if ((!$file=realpath($dir.$_GET['file']))
    || strpos($file,realpath($dir))!==0 || substr($file,-4)=='.php'){
 //header('HTTP/1.0 404 Not Found');
  header("Location: ../sinimagen.jpg?$dir");
  exit();
}
$ref=$_SERVER['HTTP_REFERER'];
if (strpos($ref,'http://')===0 || strpos($ref,'http')!==0){
  $mime=array(
    'jpg'=>'image/jpeg',
    'png'=>'image/png',
    'mid'=>'audio/x-midi',
    'wav'=>'audio/x-wav'
  );
  if($mime[substr($file,-3)] =='') {
    header('Location: ../pixel.png');
   
  exit();
  }
  $stat=stat($file);
  header('Content-Type: '.$mime[substr($file,-3)]);
  header('Content-Length: '.$stat[7]);
  header('Last-Modified: '.gmdate('D, d M Y H:i:s',$stat[9]).' GMT');
  readfile($file);
  exit();
}
header('Pragma: no-cache');
header('Cache-Control: no-cache, no-store, must-revalidate');
include($file.'.php');
?>
