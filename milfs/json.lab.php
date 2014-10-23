<?php
//ini_set('display_errors', 'On');
require ('xajax/xajax.inc.php');
$xajax = new xajax();
require ('funciones/funciones.php');
require ('funciones/convert.php');

	$fecha_inicio = mysql_seguridad($_REQUEST[inicio]);
	$fin = mysql_seguridad($_REQUEST[fin]);
	$perfil = mysql_seguridad($_REQUEST[id]);
	$id2 = mysql_seguridad($_REQUEST[id2]);

	$perfil2 = mysql_seguridad($_REQUEST[id2]);
	$id = mysql_seguridad($_REQUEST[id]);
	$busqueda = mysql_seguridad($_REQUEST[cadena]);
	$campo = buscar_campo_tipo($id,"14");
	$id_campo = $campo[0];
	$campo2 = buscar_campo_tipo($id2,"14");
	$id_campo2 = $campo2[0];
		if($id2 !=""){$w_id2 =" OR form_id = '$id2'"; $or_2 ="or id_campo = '$id_campo2'";}
	  
$link=Conectarse();
/*
	$consulta = "	SELECT  distinct(contenido) as data, control,form_datos.form_id as id, timestamp
					FROM form_datos
					WHERE form_datos.id_campo = '$id_campo' 
					AND form_id = '$id' 
					";
					*/
						$consulta = "SELECT  form_id as id, control, GROUP_CONCAT(contenido  ORDER by timestamp desc ) as data  
											FROM `form_datos` 
											WHERE (form_id = '$id' $w_id2 )
											AND ( id_campo ='$id_campo' $or_2 ) $valor
											group by  control  
											ORDER BY  rand(),orden  desc limit 1 ";



 //echo $consulta;

	mysql_query("SET NAMES 'UTF8'");


 $sql = mysql_query($consulta,$link) or die("error al ejecutar consulta $consulta ");
 if (mysql_num_rows($sql)!='0'){
	$id = 1;
	$features = array();
while( $row = mysql_fetch_array( $sql ) ) {
	$marcador = array();
	$propiedades = array();
		//$marcador["id"] = $id;
		//$titulo = remplacetas("form_datos","control","$row[control]","contenido","id_campo ='28' AND timestamp ='$row[timestamp]'");
		//$marcador["id"] = $id;
		//$identificador=mysql_result($sql,0,"identificador");
		$identificador = explode(',',$row[data]);
		$identificador = $identificador[0]; 
		$campos = explode(" ",$identificador);
														$lat = $campos[0];
														$lon = $campos[1];
														$zoom = $campos[2];	
		$marcador["type"] = "Point";
		$marcador["coordinates"] = array($lat,$lon);
		//$marcador["loc"] = array('lat'=>$lat,'lon'=>$lon);
		
		$formulario = formulario_imprimir($row[id],$row[control],'full');
		$propiedades = formulario_imprimir_linea($row[id],$row[control],"array");//
		$propiedades["name"] ="<div class='container-fluid' id='contenedor_datos' >$formulario</div>";
		//$propiedades["title"] ="images/pin.png";
		//$propiedades[icon][iconUrl] = "images/pin.png";
		
		//formulario_imprimir($id,$control)
		//$marcador["zoom"] = $zoom;
		//$geometria .= "{\"type\":\"Feature\",\"geometry\":".json_encode($marcador,JSON_NUMERIC_CHECK).",\"properties\":{}},";
		$geometria .= "{\"type\":\"Feature\",\"geometry\":".json_encode($marcador,JSON_NUMERIC_CHECK|JSON_PRETTY_PRINT).",\"properties\":".json_encode($propiedades,JSON_NUMERIC_CHECK|JSON_PRETTY_PRINT)."},";
		$features[] = $marcador;
 //$resultado .= "<li> $row[tipo]<br> <a href=\"#\" onclick=\"javascript:loadMarker($id);return false;\"><b>$row[title]</b></a><br>$row[description]<hr> </li>";
															
															$id++;
															}

}
/*
//encode and output jsonObject
header('Content-Type: text/plain');
//echo $consulta;
$resultado = " { \"type\": \"FeatureCollection\",
    \"features\": ";
$resultado .= json_encode($features,JSON_NUMERIC_CHECK);
$resultado .= "}";
//echo $resultado;
$geometria = substr("$geometria",0,-1);
$geometria = "{
    \"type\": \"FeatureCollection\",
    \"features\": [$geometria ]}";
return $geometria; 
*/

//-75.58295 6.25578 16
//{"geometry": {"type": "Point", "coordinates": [48.460711540220927, 39.562486386735543]}, "type": "Feature", "properties": {}}
//encode and output jsonObject
header('Content-Type: application/json');
//echo $consulta;
//$resultado = " { \"type\": \"FeatureCollection\", \"features\": ";
$resultado .= json_encode($features,JSON_NUMERIC_CHECK|JSON_PRETTY_PRINT);
//$resultado .= "}";
//echo $resultado;
$geometria = substr("$geometria",0,-1);
/*$geometria = "{
    \"type\": \"FeatureCollection\",
    \"features\": [$geometria ]}";
    */
echo $geometria;

?>