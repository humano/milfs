<?php
session_start();
 if ( isset ( $_SESSION['id'] ) ) {}else{
 header ("Location: index.php");}
//ini_set('display_errors', 'On');
//require ('../includes/funciones.php');

header('Content-Type: text/xml'); 	
	$fecha_inicio = mysql_seguridad($_REQUEST[inicio]);
	$fin = mysql_seguridad($_REQUEST[fin]);
	$perfil = mysql_seguridad($_REQUEST[form_id_id]);
	$id_campo = mysql_seguridad($_REQUEST[id_campo]);
	$busqueda = mysql_seguridad($_REQUEST[cadena]);
	  
$link=Conectarse();
if($perfil !=''){$perfil ="AND form_id = '$perfil'";}Else{$perfil ='';}

if($formato =='csv') {$orden = "ORDER BY form_datos.id ASC ";}
if($id_campo ==''){$campo ='';}else{$campo ="AND id_campo = '$id_campo'";}
if($busqueda !=''){$busca ="AND contenido LIKE '$busqueda'";}Else{$busca ='';}



	
	$consulta = "	SELECT  *,form_campos.id AS id_campo, from_unixtime(timestamp) AS fecha , form_datos.id AS form_datos_id
					FROM form_datos, form_campos ,form_contenido_campos
					WHERE form_datos.id_campo = form_campos.id 
					AND  (form_datos.form_id = form_contenido_campos.id_form AND form_datos.id_campo = form_contenido_campos.id_campo ) 
					$busca 
					$perfil 
					$campo  
					AND timestamp BETWEEN UNIX_TIMESTAMP('$fecha_inicio') 
					AND UNIX_TIMESTAMP('$fin 23:59:59') $orden";
					
 //echo $consulta;

	mysql_query("SET NAMES 'UTF-8'");


 $resultado = mysql_query($consulta,$link) or die("error al ejecutar consulta $consulta ");
  $fecha = time (); 
  $fecha=date ( "D, d M Y" , $fecha );



  echo "<?xml version='1.0' encoding='utf-8'?>
 <kml xmlns='http://www.opengis.net/kml/2.2'>
 	<Document>
   	<name>KML con Más de un punto</name>
    	<Folder>";

mysql_data_seek($resultado, 0);
    while ($fila = mysql_fetch_array($resultado)) { 
		$formulario_nombre = remplacetas('form_id','id',$fila[form_id],'nombre') ;
		$formulario_nombre = utf8_encode($formulario_nombre[0]);
		$title = utf8_encode($fila[item_title]);
		$description = utf8_encode($fila[item_description]); 
  		$content = utf8_encode($fila[item_content]);
  		$contenido = utf8_encode($fila[contenido]);
  		$campo = utf8_encode($fila[campo_nombre]);
//$resultado .= "<tr><td>$row[form_datos_id]</td><td>$row[fecha]</td><td>$row[timestamp]</td><td nowrap><a >$formulario_nombre[0]</a></td><td>$row[campo_nombre]</td><td>$row[contenido]</td></tr>";
    echo "
    	<placemark>
	      <name>$formulario_nombre</name>
	      <id_form>$fila[form_id]</id_form>
	      <id_campo>$fila[id_campo]</id_campo>
	      <campo>$campo</campo>
	      <contenido><![CDATA[$contenido]]></contenido>
	      <timestamp>$fila[fecha]</timestamp>
	      <control>$fila[control]</control>
	      <id_usuario>$fila[id_usuario]</id_usuario>

  		</placemark>";
  }
  echo "
  		</Folder>
	</Document>
</kml>";
 
function Conectarse(){
	if ( !isset ( $link ) ) {
		
	include("includes/datos.php");
   		if(!isset($db)) {
  // include("escritorio/includes/datos.php");
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
   

   return $link;
   }
}

function mysql_seguridad($inp) { 
    if(is_array($inp)) 
        return array_map(__METHOD__, $inp); 

    if(!empty($inp) && is_string($inp)) { 
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\*", "\\*", '\\Z'), $inp); 
    } 

    return $inp; 
}

function remplacetas($tabla,$campo,$valor,$por,$and){

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($and !=''){$AND = "AND $and";}
$consulta = "SELECT * FROM $tabla 
						WHERE $campo = '$valor' $AND order by id DESC limit 1";
$sql=mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
$resultado[] = mysql_result($sql,0,$por);
$resultado[] = mysql_result($sql,0,id);
$resultado[] = $consulta;
										}else{$resultado[0] = '';
										$resultado[1] ="";
										$resultado[2] = $consulta;}
return $resultado;
} 
//
?>
