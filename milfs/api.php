<?php
session_start();
//ini_set('display_errors', 'On');
require ('xajax/xajax.inc.php');
$xajax = new xajax();
require ('funciones/funciones.php');

$datos[id]=$_REQUEST[id];
$datos[identificador]=$_REQUEST[identificador];
$datos[dato]=$_REQUEST[dato];
header('Content-Type: application/json');

echo json($datos);

?>