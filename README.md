<pre>
 __   __  ___   ___      _______  _______ 
|  |_|  ||   | |   |    |       ||       |
|       ||   | |   |    |    ___||  _____|
|       ||   | |   |    |   |___ | |_____ 
|       ||   | |   |___ |    ___||_____  |
| ||_|| ||   | |       ||   |     _____| |
|_|   |_||___| |_______||___|    |_______|

</pre>
DEFINICION
MILFS es una aplicación web para en la captura de datos de forma ágil y su
posterior proceso, a priori se puede ver como un sistema apra la creación 
de formularios pero su poder va mas allá, MILFS maneja los campos de los 
campos de los formularios de manera semántica lo que prermite su posterior 
interpretación, por ejemplo:

Si necesitamos recabar datos en un evento creamos un formulario con los campos:
1. Nombres
2. Email
3. Telefono
Estos campos solo los creamos la si no existen, luego para cada evento creamos 
un nuevo formulario y usamos los campos existentes y gracias a esto en la base 
de datos se almacenará siempre la información de "Nombres" en un campo "Nombres"
lo cual le propporciona semántica a la información.

MILFS también cuenta con campos especiales como el de mapa el cual proporciona
la posibilidad de georeferenciar los datos capturados y luego exibirlos como un
mapa. 

Si deseas capturar mucha información y almacenarla de manera estructurada o quieres
reemplazar cientos de hojas electronicas por un sistema de datos, MILF es lo 
que estabas buscando.

MILFS también cuenta con un subsistema de importación que te permite subir datos
almacenados en un archivo CSV.

Sabemos que aun nos falta mucha documentación para enseñar a manejar todo el poder
de MILFS, Pero bueno, gracias por la ayuda ;-) 


INSTALACION

1.  Volcar la base de datos MYSQL desde el archivo milfs.sql.gz

2.  Mover el directorio milfs a /var/www/html/milfs o un lugar accesible.

3.  Modificar el archivo milfs/includes/datos.php con los datos de acceso a
    la base de datos MySQL.

4.  Mover el directorio images_secure a un lugar no accesible via web /var/www/images_secure 
    Dar permiso de escritura al www-data sobre images_secure y su contenido.
    

5.  Ingresar por http al aplicativo eje. http://localhost/milfs

6.  Loguearse con usuario admin clave admin

7.  Actualizar los datos de la instución en el área de configuración.
    Especialmente un email válido

8.  Salir de la aplicación

9.  Solicitar cambio de la contraseña.

10.  Revisar las instrucciones enviadas al email.

11. La instalación básica de MILFS tiene algunos campos creados y 
    un formulario de muestra llamado contacto.


[+ Información sobre instalación y actualización](https://github.com/humano/milfs/wiki/Instalaci%C3%B3n-y-Actualizaci%C3%B3n)


DISFRUTALO.

<pre>
  #====#        
 |___|__\___    
 | _ |   |_ |}  
 "(_)""  ""(_)"    
</pre>

Twitter: @fredy_rivera
	 @QWERTY.CO
http://qwerty.co/milfs
 
