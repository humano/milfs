<?php
function buscar_campo_tipo($id,$tipo) {
$consulta ="SELECT form_campos.id, form_campos.campo_nombre FROM form_tipo_campo,form_campos,form_contenido_campos
					WHERE form_tipo_campo.id_tipo_campo = form_campos.campo_tipo
                    AND form_contenido_campos.id_campo = form_campos.id
					AND form_tipo_campo.id_tipo_campo = '$tipo'
					AND form_contenido_campos.id_form = '$id'";
	$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
		$sql=mysql_query($consulta,$link);
		if (mysql_num_rows($sql)!='0'){
		$resultado[0]=mysql_result($sql,0,"id");
		$resultado[1]=mysql_result($sql,0,"campo_nombre");
		$resultado[2] =$consulta;
											}else{ $resultado[0]='';}
return $resultado;
}


function formulario_contar($id) {
$consulta ="SELECT count(control) as cantidad FROM form_datos WHERE form_id = '$id' GROUP BY form_id,id_campo order by cantidad DESC LIMIT 1 ";
	$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
		$sql=mysql_query($consulta,$link);
		if (mysql_num_rows($sql)!='0'){
		$resultado=mysql_result($sql,0,"cantidad");
		}else {$resultado ='';}
return $resultado;
}

function formulario_uso($id,$id_campo,$tipo) {
	if($tipo =='primer') {$orden = 'ASC';}
	if($tipo =='ultimo') {$orden = 'DESC';}
$consulta ="SELECT *  FROM form_datos WHERE form_id = '$id' order by timestamp $orden LIMIT 1 ";
	$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
		$sql=mysql_query($consulta,$link);
		if (mysql_num_rows($sql)!='0'){
		$resultado[0]=mysql_result($sql,0,"timestamp");
		$resultado[1]=mysql_result($sql,0,"control");
		$resultado[2]=$consulta;
		}else {}
return $resultado;
}


function empresa_datos($id_empresa,$tipo) {
			$direccion =  remplacetas("empresa","id",$id_empresa,"direccion","");
		$telefono =  remplacetas("empresa","id",$id_empresa,"telefono","");
		$web =  remplacetas("empresa","id",$id_empresa,"web","");
		$email =  remplacetas("empresa","id",$id_empresa,"email","");
		$imagen =  remplacetas("empresa","id",$id_empresa,"imagen","");
		$razon_social =  remplacetas("empresa","id",$id_empresa,"razon_social","");
		$slogan =  remplacetas("empresa","id",$id_empresa,"slogan","");
	if($tipo=='encabezado') {

$resultado ="
<div class=''>
	<img class='img-responsive' src='images/secure/?file=600/$imagen[0]'>
	<div class='caption'>
	<h3>$razon_social[0]</h3>
	<p class='lead'>$slogan[0]</p>
	</div>
</div>
";
}elseif($tipo=='pie') {

	$resultado = "<div class='small'>$razon_social[0] | <a href='$web[0]' target='web'>$web[0]</a> | $direccion[0] | $email[0] </div>";
}
return $resultado;
}
function configuracion($accion) {
	if ( !isset ( $_SESSION['id'] ) ) {	return;}
	$div='contenido';
if($accion =='') {
$link ="<a title='Configuración' href='#' onclick=\"xajax_configuracion('mostrar') \"><i class='fa fa-cogs'></i></a>";
print $link;
return;
}elseif($accion=='mostrar') {
	$respuesta = new xajaxResponse('utf-8');
	$resultado ="<h1><i class='fa fa-cogs'></i> Configuración</h1>";
	$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
	$consulta = "SELECT * FROM empresa WHERE  id = '$_SESSION[id_empresa]' LIMIT 1";
		$sql=mysql_query($consulta,$link);
		$empresa_razon_social = editar_campo("empresa","$_SESSION[id_empresa]","razon_social","");
		$empresa_slogan = editar_campo("empresa","$_SESSION[id_empresa]","slogan","");
		$empresa_direccion = editar_campo("empresa","$_SESSION[id_empresa]","direccion","");
		$empresa_telefono = editar_campo("empresa","$_SESSION[id_empresa]","telefono_1","");
		$empresa_web = editar_campo("empresa","$_SESSION[id_empresa]","web","");
		$empresa_email = editar_campo("empresa","$_SESSION[id_empresa]","email","");
			$background =  remplacetas("empresa","id",$_SESSION[id_empresa],"imagen","");
			$background_imagen = "images/secure/?file=600/$background[0]"; 
		$nombre = editar_campo("usuarios","$_SESSION[id]","p_nombre","");
		$apellido = editar_campo("usuarios","$_SESSION[id]","p_apellido","");
		$email = editar_campo("usuarios","$_SESSION[id]","email","");
		$username = editar_campo("usuarios","$_SESSION[id]","username","");

		$subir_imagen = subir_imagen();	
		$subir_imagen .= "<input name='imagen' id='imagen' type='hidden' >
						<div onclick = \"xajax_cambiar_imagen((document.getElementById('imagen').value),'empresa','$_SESSION[id_empresa]') \"; 
								class='btn btn-success'>Cambiar imagen</div>";	
	$resultado .="
				<div class='img-round ' id='banner' style=' 

					background-position:top center  ;
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
					
					background-repeat:no-repeat;
					background-image: url($background_imagen ) ; 	
					padding:10px;
					padding:10px; height:300px;
					
					'>

						<div style='position:relative; top:120px;';>
								$subir_imagen
						</div>
				</div>
				<div class='row'>
					<div class='col-sm-6'>
						<h2>Datos de la institución</h2>
						
							<li>$empresa_razon_social</li>
							<li>$empresa_slogan</li>
							<li>$empresa_direccion</li>
							<li>$empresa_telefono</li>
							<li>$empresa_web</li>
							<li>$empresa_email</li>
							
						
					</div>
					<div class='col-sm-6'>
						<h2>Datos del usuario</div>
						
						<li>$username</li>
						<li>$nombre</li>
						<li>$apellido</li>
						<li>$email</li>
						
					</div>
				</div>
				

					";
	/*if (mysql_num_rows($sql)!='0'){
	mysql_data_seek($sql, 0);
	$resultado .="";
	while( $row = mysql_fetch_array( $sql ) ) {

															}
											
											}
											*/
	$respuesta->addAssign($div,"innerHTML",$resultado);

}

return $respuesta;
}
$xajax->registerFunction("configuracion");


function cambiar_imagen($imagen,$tabla,$id) {
	$respuesta = new xajaxResponse('utf-8');
$link = Conectarse();
mysql_query("SET NAMES 'utf8'");
$consulta = "UPDATE $tabla SET `imagen` = '".$imagen."' WHERE `id` = '$id';";
	$sql_consulta=mysql_query($consulta,$link);
	if($sql_consulta) {
if($tabla =='empresa') {
	$respuesta->addAssign("banner","style.backgroundImage","url('images/secure/?file=600/$imagen')");
	$respuesta->addAssign("formUpload","innerHTML","");
}

	//$respuesta->addAlert("$consulta");
return $respuesta;
}
}
$xajax->registerFunction("cambiar_imagen");




function limpiar_caracteres($valor){
$b=array("{","}","]","/","[",";","Â¡","!","Â¿","?","'",'"',"'" );
$c=array(" "," "," "," "," "," "," "," "," "," "," ","");
$resultado=str_replace($b,$c,$valor);
return $resultado ;
}

function actualizar_campo($tabla,$key,$campo,$valor,$accion,$div) {
	$valor = limpiar_caracteres($valor);
$respuesta = new xajaxResponse('utf-8');
	$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
	$edit = "UPDATE  $tabla SET  $campo =  '$valor' WHERE id = '$key' limit 1; ";
	$sql=mysql_query($edit,$link);
		if(mysql_affected_rows($link) != 0){

														}
//$respuesta->addAssign($div,"innerHTML","$sql $edit");
									return $respuesta;					
}
$xajax->registerFunction("actualizar_campo");

function editar_campo($tabla,$key,$campo,$valor,$accion,$div){
	if ( !isset ( $_SESSION['id'] ) ) {	return;}
		////NO SE PUEDE EDITAR EL CAMPO (id )

//	
if($div=='') {$div = "div_$tabla".$campo;}
else {$div = $div;}
		$respuesta = new xajaxResponse('utf-8');
		$valor = limpiar_caracteres($valor);
		
	$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
	$consulta = "SELECT id, $campo AS valor FROM $tabla WHERE  id = '$key' LIMIT 1";
	$sql_consulta=mysql_query($consulta,$link);
	$Valor = mysql_result($sql_consulta,0,"valor");


if($accion == 'cerrar')	{
		$campo = editar_campo("$tabla","$key","$campo","$valor","");
$respuesta->addAssign($div,"innerHTML",$campo);
return $respuesta;
								}
elseif($accion=="input") {
		$size= strlen($Valor);
		$placeholder = strtoupper(limpiar_caracteres($campo));
if($size < 40) {
		$resultado = "
		<div class='' style='display:inline; border: solid 1px #BFBFBF ;'>
			<a  onclick=\"xajax_editar_campo('$tabla','$key','$campo','$Valor','cerrar','$div'); \">
				<i class=' fa fa-times-circle'></i>
			</a>
			<a onclick=\"xajax_editar_campo('$tabla','$key','$campo',(document.getElementById('".$campo."_".$id."".$rrn."').value),'grabar','$div'); \" > 
				<i class='fa fa-save'> </i>	
			</a>
			 	<input placeholder='$placeholder'  class='form-control' style=' min-width:100px; margin-right:10px; display:inline; width:".$size."em;' type='text' value='$Valor' id='".$campo."_".$id."".$rrn."' name='".$campo."_".$id."".$rrn."' >
			 	
		</div>
	";
		}else {
		$resultado = "
		<div class='' style='display:inline; border: solid 1px #BFBFBF ;'>
			<a  onclick=\"xajax_editar_campo('$tabla','$key','$campo','$Valor','cerrar','$div'); \">
				<i class=' fa fa-times-circle'></i>
			</a>
			<a onclick=\"xajax_editar_campo('$tabla','$key','$campo',(document.getElementById('".$campo."_".$id."".$rrn."').value),'grabar','$div'); \" > 
				<i class='fa fa-save'> </i>	
			</a>
			 	<textarea placeholder='$placeholder'  class='form-control' id='".$campo."_".$id."".$rrn."' name='".$campo."_".$id."".$rrn."' >$Valor
			 	</textarea>
			 	
		</div>
	";
		}
								}
elseif($accion== "grabar"){

	$edit = "UPDATE  $tabla SET  $campo =  '$valor' WHERE id = '$key' limit 1; ";
	$sql=mysql_query($edit,$link);
		if(mysql_affected_rows($link) != 0){

														}
		$campo = editar_campo("$tabla","$key","$campo","$valor","");
		$respuesta->addAssign($div,"innerHTML",$campo);
	return $respuesta;


								}
								
else{
			if (mysql_num_rows($sql_consulta)!='0'){
		$valor=mysql_result($sql_consulta,0,"valor");
		
		/////// campos que no se muestran ///
if($campo == 'id' OR $campo == 'id_usuario' OR $campo == 'id_empresa' OR $campo == 'id_grupo') {
return ;
}

     /////////// campos que se muestran para edicion //////////////
     		$title = strtoupper(limpiar_caracteres($campo));
  $div= rand(123,999);
  if($valor =="") {$aviso="<small>$title</small>";}else{}
$campo ="
	
				<div style='display:inline;' id='$div' title='$title'>
					<a  onclick=\"xajax_editar_campo('$tabla','$key','$campo','','input','$div') \" >
					<small><i   class='fa fa-edit'></i></small>
					$valor $aviso</a>
				</div>
	
					";
													}
	else {$campo = "nada";}
		
		return $campo;
}

$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;

}
//is_numeric($valor)
$xajax->registerFunction("editar_campo");




