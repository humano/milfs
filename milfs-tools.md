#Timeline (Lineas de Tiempo)

Esta herramienta permite visualizar en forma de linea de tiempo cualquiera de los formularios que tengamos en nuestro MILFS, un ejemplo de esto es el siguiente:
http://datos.labmde.org/timeline.php?id=22

La visualización se puede parametrizar en la base de datos en la tabla de parametrización un ejemplo de esto es lo siguiente:

~~~
INSERT INTO `parametrizacion` (`id`, `tabla`, `campo`, `opcion`, `descripcion`, `visible`) VALUES
(, 'form_id', '20', 'titulo', '148', '1'),
(, 'form_id', '20', 'plantilla:timeline', '<li id=''#$control'' > \r\n<img src=''images/secure/?file=600/$campo[0]'' width=''256''   />\r\n<h1>$campo[148]</h1>\r\n<p>$campo[142]<p> \r\n$campo[141]<br>\r\n$campo[135] $campo[138]\r\n<small>$campo[17] $campo[28] /  $campo[56] </small>\r\n $campo[143] \r\n</li>', '1');
~~~

#Formularios Embebidos



#Visualizacion de Mapas
