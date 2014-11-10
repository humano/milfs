<?php
function login_boton($formulario){
		if($formulario =='x') {
			session_destroy();
			$respuesta = new xajaxResponse('utf-8');
			$respuesta->addRedirect("index.php");
			return $respuesta;
									}
								
	if(isset($_SESSION[id])){

$accion = "<li><a class=' btn  '  onclick=\"xajax_login_boton('x') \"><i class='fa fa-sign-out fa-fw'></i>$_SESSION[username]</a></li>";
	}else{
	$accion = registro_express("nuevo_$nombre_formato","boton");
		print $accion;
	return;
//	return $login;
	}
	$resultado ="
      <div id='login_div'   name='login_div' style=''  >
  			<ul class='nav navbar-nav navbar-right'  >
  				$accion
         </ul>      
      </div>
";	
	print $resultado;
	return;
	}
$xajax->registerFunction("login_boton");



function registro_express($formulario,$accion) {
	$formulario	= mysql_seguridad($formulario);
//	if(is_array($formulario) ){$nombre_formulario = $formulario['nombre_formulario'];}else{$nombre_formulario = "$formulario";}
	if($nombre_formulario =="") {$nombre_formulario = "login";}
/*	
	foreach($formulario as $c=>$v){ 

//LISTA ELEMENTOS DE UN ARRAY
if (is_array($v) ){
	foreach($v as $C=>$V){
			if($V != '') {$resultado .= "$$c =  \$formulario[$c][$C]; // <b>$V</b> </p>";}  
								}
									

						} else {
			if($v !='') {$resultado .= "$$c = \$formulario[$c]; // <b>$v</b> </p>";}
 								}
										
										}  
	*/
	$boton ="<div class='btn btn-block btn-success' onclick=\"xajax_registro_express(xajax.getFormValues('$nombre_formulario'),'confirmar')\">Grabar </div>";
$respuesta = new xajaxResponse('utf-8');
	if($accion =='confirmar')
	{
		
				$div = "registro_confirmacion_email";

if($formulario[password_express_confirmar] =="" OR $formulario[password_express_confirmar] != $formulario[password_express] ){
	$resultado ="<div class='alert alert-danger'>Por favor escribe y confirma una clave.</div> $boton";
		   	$respuesta->addAssign("password_express"."_grupo","className"," input-group has-error ");
	   		$respuesta->addAlert("Por favor escribe y confirma la clave");
				$respuesta->addScript("document.getElementById('password_express').focus(); ");
				$respuesta->addAssign("$div","innerHTML",$resultado);
return $respuesta;

				}
		if($formulario[email_express_confirmar] !="") {
			$email_envio = $formulario['email_express_confirmar'];

		$rrn = rand(123,999);
		$rrncode = MD5("$rrn");
//	$aviso= aviso('','mail privacidad','');
			$direccion =  remplacetas("empresa","id",$id_empresa,"direccion","");
		$telefono =  remplacetas("empresa","id",$id_empresa,"telefono","");
		$web =  remplacetas("empresa","id",$id_empresa,"web","");
		$email =  remplacetas("empresa","id",$id_empresa,"email","");
		$imagen =  remplacetas("empresa","id",$id_empresa,"imagen","");
		$razon_social =  remplacetas("empresa","id",$id_empresa,"razon_social","");
		$slogan =  remplacetas("empresa","id",$id_empresa,"slogan","");
		
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: Comunidad QWERTY.co <comunidad@qwerty.co>\r\n"; 
$headers .= "Reply-To: comunidad@qwerty.co\r\n"; 
$headers .= "Return-path: comunidad@qwerty.co\r\n"; 

$asunto= "Código de validación";
$cuerpo ="
<div style='border: solid 1px; padding:20px ; border-radius: 10px; background-color:#E6F8E0 '>
<h1>Comunidad QWERTY.co</h1>

<hr />
<h3>Código de validación</h3>
<p>Bienvenido a nuestra comunidad <strong>QWERTY.co<strong> Por favor digita el siguente código para validar tu cuenta.</p>
<H1>$rrn</H1>


<h3>Toda la ayuda que necesitas la puedes encontrar en nuestra sección de respuestas a preguntas frecuentes: http://qwerty.co/faq.</h3>
</div>
		$aviso
			";

mail("$email_envio","$asunto","$cuerpo","$headers") ;
			$boton ="<div class='btn btn-block btn-success' onclick=\"xajax_registro_express(xajax.getFormValues('$nombre_formulario'),'validar');\">Confirmar</div>";
			$control = MD5(mktime().$rrncode);
	$resultado .="
		<div class='row'>
			<div class='col-sm-2'>
			</div>
			<div class='col-sm-8'>
				<div class='form-group has-error' id='codigo_confirmacion'>
				<span class='help-block'>Escribe el código de confirmación <strong>$rrn</strong></span>
					<div class='input-group'  id=''>
						<span class='input-group-addon'>
							<i class='fa fa-key'></i>
						</span>
						<input type='hidden' id='rrn' name='rrn' value='$rrncode'>
						<input type='hidden' id='hidden' name='control' value='$control'>
						<input type='number' id='codigo_confirmacion' name='codigo_confirmacion' placeholder='Codigo de validación' class='form-control'> 
					</div>
				
				</div>
			</div>			
			<div class='col-sm-2'>
			
			</div>
		</div>	
	$boton
	";
									}else{
	$resultado .= "$boton <div class='alert alert-danger'>No hay un email válido </div>";
									
									}
									
$respuesta->addAssign("$div","innerHTML",$resultado);
return $respuesta;
			
			
	}elseif($accion =="elegir") {
		$form = "
<div id='login_express'>
	<div class='' id='datos_usuario'>
		<div class='row' id=''>	
			<div class='col-sm-6'>
				<div class='btn btn-primary  btn-block' onclick=\"xajax_registro_express(xajax.getFormValues('$nombre_formulario'),'nuevo');\" >Usuario nuevo</div>
			</div>
			<div class='col-sm-6'>
				<div class='btn btn-success btn-block'  data-target=\"#modal_login\" data-toggle=\"modal\" >Ya estoy registrado</div>
			<div>
		</div>

	</div>
</div>
		              <a target='_blank' href='http://qwerty.co/faq/category/19/privacidad-y-protecci%C3%B3n-de-datos.html'>Antes de continuar, por favor revisa nuestras Políticas de privacidad y protección de datos.</a> </p> 
		              ";
				return $form;
	}
elseif($accion =="validar") {
				$boton ="<div class='btn btn-block btn-success' onclick=\"xajax_registro_express(xajax.getFormValues('$nombre_formulario'),'confirmar');\">Confirmar</div>";
				$div = "registro_confirmacion_email";
				
				
if($formulario[password_express_confirmar] =="" OR $formulario[password_express_confirmar] != $formulario[password_express] ){
	$resultado ="<div class='alert alert-danger'>Por favor escribe y confirma una clave.</div> $boton";
		   	$respuesta->addAssign("password_express"."_grupo","className"," input-group has-error ");
	   		$respuesta->addAlert("Por favor escribe y confirma la clave");
				$respuesta->addScript("document.getElementById('password_express').focus(); ");
				$respuesta->addAssign("$div","innerHTML",$resultado);
return $respuesta;

				}
$codigo_confirmacion = $formulario[codigo_confirmacion]; // 
$rrn = $formulario[rrn]; // 
$codificado = md5("$codigo_confirmacion");
if($rrn == $codificado) {
$control = $formulario[control]; // nuevo_ 
$nombre_formulario = $formulario[nombre_formulario]; // nuevo_
$email_express = $formulario[email_express]; // aa@gmail.com
$email_express_confirmar = $formulario[email_express_confirmar]; // aa@gmail.com
$nombre_express = $formulario[nombre_express]; // nombre
$apellido_express = $formulario[apellido_express]; // apellido
$telefono_express = $formulario[telefono_express]; // 324343
$password_express = $formulario[password_express]; // 1234
$password_express_confirmar = $formulario[password_express_confirmar]; // 23456
	$ip = obtener_ip();

	$link = Conectarse();
mysql_query("SET NAMES 'utf8'");

$consulta = "INSERT INTO usuarios (username,p_nombre,p_apellido,email,bio,passwd,control,status,lastip,id_empresa) 
				VALUES ('$email_express_confirmar','$nombre_express','$apellido_express','$email_express_confirmar','','".MD5($password_express_confirmar)."','$control','1','$ip','$_SESSION[id_empresa]')";
	$sql_consulta=mysql_query($consulta,$link);
	if($sql_consulta) {
		$id = mysql_insert_id();

	$consulta_localizacion = "INSERT INTO localizacion (id_localizado,telefono,id_grupo) VALUES ('$id','$telefono_express','1')";
	$consulta_empresa = "INSERT INTO empresa SET razon_social = '$nombre_express $nombre_express', regimen_tributario = 'simplificado' ,id_responsable='$id'";
	$sql_localizacion=mysql_query($consulta_localizacion,$link);
	$sql_empresa=mysql_query($consulta_empresa,$link);
	if($sql_empresa) {
			$id_empresa = mysql_insert_id();
			$_SESSION[id_empresa] = $id_empresa;
			$_SESSION[id] = $id;
			}
	//// faltan variables de session
	
	}
$resultado = "<div class='alert alert-success'><h1>Bienvenido</h1>
<p>Felicitaciones, tu registro se efectuó correctamente, ahora puedes usar nuestros servicios.</p>
</div>";
$div = "contenido";
$respuesta->addAssign("$div","innerHTML",$resultado);
return $respuesta;
}else{
$resultado = "<div class='alert alert-danger'><h3>Error</h3>El Código de confirmación no es correcto, por favor inténtalo nuevamente.</div>";
}

$resultado .= "$boton";
$respuesta->addAssign("$div","innerHTML",$resultado);
return $respuesta;


}
elseif($accion =="nuevo") {
//$respuesta = new xajaxResponse('utf-8');
		$div="contenido";
$form = "
<div class='alert alert-warning'>
<form class='form' id='$nombre_formulario' name='$nombre_formulario' >
<input type='hidden' value = 'nuevo_$nombre_formato' id='nombre_formulario' name='nombre_formulario' >
	<legend>Datos de contacto</legend>
		<div class='row'>
			<div class='col-sm-6'>
				<div class='input-group' id='email_express_grupo'>
					<span class='input-group-addon'>
						<i class='fa fa-envelope-o'></i>
					</span>
					<input value=''  type='email' id='email_express' name='email_express' placeholder='Email' class='form-control'
						onclick=\"(this.value=''); \"
					 	onchange=\"xajax_validar_usuario('email',(this.value),'email_express','login'); \"  > 
				</div>
			</div>
			<div class='col-sm-6'>
				
				<div class='input-group' id='email_express_confirmar_grupo'>
					<span class='input-group-addon'>
						<i class='fa fa-envelope'></i>
					</span>
					<input value='' type='email' id='email_express_confirmar' name='email_express_confirmar' placeholder='Confirmar email' class='form-control'
					onclick=\"(this.value=''); \"
					onchange= \"xajax_confirma_campo((document.getElementById('email_express').value),(this.value),'email_express','email_express_confirmar'); \"  > 
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-12'>
				<div class='input-group' id='nombre_express'>
					<span class='input-group-addon'>
						<i class='fa fa-user'></i>
					</span>
					<input type='text' id='nombre_express' name='nombre_express' placeholder='Nombre' class='form-control'> 
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-12'>
				<div class='input-group' id='apellido_express'>
					<span class='input-group-addon'>
						<i class='fa fa-user '></i>
					</span>
					<input type='text' id='apellido_express' name='apellido_express' placeholder='Apellido' class='form-control'> 
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-12'>
				<div class='input-group' id='telefono_express'>
					
					<span class='input-group-addon'>
						<i class='fa fa-phone'></i>
					</span>
					<input type='phone' id='telefono_express' name='telefono_express' placeholder='Teléfono' class='form-control' 
					onclick=\"(this.value=''); \"> 
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-6'>
				<div class='input-group' id='password_express_grupo'>
					<span class='input-group-addon'>
						<i class='fa fa-key'></i>
					</span>
					<input type='password' id='password_express' name='password_express' placeholder='Clave' class='form-control'
					onclick=\"(this.value=''); \"> 
				</div>
			</div>
			<div class='col-sm-6'>
				<div class='input-group' id='password_express_confirmar_grupo'>
					<span class='input-group-addon'>
						<i class='fa fa-lock'></i>
					</span>
					<input type='password' id='password_express_confirmar' name='password_express_confirmar' placeholder='Confirma tu clave' class='form-control'
					onclick=\"(this.value=''); \"
					onchange= \"xajax_confirma_campo((document.getElementById('password_express').value),(this.value),'password_express','password_express_confirmar'); \" > 
				</div>
			</div>
		</div>
		<div class='row'>
			<div class='col-sm-12'>
				<br>
				<div id='registro_confirmacion_email'>				
$boton
				</div>
				
			</div>
		</div>

</form>
</div>
";		
$respuesta->addAssign("$div","innerHTML",$form);
return $respuesta;
		
	}


elseif($accion =="boton"){ 

$modal ="      
		<form class='navbar-form navbar-left' role='form' id='form_contacto' name='form_contacto'>
        <div class='form-group'>
          <input type='text' class='form-control input-small' placeholder='Email o usuario' id='email' name='email'>
        </div>
        <div class='form-group'>
          <input type='password' class='form-control input-small' placeholder='Clave ****' id='password' name='password'>
        </div>
        <div  class='btn btn-default' onclick=\"xajax_revisar_ingreso(xajax.getFormValues('form_contacto')) ; \"><i class='fa fa-sign-in fa-fw'></i></div>
      </form>";
return; //$modal;
 }
 else{}
$respuesta->addAssign("$div","innerHTML",$resultado);
return $respuesta;
			
}
$xajax->registerFunction("registro_express");


