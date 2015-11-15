<?php

$email = remplacetas('empresa','id','1','email') ;
$email = "<strong>$email[0]</strong>";
$razon_social = remplacetas('empresa','id','1','razon_social') ;
$razon_social ="<strong>$razon_social[0]</strong>";
$aviso ="

<div class='container-fluid'>
<!-- 
PARA CAMBIAR EL CONTENIDO DE ESTE MENSAJE EDITE EL ARCHIVO 
psi.php 
-->
<h1>Aviso de privacidad 
<small>Y políticas de manejo de información personal.</small> 
</h1>
<p>En $razon_social respetamos y protegemos tus datos personales</p>

<p>Sabemos que tu privacidad y tus datos personales son muy importantes. Por eso, en cumplimiento de la Ley 1581 de 2012 y del Decreto 1377 de 2013, Decreto 886 de 2014 -los cuales desarrollan el derecho constitucional (Habeas Data) que tienen todas las personas de conocer, actualizar, rectificar o suprimir cualquier tipo de información recogida sobre ellas en bases de datos o archivos-, solicitamos tu autorización para continuar realizando el tratamiento de tus datos personales en los siguientes términos:</p>

<p>$razon_social se toma en serio tus datos personales y te damos todas las garantías para que tus derechos sean una realidad. $razon_social como encargada del tratamiento de los datos personales y por tanto, será ella la que realizará la recolección, almacenamiento, uso, circulación o supresión de los datos personales en nombre de $razon_social y conforme a la finalidad que señalemos como responsables del tratamiento de datos personales.</p>

<p>En $razon_social necesitamos tus datos personales para establecer un canal de comunicación y mantenerte informado e informada de nuestras actividades relacionadas con nuestra actividad. Por otra parte y debido a la naturaleza de nuestra institución estos datos son necesarios para cumplir con la relación Cliente-vendedor o como preferimos llamarlos Prosumidores.</p>

<p>Estas actividades comprenden la difusión de alertas, lanzamientos, comunicados, boletines, noticias, convocatorias, campañas, eventos, talleres, seminarios, etc., a través de la lista de correo de la comunidad , de los correos electrónicos recopilados en listas de asistencia a eventos organizados por la comunidad y del formulario Contacto de nuestra plataforma web, y de la base de datos que hemos elaborado a partir de la información que se encuentra públicamente en Internet, entre otros.</p>

<p>$razon_social, implementará las medidas técnicas necesarias para garantizar la autenticidad, integridad y confidencialidad de la información. Sin embargo, si estás interesado o interesada en recibir información de $razon_social podremos compartir tus datos personales con ésta si lo autorizas de forma expresa e informada.</p>

<p>Te recordamos que tienes derecho al acceso, consulta, rectificación, actualización y eliminación de tus datos en los términos de la Ley 1581 de 2012 y del Decreto 1377 de 2013, Decreto 886 de 2014. Para el ejercicio de estos derechos, o si no estás interesado o interesada en seguir recibiendo nuestra información y no nos autorizas para el tratamiento de tus datos personales de acuerdo con nuestra Política de privacidad, puedes escribirnos a $email</p>

<p>Si pasados 30 días hábiles a partir del recibo de este mensaje no hemos recibido alguna comunicación en donde nos indiques que NO nos autorizas a efectuar el tratamiento de tus datos personales, asumimos que nos has autorizado y continuaremos realizando dicho tratamiento. No obstante, conservas el derecho a solicitar la supresión, actualización de tus datos y a revocar esta autorización en cualquier momento.</p>

<p>Si quieres comunicarte con $razon_social , encargada del tratamiento de datos personales, puedes escribirle al área de Comunicaciones a $email</p>

<div class='alert alert-danger'>

<p>ATENCION: Puede existir una versión mas reciente de este archivo en http://qwerty.co/milfs por favor compruebelo antes de modificarlo. </p>

<p>Este sistema podría tener código basado en otros programas y especialmente en http://GaleNUx.com el cual tiene Copyright ©  13-22-2/ 17-Dic-2008 Dirección nacional de derechos de autor Colombia pero igualmente distribuido bajo licencia GPL V3.  http://GaleNUx.com Es un sistema para de información para la salud adaptado al sistema de salud Colombiano.</p>

<p>Si necesita consultoría o capacitación en el manejo, instalación y/o soporte o ampliación de prestaciones de GaleNUx por favor comuníquese con nosotros al email correo@qwerty.co.</p>

<p>Este programa es software libre: usted puede redistribuirlo y/o modificarlo bajo los términos de la Licencia Pública General GNU publicada por la Fundación para el Software Libre, ya sea la versión 3 de la Licencia, o cualquier versión posterior.</p>

<p>Este programa se distribuye con la esperanza de que sea útil, pero SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita MERCANTIL o de APTITUD PARA UN PROPÓSITO DETERMINADO. Consulte los detalles de la Licencia Pública General GNU para obtener una información más detallada. </p>

<p>Debería haber recibido una copia de la Licencia Pública General GNU junto a este programa. En caso contrario, consulte <http://www.gnu.org/licenses/>.</p>

<h2>El equipo de MILFS agradece especialmente a todas las instituciones y personas que han hecho este proyecto posible con su inspiración, patrocinio y cientos de horas de dedicación.<h2>




</div>
</div>
";

//$aviso= nl2br($aviso);
//print($aviso);
?>