function formulario_imprimir($id,$control) {
	$id = mysql_seguridad($id);
	if($id !='') {$w_id = "AND form_id = '$id'";}
	$control = mysql_seguridad($control);
	$consulta = "SELECT form_datos.*,campo_nombre, contenido, campo_tipo FROM form_datos, form_campos 
						WHERE form_datos.id_campo = form_campos.id 
						AND control ='$control' 
						$w_id GROUP BY form_datos.id_campo order by form_datos.timestamp DESC 
						";
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$sql=mysql_query($consulta,$link);
 
$timestamp=mysql_result($sql,0,"timestamp");
$fecha  = date ( "Y-m-d h:i:s" , $timestamp);

if (mysql_num_rows($sql)!='0'){
	mysql_data_seek($sql, 0);
	$resultado ="
						<table class='table' >";
	while( $row = mysql_fetch_array( $sql ) ) {
		if($row[campo_tipo]=='15'){$contenido = "<img class='img-thumbnail responsive' src='images/secure/?file=600/$row[contenido]'>"; }
		elseif($row[campo_tipo]=='14'){
													$campos = explode(" ",$row[contenido]);
														$lat = $campos[0];
														$lon = $campos[1];
														$zoom = $campos[2];			
			$contenido = "<img class='img-thumbnail responsive'  src='http://dev.openstreetmap.de/staticmap/staticmap.php?center=$lon,$lat&zoom=$zoom&size=150x150&maptype=mapnik&markers=$lon,$lat,red-pushpin' >"; 
			}
		else {$contenido = "$row[contenido]";}
	$resultado .= "<tr><td>$row[campo_nombre]</td><td>$contenido</td></tr>";
															}
	$resultado .="</table>
	<div class='badge pull-right'>Datos registrados el $fecha </div>
	";
}
	return $resultado;
}

function formulario_respuesta($id,$control) {
	$id = mysql_seguridad($id);
	$consulta = "SELECT * FROM form_id 
						WHERE formulario_respuesta = '$id' 
						";
					
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$sql=mysql_query($consulta,$link);
 
if (mysql_num_rows($sql)!='0'){
	mysql_data_seek($sql, 0);
	$resultado ="<div class='alert alert-warning'>
	<h4>Responder con:</h4>
						<table class='table table-condensed '>";
	while( $row = mysql_fetch_array( $sql ) ) {
		$resultado .= "<tr><td><a href ='?id=$row[id]&c=$control&t=r' title='$row[descripcion]'>$row[nombre]</a></td></tr>";

}
	$resultado .="</table></div>";	
}else{$resultado ="";}
return $resultado;
}

function subir_imagen($respuesta){
	//if ( !isset ( $_SESSION['id'] ) ) {	return;}
///vinculado con la funcion de javascript resultadoUpload(estado, file)  que esta en librerias/scripts.js

$javascript="includes/upload.php";
$resultado .="
<form method='post' class='form' enctype='multipart/form-data'
action=  $javascript 
target='iframeUpload' class='form-horizontal'>
<input class='form-control'  name='fileUpload' type='file' onchange=\"submit()\" />
<iframe name='iframeUpload' style='display:none' ></iframe>
<div class='alert alert-info text-center' id='formUpload'>La imagen debe estar en formato .jpg y de tamaño m&aacute;ximo 4MB </div>
</form> ";
return $resultado;
 
}

function formulario_importador($accion) {
	
	if($accion =='') {
	$resultado="<a href='#' onclick =\"xajax_formulario_importador('formulario'); \"><i class='fa fa-upload'></i> Importador</a>";	
	print $resultado;
	return;	
		}
			$respuesta = new xajaxResponse('utf-8');
			$formulariox =formulario_importar('','menu','');
			$resultado="$formulariox <div id='importador' name='importador'></div> ";
			$respuesta->addAssign("contenido","innerHTML","$resultado");
			return $respuesta;
}
$xajax->registerFunction("formulario_importador");


function subir_archivo($perfil){
///vinculado con la funcion de javascript resultadoUpload(estado, file)  que esta en librerias/scripts.js
$javascript="includes/upload_archivo.php";
$resultado .="
<form method='post' enctype='multipart/form-data'
action=  $javascript 
target='iframeUploadArchivo'>
<input id=perfil name=perfil value=$perfil type='hidden' >
Archivo formulario $perfil: <input class='form-control' name='fileUpload' type='file' onchange=\"submit()\" />
<iframe name='iframeUploadArchivo' style='display:none' ></iframe>
<div style='display:inline' id='aviso_archivo'>M&aacute;ximo 1MB </div>

</form> ";


return $resultado;
 
}
					
					
function formularios_muestra_listado($formulario){

		if($formulario==''){
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT * FROM form_id WHERE id_empresa = '$_SESSION[id_empresa]' ORDER BY nombre ";
$sql=mysql_query($consulta,$link);
///$Documento=mysql_result($grupo,0,"documento_numero");

if (mysql_num_rows($sql)!='0'){
	mysql_data_seek($sql, 0);
	$resultado .="<select class='form-control' id='seleccion_formulario'  name='seleccion_formulario' onchange =\"xajax_formularios_muestra_listado((this.value)) \" >";
	$resultado .= "<option value=''>Seleccionar formulario a importar</option>";
$fila=0;
while( $row = mysql_fetch_array( $sql ) ) {
	$fila = $fila +1;
	if ($fila %2 == 0){$bg='LightCyan';}else{ $bg='FFFFFF';}
	//$producto = remplacetas('farmacia_cum','id',$row[id_producto],'fabricante_importador') ;
$resultado .= "<option value='$row[id]'> $row[nombre]</option>";
															}
															
	$resultado .="</select><br>";
										}else {$resultado = "";}
				//	print  $resultado;
					return $resultado;
		}else{
		$respuesta = new xajaxResponse('utf-8');
		$subir = subir_archivo($formulario) ;
		$div="importador_select";
		$resultado .= "$subir";
$respuesta->addAssign($div,"innerHTML",$resultado);
$respuesta->addAssign("importador_archivo","innerHTML","");



return $respuesta;
} 
}
$xajax->registerFunction("formularios_muestra_listado");
	
		
function formulario_importar($filename,$accion,$perfil){
		if($filename ===""){
		

		$formulario .= formularios_muestra_listado();

		$formulario .= "<div id=importador_select name=importador_select></div>
		<div id=importador_archivo name=importador_archivo></div> ";
	//print 	$formulario;		
return $formulario; 
		}
	
	$div = "importador_archivo";
$respuesta = new xajaxResponse('utf-8');
	$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
	//	$perfil_nombre = remplacetas_promiscuo('galenux_oncomedic.consulta_tipo','id_consulta_tipo',$perfil,'consulta_tipo_nombre') ;
 $resultado .= "Importando formulario <b>$perfil_nombre</b> ($perfil)
  <table class='table table-bordered table-striped'>";
	$nombre = "tmp/$filename";
	if($accion == "grabar") {

	}
	if (($handle = fopen($nombre, 'r')) !== FALSE)
    { 

    while (($data = fgetcsv($handle, 1000, ';',$enclosure = '"' )) !== FALSE)
    { 
if ($fila >=1)
    { 
$numero = count($data);
for ($c=0; $c < $numero; $c++) {   } 

foreach($data as $row) {
$control=md5($perfil.$fila.time()); 
$ip =  obtener_ip();
//$control =$fila;
      $valores = explode( '|', $row );
      $resultado .= "<tr>";
      $numero_columna = 0;
      $grabar = "";
      $consulta="";
      $consulta_campos = "";
      foreach ($valores as $columna){
      	      $grabar = "";

$resultado .= "<td >$columna </td>"; // Muestra todos los campos de la fila actual 
if($columna !=""){

	if($accion === "grabar"){

		$graba_ip = " ip = INET_ATON('".$ip."') ";
$consulta_campos = "INSERT INTO form_datos SET timestamp= '".time()."', id_usuario='$_SESSION[id]',id_empresa='$_SESSION[id_empresa]',form_id ='$perfil',
$graba_ip ,
control = '$control', $consulta id_campo = '$campo[$numero_columna]' , contenido = '$columna'"; 
		  	$verificar_campo =   	formulario_verificar_campo($perfil,$campo[$numero_columna]);
  			if($verificar_campo == NULL){}else{
  				$sql = mysql_query($consulta_campos,$link);
  				}
	
									}

$sql_arreglo[timestamp] = time();
$sql_arreglo[id_empresa] = $_SESSION[id_empresa];
$sql_arreglo[id_especialista] = $_SESSION[id_usuario];
$sql_arreglo[id_campo] = $campo[$numero_columna];
$sql_arreglo[contenido]  = $columna;



					
}

$numero_columna ++;

}


if($accion ==="grabar"){



	$muestra_consulta = "Grabado";
		$respuesta->addAssign("aviso_archivo","innerHTML",$resultado);
	$respuesta->addScript("xajax_formulario_importar()");


	}else{$muestra_consulta ="";}
      $resultado .= "<td><!-- $grabar --> $error $muestra_consulta </td></tr>";
//$l++ ;

}

    } else{
  //  	foreach($data as $row) {
      $titulos = explode( '|', $data[0] );
      $resultado .= "<tr>";
      $posicion = 0;
      foreach($titulos as $titulo){
      	$campo[$posicion] = $titulo;
      	//if($titulo === "perfil" ){$perfil = $titulo;}else{$perfil="";}
      //	if($titulo === "control" ){$campo_control = $posicion;}else{}
//$verificado formulario_verificar_campo($perfil,$id_campo){
   	  //$verificar_campo =   	formulario_verificar_campo($perfil,$titulo);
  			//$verificar_campo = "(".$verificar_campo[2].")";
  			if($titulo == "usuario" or $titulo == "turno" or $titulo == "110" or $titulo == "perfil"){$verificar_campo ="";}else{
  			$verificar_campo =   	formulario_verificar_campo($perfil,$titulo);
  			if($verificar_campo == NULL){$verificar_campo ="<i class='fa fa-frown-o'></i>"; $class='danger';}
  			else{$verificar_campo ="<i class='fa fa-check-square-o'></i>"; $class='success';}
  		}
  			$verificar_campo = $verificar_campo;
$resultado .= "<th class='$class' >$titulo $verificar_campo</th>"; // Muestra todos los campos de la fila actual 
$posicion ++;
}
      $resultado .= "</tr>";
//}
   // $resultado .= "<b>$data[0]</b>";
    }
$fila++;
      } 
                $resultado .= "</table> $fila ";
     } 

$respuesta->addAssign($div,"innerHTML",$resultado);

return $respuesta;
} 
//is_numeric($valor)
$xajax->registerFunction("formulario_importar");


function formulario_verificar_campo($perfil,$id_campo){

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT *  FROM `form_contenido_campos` WHERE `id_form` = '$perfil' AND id_campo='$id_campo'";
$sql =mysql_query($consulta,$link);
$cant =mysql_num_rows($sql);

if (mysql_num_rows($sql) == '0'){
$existe = NULL;

										}else {

$control=mysql_result($sql,0,"control");
$obligatorio=mysql_result($sql,0,"obligatorio");
$existe[]= $control;
$existe[]= $obligatorio;
$existe[]= $consulta;

}

return $existe;
	}
	
function borrar_tmp($div) {
if($div =='') {
	$div="borra_tmp";
$resultado ="<a href='#'  onclick =\"xajax_borrar_tmp('$div');\">Limpiar</a>";
print $resultado;
return ;
}
$dir = "tmp/";
$ficheroseliminados= 0;
$handle = opendir($dir);
while ($file = readdir($handle)) {
 if (is_file($dir.$file)) {
  if ( unlink($dir.$file) ){
   $ficheroseliminados++;
  }
 }
}
$fecha = time (); 
$ahora  = date ( "Y-m-d h:i:s" , $fecha ); 
$resultado ="<div class='btn navbar-btn btn-warning' onclick =\"xajax_borrar_tmp('$div');\" ><i class='fa fa-trash-o'></i><small> $ahora<small></div>";
	$respuesta = new xajaxResponse('utf-8');
$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;

	}