function revisar_ingreso($formulario){
	$formulario =	mysql_seguridad($formulario);
	if($formulario =="") {
					$formulario ="
<form class='form-horizontal' id='form-contacto' name='form-contacto' >
	<fieldset>	
  		<label class='' for='email'>Correo o usuario</label>
  		<div class='input-group' id='grupo_email'>
  		<span class='input-group-addon'><i class='fa fa-user fa-fw'></i></span>
  		<input   id='email'name='email' class='form-control input-large' type='email'  placeholder ='Correo o usuario'>
		</div>


<!-- Text input-->

  
  	<label class='control-label' for='password'>Clave</label>
  <div class='input-group' >
		<span class='input-group-addon'><i class='fa fa-lock fa-fw'></i></span>
    	<input class='form-control input-large' id='password' name='password' type='password' placeholder='clave'  required='' >  
  </div>
  
  <div class='input-group'>
  	<label for='recordar'>No recuerdo mi clave
  	<input type='radio' value ='1' id='recordar' name='recordar' >
  </div>

</fieldset>
</form>
	";
$resultado = "
				<div id='login_ok'>
				$formulario
	             <!-- Button -->
            <div class='control-group'>
              <label class='control-label' for='signin'></label>
              <div class='controls'>
                <button id='ingresar' name='ingresar' class='btn btn-success btn-block' onclick=\"xajax_revisar_ingreso(xajax.getFormValues('form-contacto')) \">Ingresar</button>
              </div>
            </div>
            <br>
				<div id='login_info'></div>
				</div>
	";
if(!isset($_SESSION[id])){ print $resultado; }else {
$nuevo = "<div class='btn btn-primary  btn-block' onclick=\"xajax_registro_express(xajax.getFormValues('login'),'nuevo');\">Usuario nuevo</div>";
print $nuevo ;
}
return;	
	}
	$div='contenido';
	$respuesta = new xajaxResponse('utf-8');

	$email = $formulario[email];
	$recordar = $formulario[recordar];

	
	if($email =='') {

	$respuesta->addAlert("Ingresa tu nombre de usuario o email");
	return $respuesta;
	}	
	if($formulario[password] =='' AND $recordar =='') {

	$respuesta->addAlert("Ingresa tu clave");
	return $respuesta;
	}
		$password= MD5($formulario[password]);
			$link=Conectarse(); 		
			mysql_query("SET NAMES 'utf8'");
			
	if($recordar =='1') 
{
if($email =='') 
	{ 
$tipo='danger';
$mensaje ="Por favor escribe tu <strong>correo o usuario</strong> si olvidaste tu clave.";
	$respuesta->addAssign($div,"innerHTML",$mensaje);
	return $respuesta;
	}else
	{
$consulta = "SELECT id,email,control,id_empresa FROM usuarios WHERE (email = '$email' OR username = '$email' )";
			$sql=mysql_query($consulta,$link);
if (mysql_num_rows($sql)!='0')
		{
$firma_recuperacion = sha1("$control".mktime().""); 
$correo = mysql_result($sql,0,"email");
$control = mysql_result($sql,0,"control");
$id_usuario = mysql_result($sql,0,"id");
$id_empresa = mysql_result($sql,0,"id_empresa");
$firma ="UPDATE `usuarios` SET `firma_recuperacion` = '$firma_recuperacion' WHERE `usuarios`.`id` = '$id_usuario';";
$cambiar_firma=mysql_query($firma,$link);
$tipo='success';

		$direccion =  remplacetas("empresa","id",$id_empresa,"direccion","");
		$telefono =  remplacetas("empresa","id",$id_empresa,"telefono","");
		$web =  remplacetas("empresa","id",$id_empresa,"web","");
		$email =  remplacetas("empresa","id",$id_empresa,"email","");
		$imagen =  remplacetas("empresa","id",$id_empresa,"imagen","");
		$razon_social =  remplacetas("empresa","id",$id_empresa,"razon_social","");
		$slogan =  remplacetas("empresa","id",$id_empresa,"slogan","");

$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: $razon_social[0] <$email[0]>\r\n"; 
$headers .= "Reply-To: $email[0]\r\n"; 
$headers .= "Return-path: $email[0]\r\n"; 

$asunto= "Cambio de clave";
$cuerpo ="
$razon_social[0]
<div style='border: solid 1px; padding:20px ; border-radius: 10px; background-color:#E6F8E0 '>
<h1>Aplicación de formularios</h1>

<hr />
<p>Se ha solicitado un cambio de clave para tu usuario.<br />
Si fuiste tu quien lo solicit&oacute;, sigue este <a href='http://$_SERVER[HTTP_HOST]/milfs/index.php?change=$firma_recuperacion'>enlace</a> para realizar el cambio.</p>
http://$_SERVER[HTTP_HOST]/milfs/index.php?change=$firma_recuperacion

<h3>Si no solicitaste el cambio, por favor comun&iacute;calo respondiendo este correo.</h3>
</div>
		
			";
			$mensaje =" Enviamos un correo con la confirmación a $correo";
	mail("$correo","$asunto","$cuerpo","$headers") ;
		}else 
		{
$tipo='danger';
$mensaje ="El <strong>correo o usuario</strong> no se encuentra registrado aún.";
		}
	}
	$resultado ="<div class='alert alert-$tipo'>$mensaje</div>";
	$respuesta->addAssign($div,"innerHTML",$resultado);

	return $respuesta;
}
	
$consulta = "SELECT * FROM usuarios WHERE (email = '$email' OR username = '$email' )AND passwd = '$password'  LIMIT 1";


			$sql=mysql_query($consulta,$link);
			if (mysql_num_rows($sql)!='0'){
				if(mysql_result($sql,0,"status") === '0' ) {
					$resultado = "
					<div class='alert alert-danger' > 
					Aún no se ha confirmado tu email, por favor revisa tu correo o ponte en 
					 <a  href='#'  data-target='#contacto'  data-toggle='modal'><b>contacto</b></a> para mas información.</p>
					</div >";
					//$div ="login_ok";

					 }
				else {
						//session_destroy();
						$_SESSION = array();
						$_SESSION[username]= mysql_result($sql,0,"username");
						$_SESSION[id]= mysql_result($sql,0,"id");
						$_SESSION[id_empresa]= mysql_result($sql,0,"id_empresa");



						$resultado .="
						$sucursal
						
						<div class=' alert alert-success'><h3><b>Hola $_SESSION[username]</b</h3></div>";
						$respuesta->addRedirect("index.php");
						}	
													}else{
						$resultado = "
					<div class='alert alert-danger' > 
					Los datos no son correctos, por favor rectifica o ponte en  para mas información.</p>
					</div >";
															}
	$respuesta->addAssign($div,"innerHTML",$resultado);
	return $respuesta;
	}
	
