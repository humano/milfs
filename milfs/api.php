<?php
session_start();
//ini_set('display_errors', 'On');
require ('xajax/xajax.inc.php');
$xajax = new xajax();
require ('funciones/funciones.php');
require ('funciones/convert.php');
require ("includes/markdown.php");
require ("funciones/conex.php");
$datos[id]=$_REQUEST[id];
$datos[identificador]=$_REQUEST[identificador];
$datos[dato]=$_REQUEST[dato];
$datos[inicio]=$_REQUEST[inicio];
$datos[fin]=$_REQUEST[fin];
$datos[tipo]=$_REQUEST[tipo];

header('Content-Type: application/json');

echo json($datos);

?>
