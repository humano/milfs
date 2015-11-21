<?php


function tuitealo($form,$tipo) {
	if($tipo =='formulario') {
		 	$formulario = formulario_areas('15','campos');
		 			$descripcion = remplacetas('form_id','id','15','descripcion',"") ;
		 			$nombre = remplacetas('form_id','id','15','nombre',"") ;
							$formulario ="

		<h1 >$nombre[0]</h1>
		<h2>$descripcion[0]</h2>
	<form id='form_tuitealo'  >
	 $formulario
	<br>

	<div id='tuitealo_div'>
		<div id='tuitealo_error'></div>
	<a class='btn btn-block btn-primary' onclick=\"xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'previsualizar');\">Previsualizar</a>
	</div>
</form>
	</div>
	<br>
	<div  class='text-center'>
	<p class='text-center'>Powered by: <a href='http://qwerty.co/milfs'>MIFS</a></p> 	
	</div>

	<br>		
		
		";
		return $formulario;
	}
		$respuesta = new xajaxResponse('utf-8');
	$sujeto = $form[84][0];
	$accion = $form[85][0];
	$verbo = $form[86][0];
	$tiempo = $form[87][0];
	$ht = $form[88][0];
	$mensaje = $form[83][0];
	$arroba = $form[82][0];
	if( $accion =="" or $verbo =="" or  $tiempo =="" or  $ht =="" or   $arroba ==""  ) {
		$error ="<div class='alert alert-warning text-center'><h1><i class='fa fa-exclamation-triangle'></i> Hay campos vacíos</h1></div>";
			$respuesta->addAssign("tuitealo_error","innerHTML","$error");
			return $respuesta;
	
	}
	$arroba = remplacetas('form_datos','control',"$arroba",'contenido',"id_campo = '77'") ;
	$arroba = $arroba[0];
	$url_propia = urlencode("http://patos.redpatodos.co"); 
		
	$texto="$sujeto $accion $verbo $tiempo $ht $mensaje cc $arroba ";
	$texto = ucfirst($texto);
	$texto_url=urlencode($texto);
	$largo = strlen($texto.$url_propia); 
	if($largo > 140) { $alert ="danger"; $mensaje ="<i class='fa fa-exclamation-triangle'></i> El texto es demasiado largo y se recortará";
	 $texto = substr($texto, 0, 140)."..."; }
	else{$alert='success'; $mensaje="";}

	
	
	$url ="https://twitter.com/share?url=$url_propia&text=$texto_url";
   
	$previsualizar ="<br> 
			
		<div id='tuitealo_error'></div>	
	<div class='alert alert-$alert'><div class='badge'>$largo</div>$mensaje<h1>$texto</h1></div>

	<a class='btn btn-block btn-primary' onclick=\"xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'previsualizar');\">Previsualizar</a>
	<a class='btn btn-block btn-success' onclick=\"xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'confirmar');\">Tuitéalo</a>
	<img style='width:1px;' src='milfs/images/100x100.png' 
			onload=\"
			document.getElementById('82[0]').onchange = function(){xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'previsualizar')};
			document.getElementById('83[0]').onkeyup = function(){xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'previsualizar')};
			document.getElementById('84[0]').onchange = function(){xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'previsualizar')};
			document.getElementById('85[0]').onchange = function(){xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'previsualizar')};
			document.getElementById('86[0]').onchange = function(){xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'previsualizar')};
			document.getElementById('87[0]').onchange = function(){xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'previsualizar')};
			document.getElementById('88[0]').onchange = function(){xajax_tuitealo(xajax.getFormValues('form_tuitealo'),'previsualizar')};
			
			\" >
	"; 
	   	
if( $tipo =="previsualizar") {

			$respuesta->addAssign("tuitealo_div","innerHTML","$previsualizar");
			//$respuesta->addAlert("$texto $url");
			
			
			
		}else{
			///$respuesta->addAssign("tuitealo_div","innerHTML","$url");
			$respuesta->addScript("window.location.href ='$url';");
		}
		
			return $respuesta;
}
$xajax->registerFunction("tuitealo");