$xajax->registerFunction("revisar_ingreso");

function cambiar_password_formato($change) {
	$firma_recuperacion = remplacetas("usuarios","firma_recuperacion",$change,"firma_recuperacion") ;
	if($firma_recuperacion[0] =='') {
		$formato ="<div class='alert alert-danger'><h1>Lo sentimos</h1><p>El Link ya no es válido</p></div>";
		return   $formato; 
	}
$formato="
<DIV id='cambio_password'>
<div  class='container alert alert-warning'>
							<div  class='row'>
								
									<form role='form' id='cambiar_password_form' name='cambiar_password_form'>
									<fieldset>
									<legend class='text-center'>Cambio de clave</legend>
										<div class='col-sm-6'>
									 				<div style='margin-bottom: 25px' class='input-group' id='password_nuevo_grupo'>
                                        <span class='input-group-addon'><i class='fa fa-unlock-alt fa-fw'></i></span>
                                        <input id='password_nuevo' type='password' class='form-control' name='password_nuevo' placeholder='Nuevo password'>
                                    	</div>
                              </div>
                              <div class='col-sm-6'>
									 				<div style='margin-bottom: 25px' class='input-group' id='password_confirmacion_grupo'>
                                        <span class='input-group-addon' ><i class='fa fa-lock fa-fw'></i></span>
                                        <input id='password_confirmacion' type='password' class='form-control' name='password_confirmacion' placeholder='Confirmar password'
                                        onchange= \"xajax_confirma_campo((document.getElementById('password_nuevo').value),(this.value),'password_nuevo','password_confirmacion'); \" >
                                    	</div>
                                    	
                              </div>
									</fieldset>
									
								
							</div>
							<input type='hidden' id='firma_recuperacion' name='firma_recuperacion' value='$change'>
<a onclick=\"xajax_cambiar_password(xajax.getFormValues('cambiar_password_form')); \" class='btn btn-danger btn-block'>Grabar</a>
</form>
</DIV>
</div>

";
return $formato;
}