$xajax->registerFunction("borrar_tmp");
	
function matriz_formulario($formulario,$div,$registros,$pagina,$formato){
	$id=mysql_real_escape_string($id);

$control = md5(rand(1,99999999).microtime());
$respuesta = new xajaxResponse('utf-8');
//$respuesta->addAssign($div,"innerHTML",$resultado);



$fecha_inicio = $formulario["inicio"];
$fin = $formulario["fin"];
$perfil = $formulario["form_id_id"];
if($perfil !=''){$perfil ="AND form_id = '$perfil'";}Else{$perfil ='';}
$id_campo = $formulario["id_campo"];
$busqueda = $formulario["busqueda"];
if($formato =='csv') {$orden = "ORDER BY form_datos_id ASC ";}else{$orden = "ORDER BY form_datos_id DESC ";}
if($id_campo ==''){$campo ='';}else{$campo ="AND id_campo = '$id_campo'";}
if($busqueda !=''){$busca ="AND contenido LIKE '$busqueda'";}Else{$busca ='';}

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
//UNIX_TIMESTAMP()
$consulta = "	SELECT  *,from_unixtime(timestamp) AS fecha , form_datos.id AS form_datos_id
					FROM form_datos, form_campos 
					WHERE form_datos.id_campo = form_campos.id AND form_datos.id_empresa = '$_SESSION[id_empresa]'
					$busca 
					$perfil 
					$campo  
					AND timestamp BETWEEN UNIX_TIMESTAMP('$fecha_inicio') 
					AND UNIX_TIMESTAMP('$fin 23:59:59') $orden";
					//ORDER BY formularios_datos.id DESC 
//$respuesta->addAssign($div,"innerHTML",$consulta);
//return $respuesta;

//$respuesta->addAlert("$consulta");return $respuesta;
$sql=mysql_query($consulta,$link);
///$Documento=mysql_result($grupo,0,"documento_numero");
//$resultado .= "<h1>$Valor , $formulario</h1>";
if (mysql_num_rows($sql)!='0'){
	if($formato=='csv'){ 
	$nombre_archivo ="tmp/Formulario_".mktime()."_".$_SESSION['id'].".csv";
	$resultado ="<a href='$nombre_archivo'>Descargar Archivo</a>";
$archivo_reporte=fopen($nombre_archivo , "w");

$encabezado =";;Periodo\n;;$inicio\n;;$fin \n ";
fputs ($archivo_reporte,$encabezado);
	$tabla .= "ID;Fecha;Timestamp;Formulario;Campo;Contenido;Control\n";
fputs ($archivo_reporte,$tabla);
while( $row = mysql_fetch_array( $sql ) ) {
		$formulario_nombre = remplacetas('form_id','id',$row[form_id],'nombre') ;

	
	//$producto = remplacetas('farmacia_cum','id',$row[id_producto],'fabricante_importador') ;
//$linea = "$row[id];$row[id_turno];$row[fecha];$row[timestamp];$identificacion_usuario;$EPS;$row[id_especialista];$formulario_nombre;$row[campo_nombre];'$row[contenido]'\n";
//$linea = array('$row[id]','$row[id_turno]','$row[fecha]','$row[timestamp]','$identificacion_usuario','$EPS','$row[id_especialista]','$formulario_nombre','$row[campo_nombre]','$row[contenido]');
$linea = array("$row[form_datos_id]","$row[fecha]","$row[timestamp]","$formulario_nombre[0]","$row[campo_nombre]","$row[contenido]","$row[control]");

fputcsv ($archivo_reporte,$linea,';');
															}
rewind($archivo_reporte);
/*/$output = stream_get_contents( $archivo_reporte );
fclose($archivo_reporte);
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=contact-'. time() .'.csv' );
header('Content-Length: '. strlen($output) );
return $output;
	*/
//$resultado .= "$consulta";
$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;
//$respuesta->addAlert("$consulta $total_registros");return $respuesta;	
	}
		}	else{
			$respuesta ="<div class='alert alert-warning'><i class='fa fa-exclamation-triangle'></i> No hay resultados</div>";
			$respuesta->addAssign($div,"innerHTML",$resultado);
		return $respuesta;
		}
		
		////fin de si hay resultados			
if ($pagina =='') {
   $inicio = 0;
   $pagina = 1;
}
else {
   $inicio = ($pagina - 1) * $registros;
}

$total_registros = mysql_num_rows($sql);
if($total_registros < $registros) {
$limite ="";
}else{
$limite ="  LIMIT $inicio, $registros ";
}


$consulta_limite = $consulta.$limite;
$sql=mysql_query($consulta_limite,$link);

if (mysql_num_rows($sql)!='0'){
	$resultado .= "<a onclick=\"xajax_limpia_div('resultados')\">Limpiar resultado</a> | ";
if($formato!='csv'){ 
	$resultado.= "<a onClick=\"xajax_matriz_formulario(xajax.getFormValues('peticion'),'resultados','','','csv');\">Exportar resultados a CSV</a>
	
	
	";
							}
	$resultado .="<table rules=groups>";
$total_paginas = ceil($total_registros / $registros); 
$indice .=  "<tr>";
if(($pagina - 1) > 0) {
$indice .=  "<td ><a title='Cambiar a la página ".($pagina-1)."'  onClick=\"xajax_matriz_formulario(xajax.getFormValues('peticion'),'resultados','$registros','".($pagina-1)."');\"' style='cursor:pointer'>< Anterior</a> </td>";
												}
															
for ($i=1; $i<=$total_paginas; $i++)
   if ($pagina == $i){
$indice .=  "<th>".$pagina."</th> ";
} else {
$indice .=  "
<td><a title='Cambiar a la pagina $i' onClick=\"xajax_matriz_formulario(xajax.getFormValues('peticion'),'resultados','$registros','$i');\"' style='cursor:pointer'>$i</a> </td>";
}

if(($pagina + 1)<=$total_paginas) {

$indice .= "<td><a  title='Cambiar a la pagina ".($pagina+1)."' onClick=\"xajax_matriz_formulario(xajax.getFormValues('peticion'),'resultados','$registros','".($pagina+1)."');\"' style='cursor:pointer'> Siguiente ></a></td>";
}

$indice .= "<hr><font size='-2'>Pagina <b>$pagina</b> de <b>$total_paginas</b> total registros: <b>$total_registros</b></font>
 </tr></table>";
$resultado .= $indice;


	mysql_data_seek($sql, 0);
	$resultado .=" <table  class='table'>";
	$resultado .= "<TR><TH COLSPAN='6'>MUESTRA $registros REGISTROS  de $total_registros</TH></TR>
	<tr><th>ID</th><th>Fecha</th><th>Timestamp</th><th>Formulario</th><th>Campo</th><th>Contenido</th></tr>";
$fila=0;
while( $row = mysql_fetch_array( $sql ) ) {
		$formulario_nombre = remplacetas('form_id','id',$row[form_id],'nombre') ;
	$fila = $fila +1;
	if ($fila %2 == 0){$bg='LightCyan';}else{ $bg='FFFFFF';}
	//$producto = remplacetas('farmacia_cum','id',$row[id_producto],'fabricante_importador') href ='?id=$row[form_id]&c=$row[control]'  ;
$resultado .= "<tr><td>$row[form_datos_id]</td><td>$row[fecha]</td><td>$row[timestamp]</td><td nowrap><a target='form' href='?id=$row[form_id]&c=$row[control]'><i class='fa fa-share-square-o'></i></a><a onclick=\"xajax_formulario_modal('$row[form_id]','','$row[control]'); \" class='btn btn-link btn-success'>$formulario_nombre[0]</a> <a target='form' href='?id=$row[form_id]&c=$row[control]&t=edit'><i class='fa fa-pencil'></i></a> </td><td>$row[campo_nombre]</td><td>$row[contenido]</td></tr>";
															}
															
	$resultado .="</table>";
										}else{$resultado = "No hay resultados para mostrar ";}
//$resultado .= "$consulta";
$respuesta->addAssign($div,"innerHTML",$resultado);

return $respuesta;
} $xajax->registerFunction("matriz_formulario");

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
function formulario_campos_select($perfil,$div){
	$respuesta = new xajaxResponse('utf-8');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta = "
	SELECT * FROM form_contenido_campos, form_campos 
	WHERE form_contenido_campos.id_campo = form_campos.id
	AND id_form = '$perfil' ";
$sql=mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
$resultado = "<label for='id_campo'>Campo</label>
						<select class='form-control' name='id_campo' id='id_campo' >
							<option value=''>Todos los campos</option>";
while( $row = mysql_fetch_array( $sql ) ) {
$resultado .= "		<option value='$row[id_campo]' title='$row[campo_descripcion]'>$row[campo_nombre]</option>";
															}
$resultado .= "	</select >";										}
else{$resultado = '';}

	
	//$resultado = $consulta;
$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;
	
	}
$xajax->registerFunction("formulario_campos_select");

function formulario_consultar($div){
			if($div==''){
					$div = "contenido";
					
$resultado .= "<a href='#'  onclick=\"xajax_formulario_consultar('$div'); \"><i class='fa fa-search'></i>  Consultas</a>";
					print  $resultado;
					return;
		}
	//xajax_llamar_ajax(this.value)
//$pacientes = usuarios_oncolinux('','','formulario');
	$formulario = select('form_id','id','nombre','xajax_formulario_campos_select((this.value),\'div_campos\')',"id_empresa = '$_SESSION[id_empresa]'");
	$fecha = time (); 
$ahora  = date ( "Y-m-d" , $fecha ); 
$peticion = "
<form role='form' name='peticion' id='peticion' action='rss.php' target='rss' method='post'>
	<div class='row'>
		<div class='col-sm-3 col-xs-6'>
			<div class='form-group'>
				<label for='inicio'>Inicio</label>
				<input type='date' name='inicio'  id='inicio' class='form-control' title='YYYY-MM-DD'>
			</div>
		</div>
		<div class='col-sm-3 col-xs-6'>
			<div class='form-group'>
				<label for='fin'>Fin</label>
				<input type='date' name='fin'  id='fin' class='form-control'  title='YYYY-MM-DD' value='$ahora' >
			</div>
		</div>
		<div class='col-sm-3'>
			<div class='form-group'>
				<label for='formulario'>Formulario</label>
				$formulario
				 <div id='div_campos'  name='div_campos' style='display:inline;'></div>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class='form-group'>
				<label for='busqueda'>Cadena de busqueda</label>
				<input type=text name='busqueda'  id='busqueda' placeholder='Cadena de busqueda' class='form-control'  >
			</div>
		</div>
	</div>




<input type='submit' value='rss'>
<div class='btn btn-block btn-success' OnClick=\"xajax_matriz_formulario(xajax.getFormValues('peticion'),'resultados','50','');\">Consultar</div>

</form> 
<div id='resultados' name='resultados'></div> 

";	
$respuesta = new xajaxResponse('utf-8');
$respuesta->addAssign($div,"innerHTML",$peticion);
return $respuesta;
}
$xajax->registerFunction("formulario_consultar");

