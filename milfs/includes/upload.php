<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['id'] ) ) {
 // Si no existe 
 //header("Location: ../../../includes/error.php");
// echo "hola mundo2";
}

$imagen= $_REQUEST[id_imagen];
if($_REQUEST[u] == "escritorio") {$respuesta = "escritorio/";}
// Script Que copia el archivo temporal subido al servidor en un directorio.
$tipo = $_FILES['fileUpload']['type'];
if($tipo=="image/png") {$ext = ".png";	} elseif($tipo=="image/jpeg") {$ext = ".jpg";	}
else {$ext = "novalida";} 
// Definimos Directorio donde se guarda el archivo
//$dir = '../../../images_secure';
// Intentamos Subir Archivo
// (1) Comprobamos que existe el nombre temporal del archivo


if (isset($_FILES['fileUpload']['tmp_name'])) {
	$size= $_FILES['fileUpload']['size'];
//	$nombre =MD5(time()).".jpg";
// (2) - Comprobamos que se trata de un archivo de imágen
//if ($tipo == 'image/jpeg' AND $size  <= 4000000 ) {
	$upload_size = ($_SESSION[upload_size]*1024*1024);
if (($tipo == 'image/jpeg' or $tipo =='image/png') AND $size  <= $upload_size ) {
// (3) Por ultimo se intenta copiar el archivo al servidor.
$name = MD5(time())."$ext";
$nombre= "$_SESSION[path_images_secure]/full/".$name;
$imagenX = $_FILES[fileUpload][tmp_name];
$coordenadas = leer_exif($imagenX);
if($coordenadas !='') { $alerta = "alert('Se han detectado coordenadas en los metadatos de la imagen y se ubicará el mapa en ese lugar.');";}
//if (!copy($_FILES['fileUpload']['tmp_name'],"$nombre"))
if (!move_uploaded_file($_FILES['fileUpload']['tmp_name'],$nombre))
//move_uploaded_file($tmp_name, "$uploads_dir/$name");
//chown($nombre,www-data);

echo '<script>parent.resultadoUpload(1, " '.$size.'");</script> ';
else{
/*	echo generar_miniatura_alto($name,"150");
	echo generar_miniatura_alto($name,"300");
	echo generar_miniatura_alto($name,"600");
	*/
	echo generar_miniatura($name,"150");
	echo generar_miniatura($name,"300");
	echo generar_miniatura($name,"600");
	///$name= "$name?$coordenadas"
echo " <script>parent.resultadoUpload(0, '$name','$_SESSION[url]/','$imagen','$coordenadas'); $alerta </script> ";
}
}
else echo "<script>parent.resultadoUpload(2,'','$_SESSION[url]/','$imagen');</script> ";

}
else{
echo "<script>parent.resultadoUpload(3,'','".$imagen."');</script>";
}

function generar_miniatura($file,$width) {//$archivo = $file;
$archivo = "$_SESSION[path_images_secure]/full/".$file;// Ponemos el . antes del nombre del archivo porque estamos considerando que la ruta está a partir del archivo thumb.php$file_info = getimagesize($archivo);// Obtenemos la relación de aspecto$ratio = $file_info[0] / $file_info[1];// Calculamos las nuevas dimensiones$newwidth = $width;$newheight = round($newwidth / $ratio);// Sacamos la extensión del archivo$ext = explode(".", $file);$ext = strtolower($ext[count($ext) - 1]);if ($ext == "jpeg") $ext = "jpg";// Dependiendo de la extensión llamamos a distintas funcionesswitch ($ext) {        case "jpg":                $img = imagecreatefromjpeg($archivo);        break;        case "png":                $img = imagecreatefrompng($archivo);        break;        case "gif":                $img = imagecreatefromgif($archivo);        break;}// Creamos la miniatura$thumb = imagecreatetruecolor($newwidth, $newheight);// La redimensionamosimagecopyresampled($thumb, $img, 0, 0, 0, 0, $newwidth, $newheight, $file_info[0], $file_info[1]);// La mostramos como jpg//header("Content-type: image/jpeg");imagejpeg($thumb,"$_SESSION[path_images_secure]/".$width."/$file", 80);
//imagejpeg($thumb,null, 80);
}
function generar_miniatura_alto($file,$alto) {//$archivo = $file;
$archivo = "$_SESSION[path_images_secure]/full/".$file;// Ponemos el . antes del nombre del archivo porque estamos considerando que la ruta está a partir del archivo thumb.php$file_info = getimagesize($archivo);// Obtenemos la relación de aspecto$ratio =   $file_info[1]/$file_info[0];// Calculamos las nuevas dimensiones
$newheight = $alto;$newwidth = round($newheight / $ratio);// Sacamos la extensión del archivo$ext = explode(".", $file);$ext = strtolower($ext[count($ext) - 1]);if ($ext == "jpeg") $ext = "jpg";// Dependiendo de la extensión llamamos a distintas funcionesswitch ($ext) {        case "jpg":                $img = imagecreatefromjpeg($archivo);        break;        case "png":                $img = imagecreatefrompng($archivo);        break;        case "gif":                $img = imagecreatefromgif($archivo);        break;}// Creamos la miniatura$thumb = imagecreatetruecolor($newwidth, $newheight);// La redimensionamosimagecopyresampled($thumb, $img, 0, 0, 0, 0, $newwidth, $newheight, $file_info[0], $file_info[1]);// La mostramos como jpg//header("Content-type: image/jpeg");imagejpeg($thumb,"$_SESSION[path_images_secure]/".$alto."/$file", 80);
//imagejpeg($thumb,null, 80);
}

// Convertir un string "1/123" a su representación float
function exif_float($value) {
  $pos = strpos($value, '/');
  if ($pos === false) return (float) $value;
  $a = (float) substr($value, 0, $pos);
  $b = (float) substr($value, $pos+1);
  return ($b == 0) ? ($a) : ($a / $b);
} 

function leer_exif($file){
	//$file = "/var/www/html/milfs/images/gps.jpg";
	$exif = exif_read_data( $file );
if ( !empty($exif['GPSLongitude']) && !empty($exif['GPSLatitude']) ) {
    $d = (float) $exif['GPSLongitude'][0];
    $m = exif_float($exif['GPSLongitude'][1] );
    $s = exif_float( $exif['GPSLongitude'][2] );
     
    $gps_longitude = (float) $d + $m/60 + $s/3600;
    if ( $exif['GPSLongitudeRef'] == 'W')
        $gps_longitude = -$gps_longitude;
     
    $d = $exif['GPSLatitude'][0];
    $m = exif_float($exif['GPSLatitude'][1] );
    $s = exif_float( $exif['GPSLatitude'][2] );
     
    $gps_latitude = (float) $d + $m/60 + $s/3600;
    if ( $exif['GPSLatitudeRef'] == 'S')
        $gps_latitude = -$gps_latitude;
        if($gps_latitude !='') {
  $resultado =   "$_SESSION[url]/mapa.php?lon=$gps_latitude&lat=$gps_longitude&zoom=18";
										  }else{$resultado ="";}
//$resultado = "$gps_longitude $gps_latitude";        
        
        return $resultado;
}
}

?>

