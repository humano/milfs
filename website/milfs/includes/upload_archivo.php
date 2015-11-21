<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['id'] ) ) {
 // Si no existe 
 header("Location: ../index.php");
// echo "hola mundo2";
}
// Script Que copia el archivo temporal subido al servidor en un directorio.
$tipo = $_FILES['fileUpload']['type'];
// Definimos Directorio donde se guarda el archivo
$dir = '/tmp/';
// Intentamos Subir Archivo
// (1) Comprobamos que existe el nombre temporal del archivo
if (isset($_FILES['fileUpload']['tmp_name'])) {
	$size= $_FILES['fileUpload']['size'];
	$nombre =MD5(time()).".jpg";
// (2) - Comprobamos que se trata de un archivo de imágen
if ($tipo == 'text/csv' AND $size  <= 10000000 ) {
// (3) Por ultimo se intenta copiar el archivo al servidor.
$name = MD5(time()).".csv";
$nombre= "/tmp/".MD5(time()).".csv";
//if (!copy($_FILES['fileUpload']['tmp_name'],"$nombre"))
if (!move_uploaded_file($_FILES['fileUpload']['tmp_name'],$nombre))
//move_uploaded_file($tmp_name, "$uploads_dir/$name");
//chmod('$dir.$nombre',0755);
echo '<script>parent.resultadoUploadArchivo(1,"'.$nombre.'","aviso_archivo");</script> ';
else{
echo '<script>parent.resultadoUploadArchivo(0, "'.$name.'","aviso_archivo");</script> ';
}
}
else echo '<script>parent.resultadoUploadArchivo(2, "","aviso_archivo");</script> ';
}
else{
echo '<script>parent.resultadoUploadArchivo(3, "","aviso_archivo");</script> ';
}
?>