function formulario_campos_procesar($form){
	$form = mysql_seguridad($form);
$respuesta = new xajaxResponse('utf-8');


//$campo_nombre = mysql_seguridad($form["campo_nombre"]);
$campo_nombre = $form["campo_nombre"];
if($campo_nombre =='') {
$respuesta->addAlert("El Nombre del campo no puede estar vacío");
$respuesta->addAssign("grupo_campo_nombre","className"," input-group has-error  ");
return $respuesta;
}

$campo_nombre = ucfirst(strtolower($campo_nombre));
$campo_descripcion = $form["campo_descripcion"];
$campo_tipo = $form["campo_tipo"];
$campo_area = $form["campo_area"];
$misma_area = $form["misma_area"];
$campo_orden = $form["campo_orden"];
$campo_identificador = $form["campo_identificador"];
$activo = $form["activo"];
$tipo = $form["tipo"];
$editar = $form["editar"];
$id_campo_editar = $form["id_campo_editar"];
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
	//$campo_nombre=mysql_real_escape_string($campo_nombre);
if ($editar == 'editar'){
mysql_query("
						UPDATE `form_campos` 
						SET `campo_nombre` = '$campo_nombre',
						`campo_descripcion` = '$campo_descripcion',
						`orden` = '$campo_orden' ,
						`campo_area` = '$campo_area',
						`campo_tipo` = '$campo_tipo',
						`id_empresa` = '$id_empresa',
						`activo` = '$activo'
						WHERE `form_campos`.`id` ='$id_campo_editar'
						LIMIT 1",$link);
$w_campo = "id = '$id_campo_editar'";						

								}else {
$id_empresa = $_SESSION['id_empresa'];
$consulta = "
				INSERT INTO `form_campos` 
			(`id_especialista`, `campo_nombre`,`campo_descripcion`,`campo_tipo`, `campo_area`, `orden`, `activo`, `identificador`, `id_empresa`) 
  VALUES ('$id_especialista','$campo_nombre','$campo_descripcion','$campo_tipo','$campo_area','$campo_orden','1','$campo_identificador','$id_empresa')";
  $sql =mysql_query($consulta,$link);  
$w_campo= "identificador = '$campo_identificador'";
										}
										
if($id_campo_editar !=''){$id_form_campo = $id_campo_editar;}else {
$id_form_campo = mysql_insert_id($link);}

$opciones=str_replace(', ',',',"$form[opciones]");
$opciones = explode(",",$opciones);

foreach($opciones as $c=>$v){ 

			if($v !='') {$v = ucfirst(strtolower($v));
			
$grabar_campos_valores .= "($id_form_campo,'$v'),";			
			}
 								
										} 
$grabar_campos_valores =substr ("$grabar_campos_valores",0,-1);
$borrar_campos_valores = "DELETE FROM `form_campos_valores` WHERE `id_form_campo` = '$id_form_campo'";
$consulta_campos_valores = "INSERT INTO form_campos_valores (id_form_campo,campo_valor) VALUES $grabar_campos_valores";			
  $sql_borrar_campos_valores =mysql_query($borrar_campos_valores,$link); 	
  $sql_campos_valores =mysql_query($consulta_campos_valores,$link);  							

  $campos=mysql_query("
  		SELECT id_form_campo, campo_nombre, campo_descripcion, tipo_campo_accion, campo_area, orden
		FROM `consulta_campos` , `tipo_campo`
		WHERE $w_campo
		
		AND form_campos.campo_tipo = form_tipo_campo.id_tipo_campo
		LIMIT 1",$link);

$campos_formulario = "";
$campos_formulario .= "<div name='crear_campos_consulta_$campo_area' id='crear_campos_consulta_$campo_area'>	</div>";	
while( $row = mysql_fetch_array( $campos ) ) {
if ($row['tipo_campo_accion']=='textarea'){
$campos_formulario .= "<div  name='id_campos_consulta_".$row['id_consulta_campo']."' id='id_campos_consulta_".$row['id_consulta_campo']."'><form name='Xcampo_editar".$row['id_consulta_campo']."' id='Xcampo_editar".$row['id_consulta_campo']."'><input  name='id_campo_editar' id='id_campo_editar' value='".$row['id_consulta_campo']."' type='hidden'><input type='hidden' name='Xarea' id='Xarea' value='".$row['campo_area']."' type='hidden'><input name='id_campo_editar' type='hidden' id='id_campo_editar' value='".$row['id_consulta_campo']."'></form>".$row['orden']."<input type='button' style='width: 200;text-align: left;'  value='".$row['campo_nombre']."' OnClick=\"xajax_crear_campos_consulta(xajax.getFormValues('Xcampo_editar".$row['id_consulta_campo']."'));\" title='".$row['campo_descripcion']."'><br><textarea name='".$row['campo_nombre']."' rows='5' cols='70'></textarea></div><br><br>";}
else{
$campos_formulario .= "<div   name='id_campos_consulta_".$row['id_consulta_campo']."' id='id_campos_consulta_".$row['id_consulta_campo']."'><form name='Xcampo_editar".$row['id_consulta_campo']."' id='Xcampo_editar".$row['id_consulta_campo']."'><input name='id_campo_editar' id='id_campo_editar' value='".$row['id_consulta_campo']."' type='hidden' ><input type='hidden' name='Xarea' id='Xarea' value='".$row['campo_area']."' ><input name='id_campo_editar' id='id_campo_editar' value='".$row['id_consulta_campo']."' type='hidden'></form>".$row['orden']."<input type='button' style='width: 200;text-align: left;'  value='".$row['campo_nombre']."' OnClick=\"xajax_crear_campos_consulta(xajax.getFormValues('Xcampo_editar".$row['id_consulta_campo']."'));\" title='".$row['campo_descripcion']."'><br> <input name='".$row['campo_nombre']."' id='".$row['campo_nombre']."' type='".$row['tipo_campo_accion']."' size='72'></div><br><br>";
																	  }																		}
//$campos_formulario .= "$consulta_campos_valores";
//$respuesta->addAlert("$consulta_campos_valores");
//return $respuesta;
$respuesta->addAssign("formulario_campos_$misma_area","innerHTML",$campos_formulario);
return $respuesta;
}$xajax->registerFunction("formulario_campos_procesar");

function formulario_opciones_select($tipo,$id_campo){
	$respuesta = new xajaxResponse('utf-8');
	$div = 'opciones_select';
if($id_campo !=''){
$consulta= "SELECT * FROM form_campos_valores WHERE id_form_campo = '$id_campo'";	
$link = Conectarse();
mysql_query("SET NAMES 'utf8'");
$sql=mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
while( $row = mysql_fetch_array( $sql ) ) {
	$valores .= "$row[campo_valor],";
									}
	$valores = substr($valores,0,-1);
								}
	}
if($tipo =='8'){
$resultado = "	<textarea class='form-control'  id='opciones' name='opciones' title='Escriba las opciones separadas por coma y en orden' placeholder='Escriba las opciones separadas por coma y en orden ej: Casa,Carro,Beca,Mascota,Computador'>$valores</textarea>";
					}
if($tipo =='16'){
	if($valores =='') {$valores = "1,10";}
$resultado = "	<textarea class='form-control'  id='opciones' name='opciones' title='Valor mínimo y máximo' placeholder='Escriba Valor mínimo y máximo separadas por coma 1,10'>$valores</textarea>";
					}
$respuesta->addAssign("$div","innerHTML",$resultado);
return $respuesta;
}
$xajax->registerFunction("formulario_opciones_select");

function crear_campos_formulario($form){
//creo el xajaxResponse para generar una salida
$form = mysql_seguridad($form);
$respuesta = new xajaxResponse('utf-8');
$div = $form['div'];

$especialista = $form["id_especialista"];
$id_campo_editar = $form["id_campo_editar"];
$resultado = "$id_campo_editar";
$link = Conectarse();
mysql_query("SET NAMES 'utf8'");
$capa = "crear_campos_consulta_$area";	
$formulario ="manejo_campos_$area";

if ($id_campo_editar > 0){
$sql=mysql_query("SELECT * FROM form_campos WHERE id = '$id_campo_editar' AND activo ='1'",$link);
while( $row = mysql_fetch_array( $sql ) ) {
$resultado .="";
$campo_descripcion =$row['campo_descripcion'];
$campo_nombre =$row['campo_nombre'];
$orden =$row['orden'];
$especialista =$row['id_especialista'];

$formulario ="manejo_campos_$id_campo_editar";
$editar="<input type='hidden' name='editar' id='editar' value='editar'>
			<input type='hidden' name='id_campo_editar' id='id_campo_editar' value='$id_campo_editar'>
			<input type='hidden' name='misma_area' id='misma_area' value='$area'>";
$Campo_tipo_definido= $row['campo_tipo'];			
}
								}
								
$Tipo_campo ="<label for='campo_tipo'>Tipo:</label>
	<select class='form-control'  name='campo_tipo' id='campo_tipo' onchange=\"xajax_formulario_opciones_select((this.value),'$id_campo_editar') \" >";
$tipos=mysql_query("
  		SELECT *
		FROM `form_tipo_campo` 
		WHERE activo = '1'
		",$link);
while( $row = mysql_fetch_array( $tipos ) ) {

if($row['id_tipo_campo'] == $Campo_tipo_definido){
$Tipo_campo .= " <option value='".$row['id_tipo_campo']."' SELECTED > > ".$row['id_tipo_campo']." - ".$row['tipo_campo_nombre']." < </option>";
																									}
$Tipo_campo .= " <option value='".$row['id_tipo_campo']."'>".$row['id_tipo_campo']." - ".$row['tipo_campo_nombre']."</option>";
}
$Tipo_campo .="</select><div id='opciones_select' name='opciones_select'></div>";




$identificador = md5($_SESSION[id_usuario]."-".microtime());

$resultado .= "<div name='formulario_campos_$area' id='formulario_campos_$area' style='padding: 10px;' class='BC".$especialista."' >
	<form role='form' name='$formulario' id ='$formulario'>
	<div class='row'>

			<div class='col-xs-4'>
			<div id='grupo_campo_nombre' class='form-group'>
			<label for ='campo_nombre'>Nombre del campo</label>
			<input class='form-control' type='text' name='campo_nombre' id='campo_nombre' size='35' value ='$campo_nombre'>
		</div>
			</div>
			<div class='col-xs-4'>
					<div class='form-group'>
					$Tipo_campo 
					</div>
			</div>
			<div class='col-xs-4'>
						<div class='form-group'>
							<label for='publico' >Estado</label>
								<select class='form-control alert-warning' value='1' name='publico' id='publico'>  
									<option value='1'>Activo: el campo puede ser usado en formularios</option>  
									<option value='0'>Inactivo: El campo NO se usará</option>
								</select>
						</div>
			</div>
		</div>
		

		<div class='form-group'>
			<label for ='campo_descripcion'>Descripci&oacute;n o ayuda para el campo</label>
			<textarea class='form-control' name='campo_descripcion' id='campo_descripcion' cols=60 rows='3'>$campo_descripcion</textarea>
		</div>
		
	

	

	<input type='hidden' name='misma_area' id='misma_area' value='$area'>
	<div class='btn btn-block btn-success' OnClick=\"xajax_formulario_campos_procesar(xajax.getFormValues('$formulario'))\" />	
	<i class='fa fa-floppy-o'></i> Grabar
	</div>
		<br><input type ='hidden' name='id_especialista' id='id_especialista' value='$especialista'>
		$editar
		<input type ='hidden' name='tipo' id='tipo' value='nuevo'>
		<input type ='hidden' name='campo_identificador' id='campo_identificador' value='$identificador $especialista'>
	 	</form>
			 	
	 	</div>";
	
$respuesta->addAssign("$div","innerHTML",$resultado);
return $respuesta;
}
$xajax->registerFunction("crear_campos_formulario");

function formulario_crear_campo($area,$campo,$div){
$respuesta = new xajaxResponse('utf-8');
		if($div==''){
					$div = "contenido";
					$cerrar = "<a href='#'onclick=\"xajax_limpia_div('$div')\"> [X]</a> ";
$resultado .= " <a href='#' onclick=\"xajax_formulario_crear_campo('$area','','$div'); \"><i class='fa fa-plus-square'></i> Campos </a>";
					print  $resultado;
					return;
		}
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");
$consulta_campos ="SELECT id, campo_nombre, campo_descripcion, tipo_campo_accion, campo_area, form_campos.activo, form_campos.campo_tipo 
  		FROM `form_campos` , `form_tipo_campo` 
  		WHERE id_empresa = '$_SESSION[id_empresa]' AND id = $campo
  		AND form_campos.campo_tipo = form_tipo_campo.id_tipo_campo 
  		ORDER BY orden ASC";
  $campos=mysql_query($consulta_campos,$link);
if($campo ==''){
	$listado_campos = select('form_campos','id','campo_nombre',"xajax_formulario_crear_campo('',(this.value),'$div')","id_empresa = '$_SESSION[id_empresa]' AND activo = '1'",'campo_editar');
$campos_formulario = "

	<form name='nuevo_campo' id='nuevo_campo' role='form'>
		<input type ='hidden' name='id_especialista' id='id_especialista' value='$_SESSION[id_usuario]'>
		<input type='hidden' name='div' id='div' value='$div'> 
		
			<div class='btn btn-block btn-success'  OnClick=\"xajax_crear_campos_formulario(xajax.getFormValues('nuevo_campo'));\"><i class='fa fa-plus-square'></i> Crear un nuevo campo</div>
			<br>
		
		
	</form> 

	<div class='form-group'>
		<label for='campo_editar'>Editar un campo existente</label>
		$listado_campos
	</div>
";
}else{
$campos_formulario .= "<div name='crear_campos_consulta_$area' id='crear_campos_consulta_$area'>	</div>";	
while( $row = mysql_fetch_array( $campos ) ) {
	if($row[campo_tipo] =='8'){ 
	$respuesta->addScript("xajax_formulario_opciones_select('8','$campo') ");
	}
	$Tipo_campo ="<label for='campo_tipo'>Tipo:</label>
	<select class='form-control'  name='campo_tipo' id='campo_tipo' onchange=\"xajax_formulario_opciones_select((this.value),'$campo') \" >";
$tipos=mysql_query("
  		SELECT *
		FROM `form_tipo_campo` 
		WHERE activo = '1'
		",$link);
while( $row_tipo = mysql_fetch_array( $tipos ) ) {

if($row_tipo['id_tipo_campo'] == $row[campo_tipo] ){
$Tipo_campo .= " <option value='".$row_tipo['id_tipo_campo']."' SELECTED > > ".$row_tipo['id_tipo_campo']." - ".$row_tipo['tipo_campo_nombre']." < </option>";
																									}
$Tipo_campo .= " <option value='".$row_tipo['id_tipo_campo']."'>".$row_tipo['id_tipo_campo']." - ".$row_tipo['tipo_campo_nombre']."</option>";
}
$Tipo_campo .="</select><div id='opciones_select' name='opciones_select'></div>";

if($row[activo] =='1'){$activo = "<option value='1' selected >Activo: el campo puede ser usado en formularios</option>  ";}
else{$activo = "<option value='0' selected >Inactivo: El campo NO se usará</option> ";}
$formulario = "editar_campos";
			
$campos_formulario .= "
<div id='formulario_campos_$misma_area'>
<div class='alert alert-info' >
<form role='form' id='$formulario' name='$formulario'>
<input type='hidden' id='editar' name='editar' value='editar'>
<input type='hidden' id='id_campo_editar' name='id_campo_editar' value='$campo'>
<input type='hidden' name='misma_area' id='misma_area' value='$area'>
	<div class='row'>
		<div class='col-sm-4'>
			<div id='grupo_campo_nombre' class='form-group'>
				<label for='campo_nombre' >Nombre del campo</label>
				<input type='text' class='form-control' id='campo_nombre' name='campo_nombre' value='$row[campo_nombre]'>
			</div>
		</div>
		<div class='col-sm-4'>
			$Tipo_campo
		</div>
		<div class='col-sm-4'>
						<div class='form-group'>
							<label for='activo' >Estado</label>
								<select class='form-control alert-warning' value='1' name='activo' id='activo'>  
									$activo
									<option value='1'>Activo: el campo puede ser usado en formularios</option>  
									<option value='0'>Inactivo: El campo NO se usará</option>
								</select>
						</div>
		</div>
	</div>
	<div class='row'>
		<div class='col-sm-12'>
			<div class='form-group'>
				<label for='campo_descripcion' >Descripción del campo</label>
				<textarea type='text' class='form-control' id='campo_descripcion' name='campo_descripcion' >$row[campo_descripcion]</textarea>
			</div>
		</div>
	</div>
	<div class='row'>
		<div class='col-sm-6'>
			<div class='btn btn-block btn-success' OnClick=\"xajax_formulario_campos_procesar(xajax.getFormValues('$formulario'))\" /><i class='fa fa-floppy-o'></i>	Grabar</div>
		</div>
		<div class='col-sm-6'>
			<div class='btn btn-block btn-danger' OnClick=\"xajax_limpia_div('$div')\" ><i class='fa fa-times-circle'></i> Cancelar</div>
		</div>
	</div>
	
</form>


</div>
</div>";

																	  }
			}///fin de edicion

//echo $campos_formulario;
												
$respuesta->addAssign($div,"innerHTML",$campos_formulario);

return $respuesta;
}
$xajax->registerFunction("formulario_crear_campo");

function agregar_campos($tipo,$div,$id){ 
$respuesta = new xajaxResponse('utf-8');
$link=Conectarse();
mysql_query("SET NAMES 'utf8'");

if($tipo==''){
	$div="contenido";
$resultado = " <a href='#' onclick=\"xajax_agregar_campos('consultar_listado','$div','')\"><i class='fa fa-pencil-square-o'></i> Editar</a>";
print $resultado;
return;
	}
 if($tipo=='consultar_listado'){
 $consulta="SELECT * FROM form_id WHERE id_empresa = '$_SESSION[id_empresa]' ORDER BY nombre ASC";
 $sql =mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
$resultado .="Formulario: <select class='form-control' name='id_consulta_tipo' id='id_consulta_tipo' onchange=\"xajax_agregar_campos('consultar_campos','$div',this.value)\">";
$resultado .= "<option value=''>Selecciona </option>";
while( $row = mysql_fetch_array( $sql ) ) {
$resultado .= "<option value='$row[id]'>$row[nombre]</option>";
															}
$resultado .="</select> $cerrar";															
										}else {
$resultado = "<div class='alert alert-warning'><i class='fa fa-exclamation-triangle'></i> No hay formularios para editar</div>";										
										}
										}
										
if ($tipo=='consultar_campos'){
 $consulta="
 SELECT form_contenido_campos.id_campo,
	campo_nombre, obligatorio,control,prellenado,form_contenido_campos.orden 
 FROM form_contenido_campos, form_campos 
 WHERE form_campos.id_empresa = '$_SESSION[id_empresa]'  AND form_contenido_campos.id_form = $id 
 AND form_contenido_campos.id_campo = form_campos.id 
 ORDER BY form_contenido_campos.orden";
 $sql =mysql_query($consulta,$link);
 $consulta_nombre="SELECT * FROM form_id WHERE id ='$id'";
 $sql_nombre =mysql_query($consulta_nombre,$link);
 $nombre =mysql_result($sql_nombre,0,"nombre");
 //if (mysql_num_rows($sql)!='0'){
$resultado ="$cerrar<h2>$nombre</h2>
				<table class='table'>"; 
				$resultado .= "<tr><th>Campo</th><th>Obligatorio</th><th>Orden</th><th></th></tr>";

while( $row = mysql_fetch_array( $sql ) ) 	{
$resultado .= "<tr>
						<td><sup><font color='#7F7F7F'>($row[id_campo]) </font></sup> $row[campo_nombre]</td>
						<td>
							<div name='obligatorio_$row[control]' id='obligatorio_$row[control]' style='display:inline'>
								<a title='Click para cambiar el valor' 
								onClick=\"xajax_agregar_campos('obligatorio','obligatorio_$row[control]','$row[obligatorio]','$row[control]')\">$row[obligatorio]
								</a>
							</div>
						</td>

						<td>
							<div name='orden_$row[control]' id='orden_$row[control]' style='display:inline'>
								<a title='Click para cambiar el valor' 
								onClick=\"xajax_agregar_campos('orden','orden_$row[control]','$row[orden]','$row[control]')\">$row[orden]
								</a>
							</div>
						</td>
						<td>
								<div name='eliminar_$row[control]' id='eliminar_$row[control]' style='display:inline'>
								<a title='Click para cambiar el valor' 
								onClick=\"xajax_agregar_campos('eliminar','eliminar_$row[control]','','$row[control]','$id','$div')\">
								<i class='fa fa-trash-o'></i>
								</a>
							</div>
						</td>
					</tr>";
															}
$resultado .="</table>";	
$consulta_campos_todos ="SELECT  form_campos.id, form_campos.campo_nombre, form_campos.campo_descripcion FROM form_campos WHERE form_campos.id_empresa = '$_SESSION[id_empresa]' 
 ORDER BY campo_nombre ";	
$sql_consulta_campo =mysql_query($consulta_campos_todos,$link); 
//if(mysql_num_rows($sql_consulta_campo) !='0')	{
$resultado .="<div name='atencion' id='atencion' style='display:inline'></div>
<select class='form-control' name='id_form_campo' id='id_form_campo' onchange=\"xajax_agregar_campos('grabar_campos','$div',this.value,'$id')\">";
$resultado .= "<option value=''> Agregar campo a $nombre  </option>";
								while( $row = mysql_fetch_array( $sql_consulta_campo ) ) {
$resultado .= "<option value='$row[id]' title='$row[campo_descripcion]'>$row[campo_nombre]</option>";
																											}
$resultado .="</select> <hr>";	
												//				}											
														
										//	}
											}/// fin de consultar_campos
											
if($tipo=='grabar_campos'){
$id_form=func_get_arg(3);
$consulta = "SELECT id_campo FROM form_contenido_campos WHERE id_campo= '$id' AND id_form= $id_form"; 
$sql_consulta =mysql_query($consulta,$link); 
$id_empresa= $_SESSION['id'];
if(mysql_num_rows($sql_consulta) =='0')	{
$microtime = microtime();
$consulta_grabar=" INSERT INTO form_contenido_campos (
`id_campo` ,
`id_empresa` ,
`id_form` ,
`obligatorio`,
`control`
)
VALUES (
'$id', '$id_empresa', '$id_form', '0', md5('$microtime' + rand())
)";
$sql_consulta_grabar =mysql_query($consulta_grabar,$link);
$respuesta->addScript("xajax_agregar_campos('consultar_campos','$div','$id_form')");
return $respuesta;
														}else{$div='atencion';$resultado="<i class='fa fa-exclamation-triangle'></i> El campo ya pertenece a esta consulta ";}

									}///fin de grabar_campos	
									
if($tipo=='eliminar'){
$confirmar=func_get_arg(3);


if($id==''){
$id_c=func_get_arg(4);
$capa_original=func_get_arg(5); 
$resultado = "<i class='fa fa-exclamation-triangle'></i>
									Seguro que desea eliminar el campo de esta consulta? 
									<a onClick=\"xajax_agregar_campos('eliminar','eliminar_$confirmar','$confirmar','$confirmar','$id_c','$capa_original')\"> [SI] </a>
									<a onClick=\"xajax_agregar_campos('eliminar','eliminar_$confirmar','x','$confirmar','$id_c','$capa_original')\"> [NO]</a>
									
									";}
	else{
	if($id=='x'){ /// si se pasa una x como argumento se regresa a la capa original
$resultado .= "<a title='Click para cambiar el valor' 
								onClick=\"xajax_agregar_campos('eliminar','eliminar_$confirmar','','$confirmar')\">
								<img src='images/eliminar.gif' border='0' alt='[X]' title='Eliminar este campo'> 
								</a>";
				}else{
$consulta="DELETE FROM `form_contenido_campos` WHERE `control` = '$confirmar' LIMIT 1";
$sql_consulta_eliminar = mysql_query($consulta,$link);
$div=func_get_arg(5);
$id_consulta=func_get_arg(4);
$respuesta->addScript("xajax_agregar_campos('consultar_campos','$div','$id_consulta')");
//return $respuesta;
//$resultado = $consulta;
						}
			}

							}/// fin de eliminar											
if($tipo == 'obligatorio'){
if($id == '0'){$id='1';}else{$id='0';}
$control = func_get_arg(3); 
$consulta= "UPDATE `form_contenido_campos` SET `obligatorio` = '$id' WHERE `control` = '$control' LIMIT 1 "; 
$sql_consulta_grabar =mysql_query($consulta,$link);
$a ="<a title='Click para cambiar el valor' 
								onClick=\"xajax_agregar_campos('obligatorio','obligatorio_$control','$id','$control')\">$id
								</a>";
$respuesta->addAssign($div,"innerHTML",$a);
return $respuesta;
								
									}/// fin de obligatorio												
if($tipo == 'orden'){ /// orden
//if($id == '0'){$id='1';}else{$id='0';}
$control = func_get_arg(3); 
$consulta= "UPDATE `form_contenido_campos` SET `orden` = '$id' WHERE `control` = '$control' LIMIT 1 "; 
$sql_consulta_grabar =mysql_query($consulta,$link);
$a ="<input type='text' size='2' title='Escriba un valor para el orden de aparición de este campo en la consulta' value='$id'
								onChange=\"xajax_agregar_campos('orden','orden_$control',this.value,'$control')\">$id
								</a>";
								
$respuesta->addAssign($div,"innerHTML",$a);
return $respuesta;
								
									}/// fin de obligatorio																	
											
if($tipo == 'prellenado'){
if($id == '0'){$id='1';}else{$id='0';}
$control = func_get_arg(3); 
$consulta= "UPDATE `consulta_tipo_campos` SET `prellenado` = '$id' WHERE `control` = '$control' LIMIT 1 "; 
$sql_consulta_grabar =mysql_query($consulta,$link);
$a ="<a title='Click para cambiar el valor' 
								onClick=\"xajax_agregar_campos('prellenado','prellenado_$control','$id','$control')\">$id
								</a>";
$respuesta->addAssign($div,"innerHTML",$a);
return $respuesta;
								
									}/// fin de oprellenado																	
$respuesta->addAssign($div,"style.display","block");
$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;
 										
			}
$xajax->registerFunction("agregar_campos");		

function formulario_nuevo($formulario,$div){
	$formulario = mysql_seguridad($formulario);
	$respuesta = new xajaxResponse('utf-8');
	$id=mysql_real_escape_string($id);
	$id_empresa= $_SESSION['id'];
		if($div==''){
					$div = "contenido";
					
$resultado .= "<a href='#' onclick=\"xajax_formulario_nuevo('','$div'); \"><i class='fa fa-plus-square-o'></i> Formulario </a> ";
					print  $resultado;
					return;
		}
if($formulario ==''){
	$formulario_nombre = "nuevo_formulario";
	$formulario_respuesta = select('form_id','id','nombre','',"id_empresa = '$_SESSION[id_empresa]'",'formulario_respuesta');
$resultado .= "
<form role='form' id='$formulario_nombre'  name='$formulario_nombre' >
<legend>Crear un formulario</legend>
	<div class='form-group'>
		<label for='consulta_tipo_nombre' >Nombre para el formulario</label> 
		<input class='form-control' type='text' id='nombre' name='nombre' maxlenght='30' >
	</div>
	<div class='form-group'>
		<label for='consulta_tipo_descripcion'>Descripción</label>
		<textarea class='form-control' id='descripcion' name='descripcion'></textarea>
	</div>
 	<div class='form-group'>
		<label for='formulario_respuesta'>Formulario anidado con: </label>
		$formulario_respuesta 
	</div> 
	<div class='form-group alert-warning'>
		<label for='publico' class='checkbox-inline'>
			<input type='checkbox' value='1' name='publico' id='publico'> Cualquiera puede llenar este formulario. 
			
		</label>
	</div>
	<div class='btn  btn-success btn-block' onclick=\"xajax_formulario_nuevo(xajax.getFormValues('$formulario_nombre'),'$div') \">
		Grabar
	</div>

</form>";	
	
	}else{
$control = md5(rand(1,99999999).microtime());

$nombre = $formulario['nombre']; // aa
$descripcion = $formulario['descripcion']; // dxddc 
$publico = $formulario['publico']; // dxddc 
if($publico =='') {$publico ='0';}
$propietario= $_SESSION['id'];
$formulario_respuesta = $formulario['formulario_respuesta']; // dxddc 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta = "INSERT INTO `form_id` ( `nombre`, `descripcion`, `activo`, `modificable`, `publico`, `propietario`, `formulario_respuesta`, `id_empresa`) 
VALUES ('$nombre', '$descripcion', '1', '1', '$publico', '$propietario','$formulario_respuesta','$_SESSION[id_empresa]');";
$sql=mysql_query($consulta,$link);

$respuesta->addalert("El formularo se grabó satisfactoriamente");
//$respuesta->addScript("xajax_formulario_listado('','$div')");
}
$respuesta->addAssign($div,"innerHTML",$resultado);

return $respuesta;
}$xajax->registerFunction("formulario_nuevo");

function formulario_listado($formulario,$div){

	$id=mysql_real_escape_string($id);
	$id_empresa= $_SESSION['id'];
		if($div==''){
					$div = "contenido";
$resultado .= "<a href='#'  onclick=\"xajax_formulario_listado('','$div'); \"><i class='fa fa-list'></i> Listado</a> ";
					print  $resultado;
					return;
		}
$control = md5(rand(1,99999999).microtime());
$respuesta = new xajaxResponse('utf-8');

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT * FROM form_id WHERE id_empresa ='$_SESSION[id_empresa]' AND modificable !='0' ORDER BY id DESC";
$sql=mysql_query($consulta,$link);
$divider = 3;
if (mysql_num_rows($sql)!='0' ){
	$i =0;
	//mysql_data_seek($sql, 0);
		while( $row = mysql_fetch_array( $sql ) ) {
			$id= $row[id];
		$cantidad =	formulario_contar($row[id]);
		if($cantidad >0) {$cantidad ="<tr><td>Llenado: <b>$cantidad veces</b></td></tr>";}else{$cantidad = "";}
		$propietario = 	remplacetas('usuarios','id',$row[propietario],'email',"") ;
		$estado = 	remplacetas('form_id','id',$id,'publico',"") ;
		$estado = "<tr><td>
							<div class='input-group '>
								<span class='input-group-addon'>Privado</span>
								<input  type='range' value='$estado[0]' min='0' max='1' class='form-control'
								onchange =\"xajax_actualizar_campo('form_id','$row[id]','publico',(this.value),'','ok'); \">
								<span class='input-group-addon alert-danger'>Público</span>
							</div>
						</td></tr>";
		
		
		$primer = 	formulario_uso("$id",'','primer') ;
		if($primer[0] !='') {$primer = "<tr><td>Primer registro: <a onclick=\"xajax_formulario_modal('$id','','$primer[1]'); \"><b>".date ( "Y-m-d h:i:s" , $primer[0])."</b></a></td></tr>";}else{$primer='';}
		$ultimo = 	formulario_uso("$id",'','ultimo') ;
		if($ultimo[0] !='') {$ultimo = "<tr><td>Último registro: <a onclick=\"xajax_formulario_modal('$id','','$ultimo[1]'); \"><b>".date ( "Y-m-d h:i:s" , $ultimo[0])."</b></a></td></tr>";}else{$ultimo='';}
		//<a onclick=\"xajax_formulario_modal('1','','5ab6173143303cfa10a7ce5b5dc40427'); \">Contacto</a>
		//$estado = editar_campo("form_id","$row[id]","publico","");
		
		$nombre = editar_campo("form_id","$row[id]","nombre","");
		$descripcion = editar_campo("form_id","$row[id]","descripcion","");
		$geo = buscar_campo_tipo($id,"14");
		if($geo[0] !='') { $mapa= "<tr><td><a href='geo.php?id=$id' target='mapa'><i class='fa fa-globe'></i> Mapa</a></td></tr>";}else {$mapa='';}
		
		if($i % $divider==0) {
		$resultado .= "<div class='row '  id='grid' style='';>	";
								}
			$i++;
$resultado .=  "<div class='col-sm-4' style=';'>
						<div class='panel panel-default' style=''>
							 <div class='panel-heading'>
							    <h3>$nombre <span class='badge pull-right'>ID $row[id]</span></h3>
							    <p>$descripcion</p>
							 </div>
							 <div class='panel-body'>
								<table class='table' >
									$cantidad  
									$ultimo
									$primer
									<tr><td>Creado por: <b>$propietario[0]</td></tr>
									<tr><td>Creación: <b>$row[creacion]</b></td></tr>
									$mapa $estado
								
									<tr><td><a class='btn btn-primary btn-block' href='#' onclick=\"xajax_formulario_modal('$row[id]'); \">Llenar</a></td></tr>
								</table>	

							</div>
							<div class='panel-footer'>
								<div class='input-group '>
									<span class='input-group-addon'>Link</span>
									<input  onclick=\"this.select(); \"  type='text' class='form-control' placeholder='http://$_SERVER[HTTP_HOST]/milfs?id=$id' value='http://$_SERVER[HTTP_HOST]/milfs?id=$id'>
								</div>
							</div>
						</div>
					</div> ";

//$resultado .=  " x $item y";
	if($i%$divider==0) {
			$resultado .= "
			
			</div>	";
								}

															}

															
	$resultado .="";
										}
else{ $resultado = "<div class='alert alert-warning' ><h2>Aún no se han diseñado formularios</h2></div> ";}
$respuesta->addAssign($div,"innerHTML",$resultado);

return $respuesta;
}$xajax->registerFunction("formulario_listado");

function formulario_campos_render($id_campo,$id_form,$control){

$consulta ="
	SELECT * 
	FROM form_contenido_campos,form_campos, form_tipo_campo
	WHERE form_contenido_campos.id_form = '$id_form'
	AND form_contenido_campos.id_campo = '$id_campo'
	AND form_contenido_campos.id_campo = form_campos.id
	AND form_tipo_campo.id_tipo_campo = form_campos.campo_tipo ";
	$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
	$sql=mysql_query($consulta,$link);
	if (mysql_num_rows($sql)!='0'){
		/*
		<input value="" type="email" id="email_express" name="email_express" placeholder="Email" class="form-control" onclick="(this.value=''); " onchange="xajax_validar_usuario('email',(this.value),'email_express','login'); ">
		<i class='fa fa-envelope-o'></i>
		<div class='badge' title='$campo_descripcion'> $id_campo</div> 
		*/
		$value = 	remplacetas('form_datos','id_campo',$id_campo,'contenido'," control = '$control'") ;
		if($value[0] !='') {$value= "$value[0]";}ELSE{$value='';}
		$campo_nombre=mysql_result($sql,0,"campo_nombre");
		$campo_descripcion=mysql_result($sql,0,"campo_descripcion");
		$campo_tipo_accion=mysql_result($sql,0,"tipo_campo_accion");
		if($campo_tipo_accion == 'text'){$render = "<input value='$value' type='text' id='$id_campo' name='$id_campo' class='form-control' placeholder='$campo_descripcion' > ";}
		elseif($campo_tipo_accion == 'date'){$render = "<input value='$value' type='date' id='$id_campo' name='$id_campo' class='form-control' placeholder='$campo_descripcion' > ";}
		elseif($campo_tipo_accion == 'rango'){
					$rango = rango("form_campos_valores","campo_valor","id_form_campo","$id_campo","$value","$id_campo",""); $render = $rango;}		
		elseif($campo_tipo_accion == 'mapa'){
			$campos = explode(" ",$value);
														$lat = $campos[0];
														$lon = $campos[1];
														$zoom = $campos[2];	
									$render = "
																		
																		<iframe src='mapa.php?id=$id_campo&lat=$lat&lon=$lon&zoom=$zoom' width='100%' height='300px'></iframe>
																		<input value='$value' type='text' id='$id_campo' name='$id_campo' class='form-control' placeholder='coordenadas' readonly >
																		
																				 ";}
		elseif($campo_tipo_accion == 'email'){$render = "<code>Escriba un email válido</code>
																			<input value='$value' type='email' id='$id_campo' name='$id_campo' class='form-control' placeholder='$campo_descripcion' > ";}
		elseif($campo_tipo_accion == 'envio'){$render = "<code>Se enviará un correo electrónico a este email</code>
																			<input value='$value' type='email' id='$id_campo' name='$id_campo' class='form-control' placeholder='$campo_descripcion' > ";}
		elseif($campo_tipo_accion == 'textarea'){$render = "<textarea id='$id_campo' name='$id_campo' class='form-control' placeholder='$campo_descripcion' >$value</textarea> ";}
		elseif($campo_tipo_accion == 'select'){
			$select = select('form_campos_valores','campo_valor','campo_valor','',"id_form_campo = $id_campo","$id_campo");
			$render = "$select ";}
		elseif($campo_tipo_accion == 'number'){$render = "<code>(Este campo solo acepta números)</code>
															<input value='$value' type='number' id='$id_campo' name='$id_campo' class=' has-warning form-control' placeholder='$campo_descripcion' > ";}
		else{$render = "<input value='$value' type='text' id='$id_campo' name='$id_campo' class='form-control' placeholder='$campo_descripcion' > ";}
		$input = "
		<div class='input-group' id='input_$id_campo' >
			<div class='badge'>$id_campo</div><label class=' ' for='$id_campo'>  $campo_nombre </label>
			
$render 
			
		</div>

		";
	}
	return $input;
}

function validar_email($email) {

if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$email)) {
   return 1;
}else{
	return 0;
}
}

function formulario_grabar($formulario) {
	$respuesta = new xajaxResponse('utf-8');
	$formulario	= mysql_seguridad($formulario);
	$control = $formulario[control]; // 
	$form_id = $formulario[form_id]; // 
	if($formulario[imagen] !=''){$formulario[0] = $formulario[imagen];}
	$consulta_form = "SELECT * FROM form_contenido_campos,form_campos
							WHERE form_contenido_campos.id_campo = form_campos.id 
							AND  id_form = '$form_id' ";
	$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
	$sql=mysql_query($consulta_form,$link);

	if (mysql_num_rows($sql)!='0'){
		while( $row = mysql_fetch_array( $sql ) ) {
$id_campo = "$row[id_campo]";
 
			if($row[campo_tipo] ==='12' OR $row[campo_tipo] ==='13') { 
						 
			$validar = validar_email($formulario[$row[id_campo]]);
				if($validar == '0') {  
				
	$respuesta->addAssign("input_"."$id_campo","className"," input-group has-error  ");	
	$respuesta->addAlert("Se necesita un email válido ");	
	return $respuesta;			
				}else {
	$respuesta->addAssign("input_"."$id_campo","className"," input-group has-success ");															
				}			
			 }
			
			if($row[obligatorio] ==='1') 
			{
				if( $formulario[$id_campo] =='') {
				$obligatorio++;
				$respuesta->addAssign("input_"."$id_campo","className"," input-group has-error  ");
															}else {
			$respuesta->addAssign("input_"."$id_campo","className"," input-group has-success ");															
															}
			}else {//$obligatorio .='';
			$respuesta->addAssign("input_"."$id_campo","className"," input-group has-success  ");
			}
			$campos_esperados .= "<li>$row[id_campo] / $row[obligatorio] / $formulario[$id_campo] /$obligatorio </li>";
																}
											}
			if($obligatorio !='' ) {
								$resultado .= " <div class='alert alert-danger'><i class='fa fa-exclamation-triangle'></i>( $validar ) Algunos campos obligatorios no se han llenado</div>";
				}else{
					if(isset ( $_SESSION[id_empresa])){$id_empresa = $_SESSION[id_empresa]; }else{ 
			$id_empresa = 	remplacetas('form_id','id',$formulario[form_id],'id_empresa',"") ;
			$id_empresa = $id_empresa[0];					
					}
foreach($formulario as $c=>$v){ 


			if(($v !='') && (is_numeric($c)) ) {
				$ip =  obtener_ip();
				$graba_ip = "INET_ATON('".$ip."') ";
				$consulta ="
				INSERT INTO `form_datos` (`id`, `id_campo`,`form_id`, `id_usuario`, `contenido`, `timestamp`, `control`, ip , id_empresa) 
										VALUES (NULL, '$c', '$formulario[form_id]', '$_SESSION[id]', '$v', UNIX_TIMESTAMP(), '$formulario[control]',$graba_ip,'$id_empresa');"; 
			$sql=mysql_query($consulta,$link);
			//	$respuesta->addAlert("$consulta");		return $respuesta;
	/*if($sql) {

	
	}	*/		
			
			}
 								
										}
		$exito ="
	<div class='alert alert-success'><h2><i class='fa fa-check-square-o'></i>
		 Gracias por llenar el formulario $formulario[form_nombre] </h2>
		 <div class='row'>
			 <div class='col-xs-6'>
			 	<a href ='?id=$formulario[form_id]' class='btn btn-block btn-success'>
			 		Llenar otro formulario
			 	</a>
			 </div>
			 <div class='col-xs-6'>
			 	<a href ='?id=$formulario[form_id]&c=$formulario[control]' class='btn btn-block btn-success'>
			 		Ver los datos grabados
			 	</a>
			 </div>
		 </div>
		
				 
	</div>";
			$propietario = 	remplacetas('form_id','id',$formulario[form_id],'propietario',"") ;
			$propietario = 	remplacetas('usuarios','id',$propietario[0],'email',"") ;
			$id_empresa = 	remplacetas('form_id','id',$formulario[form_id],'id_empresa',"") ;
			$id_empresa = $id_empresa[0];
			
		$direccion =  remplacetas("empresa","id",$id_empresa,"direccion","");
		$telefono =  remplacetas("empresa","id",$id_empresa,"telefono","");
		$web =  remplacetas("empresa","id",$id_empresa,"web","");
		$email =  remplacetas("empresa","id",$id_empresa,"email","");
		$imagen =  remplacetas("empresa","id",$id_empresa,"imagen","");
		$razon_social =  remplacetas("empresa","id",$id_empresa,"razon_social","");
		$slogan =  remplacetas("empresa","id",$id_empresa,"slogan","");
		$nombre_formulario =  remplacetas("form_id","id",$formulario[form_id],"nombre","");

$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: $razon_social[0] <$email[0]>\r\n"; 
$headers .= "Reply-To: $email[0]\r\n"; 
$headers .= "Return-path: $email[0]\r\n"; 
$headers .= "Cc: $propietario[0]" . "\r\n";

$asunto= "[MILFS] $nombre_formulario[0]";
$cuerpo ="
<h1>Formulario</h1>
</p>Se ha completado el formulario <b>$nombre_formulario[0]</b></p>
<p>Puede revisar los datos en <a href='http://$_SERVER[HTTP_HOST]/milfs?id=$formulario[form_id]&c=$formulario[control]'>http://$_SERVER[HTTP_HOST]/milfs?id=$formulario[form_id]&c=$formulario[control]</a></p>
<p>Saludos de MILFS</p>
";
			if(mail("$email[0]","$asunto","$cuerpo","$headers")){ $exito .=""; }else {$exito .="error enviando correo";}
			//$exito .= "$email[0] $headers ";
		$respuesta->addAssign("div_$control","innerHTML","$exito ");
		return $respuesta;														
				}

$respuesta->addAssign("respuesta_$control","innerHTML","$resultado");
return $respuesta;
}
$xajax->registerFunction("formulario_grabar");

function mysql_seguridad($inp) { 
    if(is_array($inp)) 
        return array_map(__METHOD__, $inp); 

    if(!empty($inp) && is_string($inp)) { 
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\*", "\\*", '\\Z'), $inp); 
    } 

    return $inp; 
}

function formulario_modal($id,$form_respuesta,$control,$tipo) {
	$respuesta = new xajaxResponse('utf-8');
 
	$id_empresa = remplacetas('form_id','id',$id,'id_empresa') ;
	$id_empresa = $id_empresa[0];
	$encabezado = empresa_datos("$id_empresa",'encabezado');
	$pie = empresa_datos("$id_empresa",'pie');
	$formulario_descripcion = remplacetas('form_id','id',$id,'descripcion') ;
	$cabecera ="$encabezado<h3>$formulario_nombre[0]</h3><p>$formulario_descripcion[0]</p>$nuevo_formulario $formulario_respuesta ";
	$publico = remplacetas('form_id','id',$id,'publico') ;
		if($publico[0] != 1 AND (!isset ( $_SESSION[id]) )) {
		$muestra_form ="<div class='alert alert-danger  '>
									<h1 class='center-block'><i class='fa fa-exclamation-triangle'></i></h1>
									<h3>Este formulario no esta disponible publicamente.</h3>
								</div>";
	$respuesta->addAssign("muestra_form","innerHTML","$muestra_form");
$respuesta->addAssign("titulo_modal","innerHTML","$cabecera");
$respuesta->addAssign("pie_modal","innerHTML","$pie");
$respuesta->addscript("$('#muestraInfo').modal('toggle')");	
return $respuesta;
	
	}
		$nuevo_formulario = "<a href ='?id=$id'>Llenar otro formulario </a>";
	if($control !='' AND $form_respuesta =='' ) {
$muestra_form = formulario_imprimir("$id","$control"); 

$formulario_nombre = remplacetas('form_id','id',$id,'nombre') ;
$formulario_respuesta = formulario_respuesta("$id","$control");


$respuesta->addAssign("muestra_form","innerHTML","$muestra_form");
$respuesta->addAssign("titulo_modal","innerHTML","$cabecera");
$respuesta->addAssign("pie_modal","innerHTML","$pie");
$respuesta->addscript("$('#muestraInfo').modal('toggle')");	
return $respuesta;	


}
//else {$respuesta =" $id , $respuesta ,$control"; return $respuesta;}

$consulta = "
		SELECT * FROM  form_id, form_contenido_campos 
		WHERE form_id.id = form_contenido_campos.id_form 
		AND form_id.id = '$id'  
		";
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$sql=mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0'){
	if($respuesta !='' AND $control !=''){$control =$control;}
	else{$control = md5(rand(1,99999999).microtime());} 
	$descripcion=mysql_result($sql,0,"descripcion");
	$nombre=mysql_result($sql,0,"nombre");
	$id_empresa=mysql_result($sql,0,"id_empresa");
	$encabezado = empresa_datos("$id_empresa",'encabezado');
	$pie = empresa_datos("$id_empresa",'pie');
	$cabecera = "
	<div>$encabezado</div>
	<div class='alert alert-info'  >
		<div class='row'>
		<div class='col-xs-4'>	
			<img src='http://qwerty.co/qr/?d=http://$_SERVER[HTTP_HOST]/milfs?id=$id'>
		</div>
		<div class='col-xs-8'>
		<h1>$nombre</h1><p>$descripcion</p>
		</div>
	</div>
	<label >Compartir este formulario</label>
	<div class='input-group'>
  <span class='input-group-addon'><a href='http://$_SERVER[HTTP_HOST]/milfs?id=$id'><i class='fa fa-share-square-o'></i></a></span>
  <input  onclick=\"this.select(); \"  type='text' class='form-control' placeholder='http://$_SERVER[HTTP_HOST]/milfs?id=$id' value='http://$_SERVER[HTTP_HOST]/milfs?id=$id'>
</div>	
</div>";
$subir_imagen = subir_imagen('');	
	$muestra_form = "
	<div id ='div_$control'>
	$subir_imagen 
		<form role='form' id='$control'  name='$control' class=''  >
			<input type='hidden' id='control' name='control' value='$control'>
			<input type='hidden'  id= 'form_id'  name= 'form_id' value='$id' >
			<input type='hidden'  id= 'form_nombre'  name= 'form_nombre' value='$nombre' >
				<input class='form-control'   class='sr-only' type='hidden' id='imagen' name='imagen' >
	";
			mysql_data_seek($sql, 0);
	while( $row = mysql_fetch_array( $sql ) ) {

		$campos = formulario_campos_render($row[id_campo],$id,$control);
	$muestra_form .= "$campos ";
															}
	$muestra_form .="<br><div id='respuesta_$control' name='respuesta_$control' ></div>
						<div onclick=\" xajax_formulario_grabar(xajax.getFormValues('$control'));\"  class='btn btn-block btn-danger'>Grabar</div>
							";
										}

$muestra_form .="	

		</form>
		</div>";


$respuesta->addAssign("muestra_form","innerHTML","$muestra_form");
$respuesta->addAssign("titulo_modal","innerHTML","$cabecera");
$respuesta->addAssign("pie_modal","innerHTML","$pie");
$respuesta->addscript("$('#muestraInfo').modal('toggle')");	
return $respuesta;
}
$xajax->registerFunction("formulario_modal");

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

function limpia_div($capa){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('utf-8');
$respuesta->addAssign($capa,"style.padding","0px");
//$respuesta->addAssign($capa,"innerHTML",'');
$respuesta->addClear($capa,"innerHTML");

return $respuesta;
}$xajax->registerFunction("limpia_div");

function select($tabla,$value,$descripcion,$onchange,$where,$nombre){
$link=Conectarse(); 
$campos = explode(",",$descripcion);
$campo1 = $campos[0];
$campo2 = $campos[1];
$debug = "($tabla,$value,$descripcion,$onchange,$where)";
mysql_query("SET NAMES 'utf8'");
$id_empresa= $_SESSION['id_empresa'];
if($where =='AGRUPADO'){$group="group by $value ";}
elseif($where != ''){$w = "AND  ".$where;}else{ $w="";}
$busca = array("[","]");
if( strpos( $onchange,'[') !== false ){$fila=str_replace($busca,'',$onchange);$onchange='';};
$consulta = "SELECT $value, $descripcion FROM $tabla WHERE 1 $w $group  ";
$sql=mysql_query($consulta,$link);
if($nombre==''){$name=$tabla."_".$value;}else{$name = "$nombre";}
if (mysql_num_rows($sql)!='0'){
	if($onchange !=''){$vacio ="";}else{$vacio ="<option value=''> >> Nuevo $descripcion << </option>";}
$resultado=" <SELECT class='form-control' NAME='$name' id='$name' onchange=\"$onchange\" title='Seleccione $descripcion'  >
<option value=''>Seleccione </option>
				" ;
while( $row = mysql_fetch_array( $sql ) ) {
	/*if($row[$value] =='0'){$selected = "selected";}
	elseif($row[$value] =='1'){$selected = "selected";}
	else {$selected =="";}*/
$resultado .= "<option value='$row[$value]' $selected > ".substr($row[$campo1], 0, 150 )." ".substr($row[$campo2], 0, 30 )."  </option>";
															}
$resultado .= "</select>";
										}else{$resultado = "<div class='alert alert-warning'><i class='fa fa-exclamation-triangle'></i> No hay resultados</div>";}

return $resultado;
}
 

function rango($tabla,$campo,$key,$valor,$selected,$nombre,$onchange){
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");

$consulta = "SELECT min($campo) as min , max($campo) as max  FROM $tabla WHERE $key ='$valor' ";
$sql=mysql_query($consulta,$link);

if (mysql_num_rows($sql)!='0'){
	$min=mysql_result($sql,0,"min");
	$max=mysql_result($sql,0,"max");
if($nombre==''){$name=$tabla."_".$value;}else{$name = "$nombre";}
$resultado="<div class='input-group'>
					<span class='input-group-addon'>$min</span>
					<input type='range' value='$selected'  class='form-control' NAME='$name' id='$name' onchange=\"(document.getElementById('div_$name').innerHTML=(this.value));$onchange\" min='$min' max='$max'  >
					<span class='input-group-addon'>$max</span><span class='input-group-addon alert-success' id= 'div_$name'>$selected</span>
				</div>" ;


										}else{$resultado = "<div class='alert alert-warning'><i class='fa fa-exclamation-triangle'></i> No hay resultados</div>";}

return $resultado;
}
 
function confirma_campo($valor_1,$valor_2,$campo,$campo_confirmacion){
		$respuesta = new xajaxResponse('utf-8');
		$pos = strpos($campo,"email");
		
if($pos == "") { //// si no es un email
	   }
	   else {//// si es un email se revisa
	   $email = validar_email("$valor_1");
	   if($email === 0 ) {
	   		$respuesta->addAssign("$campo","value","");
	   		$respuesta->addAssign("$campo"."_grupo","className"," input-group has-error ");
	   		$respuesta->addAssign("$campo_confirmacion"."_grupo","className"," input-group has-error ");
	   		$respuesta->addAlert("El email no es valido ");
				$respuesta->addScript("document.getElementById('$campo').focus(); ");
						return $respuesta;
								   }
			else{
								   }
	   }
	  

		
		if($valor_1 != $valor_2){$resultado = "Los valores NO son iguales";
		$respuesta->addAlert("$resultado");
		///	$respuesta->addAssign("$campo","style.color","red");


			$respuesta->addAssign("$campo","value","$pos");
			$respuesta->addAssign("$campo_confirmacion","value","");
			$respuesta->addAppend("$campo"."_grupo","className"," has-error ");
			$respuesta->addAppend("$campo_confirmacion"."_grupo","className"," has-error ");
			$respuesta->addScript("document.getElementById('$campo').focus(); ");
			//        document.getElementById('mobileno').focus(); 

	
		}else{
	$respuesta->addAssign("$campo_confirmacion","style.color","green");
	
			$respuesta->addAssign("$campo"."_grupo","className"," input-group has-success ");
			$respuesta->addAssign("$campo_confirmacion"."_grupo","className"," input-group has-success ");
			}
		return $respuesta;	
}
$xajax->registerFunction("confirma_campo");
		
		
function validar_campo($valor,$campo,$tabla,$div,$id){
$valor	= mysql_seguridad($valor);
$respuesta = new xajaxResponse('utf-8');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta="SELECT $campo FROM $tabla WHERE $campo = '$valor' LIMIT 1";
$sql =mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0' ){
$verificacion = "atencion"; $existe='';

$respuesta->addAssign($campo,"value","");
///$respuesta->addAlert("El valor $valor $existe existe");
$resultado = "<strong class='error'>Grrr  $valor $existe existe</strong>";
$respuesta->addAssign("$id","style.backgroundColor","pink");
$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;
										}else {$verificacion ="check";  $existe='NO';}
$resultado = "<strong class='ok'>Ok, buen $campo !</strong>";
$respuesta->addAssign("$id","style.backgroundColor","#CBE7CB");
//$resultado .= "$valor,$campo,$tabla,$div";
$respuesta->addAssign($div,"innerHTML",$resultado);


return $respuesta;
} 
$xajax->registerFunction("validar_campo");


function comprobar_email($email,$tipo,$campo){ 
$email	= mysql_seguridad($email);
$respuesta = new xajaxResponse('utf-8');
if($tipo =='tercero') {$id_campo='tercero_email';}


else{$id_campo = 'email';}

if($campo !=''){
$id_campo="$campo";
}


if ($email == "" AND $tipo==''){
	$respuesta->addAlert("El campo email es obligatorio ");
			$respuesta->addAssign("$id_campo","style.backgroundColor","pink");
			$respuesta->addAssign("$id_campo","value","");
			return $respuesta;
	}
		
   	$mail_correcto = 0; 
   	//compruebo unas cosas primeras 
   	if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
      	 if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
         	 //miro si tiene caracter . 
         	 if (substr_count($email,".")>= 1){ 
            	 //obtengo la terminacion del dominio 
            	 $term_dom = substr(strrchr ($email, '.'),1); 
            	 //compruebo que la terminación del dominio sea correcta 
            	 if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
               	 //compruebo que lo de antes del dominio sea correcto 
               	 $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
               	 $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
               	 if ($caracter_ult != "@" && $caracter_ult != "."){ 
                  	 $mail_correcto = 1; 
               	 } 
            	 } 
         	 } 
      	 } 
   	} 
   	if ($mail_correcto AND $tipo=='' ) 
      	{ 
$consulta= "SELECT email FROM usuarios WHERE email = '$email' LIMIT 1 ";    
	$link=Conectarse();	
$sql=mysql_query($consulta,$link);  
$revisa=mysql_result($sql,0,"email");
if ($revisa != ''){

	$respuesta->addAlert("$email: ya está registrado ");
			$respuesta->addAssign("email","style.color","red");
			$respuesta->addAssign("email","value","");
			return $respuesta;
	}	
      	$respuesta->addAssign("email","style.color","green");}
   elseif ($mail_correcto AND $tipo==='revisar'  )  {
   			$revisar = remplacetas("usuarios","email",$email,"email","");
   			if($revisar[0] != '') {
      	
      $respuesta->addAssign("$campo","style.color","white");
      $respuesta->addAssign("$id_campo","style.backgroundColor","green");
   											}else{
   		$respuesta->addAlert("$email: No existe en el sistema)");
			$respuesta->addAssign("$campo","value","");										
   											}
      return $respuesta;
      }
      	
      	elseif ($mail_correcto AND $tipo==='tercero' )  {
		$documento = remplacetas("terceros","email",$email,"documento",""); 
		if($documento[1] =='') { /// si el tercero NO existe 
		
		}else {	/// si el tercero existe en el sistema	
		
		$tipo_persona = remplacetas("terceros","id",$documento[1],"tipo_persona","");
		
		if($tipo_persona[0] =='1') {
		$razon_social = remplacetas("terceros","id",$documento[1],"razon_social",""); 
					$resultado .= " $razon_social[0]]  Nit: $documento[0]";
		} else {
		$primer_nombre = remplacetas("terceros","id",$documento[1],"p_nombre","");
		$segundo_nombre = remplacetas("terceros","id",$documento[1],"s_nombre","");
		$primer_apellido = remplacetas("terceros","id",$documento[1],"p_apellido","");
		$segundo_apellido = remplacetas("terceros","id",$documento[1],"s_apellido",""); 		
					$resultado .=" \r $primer_nombre[0] $segundo_nombre[0] $primer_apellido[0] $segundo_apellido[0] \r  Documento: $documento[0]";
		}

      	      	$respuesta->addAlert("$email: $resultado");
      	      	$respuesta->addAssign("tercero_documento","value","$documento[0]");
      	      	$respuesta->addAssign("tercero_primer_nombre","value","$primer_nombre[0]");
      	      	$respuesta->addAssign("tercero_segundo_nombre","value","$segundo_nombre[0]");
      	      	$respuesta->addAssign("tercero_primer_apellido","value","$primer_apellido[0]");
      	      	$respuesta->addAssign("tercero_segundo_apellido","value","$segundo_apellido[0]");
      	      	$respuesta->addAssign("tercero_razon_social","value","$razon_social[0]");
      	      	$respuesta->addAssign("tercero_id","value","$documento[1]");

			}
      	      	
      	}
   	else 
      	{$respuesta->addAlert("$email: no es un correo válido");
      		$respuesta->addAssign("$id_campo","style.backgroundColor","pink");
      					$respuesta->addAssign("$id_campo","value","");
			}
			return $respuesta;
} 
$xajax->registerFunction("comprobar_email");
function obtener_ip()
{   
if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
		
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	
	return $_SERVER['REMOTE_ADDR'];
/*
    if (isset($_SERVER)) {

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        
        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];

        return $_SERVER["REMOTE_ADDR"];
    }

    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');

    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');

    return getenv('REMOTE_ADDR');
    */
}
?>