/*
function buscar_datos($valores,$id_form,$plantilla,$div){
	$valores = mysql_seguridad($valores);
	if (is_array($valores) ){
	$valor = $valores['valor'];
									}
	else {$valor=$valores;}
if($valor =='') {
$resultado="
<div class='col-sm-3 col-md-3'>
	<form class='navbar-form' role='search' id='formulario_buscar_datos' name='formulario_buscar_datos'>
		<div class='form-group'>
			<div class='input-group'>
				<input placeholder='Escribe para buscar' class='form-control' id='valor' name= 'valor'>
				<div class='input-group-btn'>
				<div class='btn btn-default' onclick =\"xajax_buscar_datos(xajax.getFormValues('formulario_buscar_datos'),'$id_form','$plantilla','$div'); \"><i class='glyphicon glyphicon-search'></i></div>
				</div>
			</div>
		</div>
	</form>
</div>
";
return $resultado;
						}else{
if($id_form !="") {$w_form ="form_id = '$id_form' AND ";}
$consulta ="SELECT * FROM  form_datos WHERE $w_form contenido like '%%$valor%%' group by control LIMIT 200  ";
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$sql=mysql_query($consulta,$link);
if (mysql_num_rows($sql)!=0){
mysql_data_seek($sql, 0);
$fila=1;
$divider=1;
$cols = (12/$divider);
$i =0;
while( $row = mysql_fetch_array( $sql ) ) {
if($i % $divider==0) {

		$encontrados .= "
		
						<div class='container-fluid ' role='row' id='grid_$i'  style=''>

							";
								}
			$i++;

   $datos = contenido_mostrar("$row[form_id]","$row[control]",'',"$plantilla");
	$contenido ="<div class='col-sm-$cols' style=''>$datos</div>";     	
	
	$encontrados .="$contenido";
	$fila++;
	if( $i % $divider==0) {
			$encontrados .= "</div>	";
								}
														}
										}
$resultado .="<div class='container-fluid'><h1>Resultados de: $valor</h1>$encontrados  </div>  ";						
$respuesta = new xajaxResponse('utf-8');
$respuesta->addAssign("$div","innerHTML",$resultado);
			return $respuesta;
			
						}
}
$xajax->registerFunction("buscar_datos");
*/
/*
function datos_grid($id_form,$filtro,$valor,$plantilla,$divider,$inicio,$limite) {
	$respuesta = new xajaxResponse('utf-8');
	$nuevo_inicio = ($inicio+$limite+1);
if($inicio =="") {
	$inicio = "0";
 $script = "
$(window).scroll(function() {
  if ($(window).scrollTop() == $(document).height() - $(window).height()) {
    xajax_datos_grid('$id_form','$filtro','$valor','$plantilla','$divider','$nuevo_inicio','$limite') ;
  }
});
";
//$respuesta->addScript("$script");	
//$respuesta->addAlert("$script");	
	
	}
if($limite =="") {$limite = "250";}

	if($valor !=""){
$md5_valor = $valor;
if($filtro !='' ){$w_filtro =" AND id_campo = '$filtro' AND md5(binary contenido) = '$md5_valor'  ";}
}
$consulta_total= "SELECT * FROM form_datos WHERE form_id= '$id_form' $w_filtro GROUP BY control ";
$consulta= "SELECT * FROM form_datos WHERE form_id= '$id_form' $w_filtro GROUP BY control LIMIT $inicio , $limite";
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
//mysql_real_escape_string($consulta);
$sql_total=mysql_query($consulta_total,$link);
$total = mysql_num_rows($sql_total);
$sql=mysql_query($consulta,$link);
		$descripcion = remplacetas('form_id','id',$id_form,'descripcion',"") ;
		$descripcion = " $descripcion[0]";
		$buscador  = buscar_datos("","$id_form","$plantilla","grid_resultado");
		$contenido = "<div class='container-fluid'>$descripcion $buscador</div> ";
		
if (mysql_num_rows($sql)!=0){
mysql_data_seek($sql, 0);
$fila=1;
if($divider =="") {
$divider=3;
}
$cols = (12/$divider);
$i =0;

while( $row = mysql_fetch_array( $sql ) ) {
			if($i % $divider==0) {

		$contenido .= "
		
						<div class='container ' role='row' id='grid_$i'  style='width: 80%; padding:5px;'>

							";
								}
			$i++;
$datos = contenido_mostrar("$id_form","$row[control]",'',"$plantilla");
if($cols =="12") { $cols_grid ="";}else { $cols_grid ="col-md-$cols";}
$contenido .="<div class='$cols_grid' style=''>$datos</div>";
$fila++;
	if( $i % $divider==0) {
			$contenido .= "</div>	";
								}
	
}
									}


$inicio = ($inicio+$limite+1);
$div_mas_contenido ="mas_contenido_".$inicio."_".$limite."";
$mostrado = ($inicio+$limite-1);
//$limite = ($inicio+$limite-1);
$resultado =" <br> 

	<div id='grid_resultado' style='background-color: #ffcc00'> 

		$contenido
		</div>
		<div class='container-fluid' >
		<div class='btn btn-default btn-block' id='$div_mas_contenido' onclick=\" xajax_datos_grid('$id_form','$filtro','$valor','$plantilla','$divider','$inicio','$limite') ;\" >
		Mostrar mas resultados 
		</div>
		</div>
	</div><br>
 ";


///$respuesta->addScript("$script");
$respuesta->addAssign("contenedor","innerHTML",$resultado);
			return $respuesta;
} 
$xajax->registerFunction("datos_grid");
	
*/
?>