function cambiar_password($formulario){
	//	if ( !isset ( $_SESSION['id'] ) ) {	return;}
			$respuesta = new xajaxResponse('utf-8');
$formulario =	mysql_seguridad($formulario);
$actual= $formulario[password_actual];
$nuevo= $formulario[password_nuevo];
$confirmacion= $formulario[password_confirmacion];
$firma = $formulario[firma_recuperacion];
$firma_recuperacion = remplacetas("usuarios","firma_recuperacion",$formulario[firma_recuperacion],"firma_recuperacion") ;
if(isset($firma)) {$actual = $firma; $id_usuario = $firma_recuperacion[1]; }else{$id_usuario = $_SESSION[id];  }
$verifica = remplacetas("usuarios","id",$_SESSION[id],"passwd") ;

$size= strlen($nuevo);
if($nuevo != $confirmacion OR $actual =="" ){
	
	$respuesta->addAlert("Los valores no coinciden ( $formulario[firma_recuperacion]  ) $nuevo != $confirmacion $formulario[firma_recuperacion] $firma $actual \OR $actual");
return $respuesta;
}elseif($size < 8) {
	$respuesta->addAlert("Use un password mas seguro: Mínimo 8 caracteres.");
return $respuesta;
}
elseif( $firma_recuperacion[0] != $formulario[firma_recuperacion]){
		$respuesta->addAlert("El link ya no es valido");
		return $respuesta;

}
elseif($formulario[firma_recuperacion] =='' AND $verifica[0] != MD5($actual) ){
		$respuesta->addAlert("Error de password $formulario[firma_recuperacion]");
		return $respuesta;
}else{}
	
$link=Conectarse(); 
	mysql_query("SET NAMES 'utf8'");
	$nueva_firma = sha1(mktime());
	$consulta = "UPDATE usuarios SET  passwd =  '".MD5($nuevo)."' , firma_recuperacion = '$nueva_firma' WHERE  id = $id_usuario;";
	$sql_consulta=mysql_query($consulta,$link);
	if($sql_consulta) {
$resultado = "<div class='alert alert-success'>La clave se cambió con éxito.</div>";	
	}else{$resultado= "";}
	$respuesta->addAlert("La clave se cambió con éxito.");
				$respuesta->addRedirect("index.php");
	return $respuesta;
	}
	
$xajax->registerFunction("cambiar_password");



?>