<?php
header("Content-Type: text/css");
echo dibuja_clase();

function dibuja_clase(){

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT elemento FROM estilos GROUP BY elemento";
$sql=mysql_query($consulta,$link);


if (mysql_num_rows($sql)!='0'){
	mysql_data_seek($sql, 0);

while( $row = mysql_fetch_array( $sql ) ) {
$elemento= dibuja_elemento($row[elemento]);
$resultado .= "$row[elemento]{
$elemento
}\n";
															}
										}
										print $resultado;
return;
}

function dibuja_elemento($elemento){
	$link=Conectarse(); 
		mysql_query("SET NAMES 'utf8'");
		$consulta = "SELECT * FROM estilos WHERE elemento = '$elemento' ";
		$sql=mysql_query($consulta,$link);
	if (mysql_num_rows($sql)!='0'){
		while( $row = mysql_fetch_array( $sql ) ) {
			if($row[color] !=='') {$color = "$row[color]";}else{$color="";}
			$resultado .= "$row[label]:$row[valor] $color ;\n";
																}
													
										}
return $resultado;
}

function Conectarse(){
	if ( !isset ( $link ) ) {
	include("../includes/datos.php");
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
 ?>