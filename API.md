API de MILFS

El api consulta a nivel local todos los datos si se ha logueado en el
sistema a nivel remoto o sin logueo los datos de los formularios que
se han marcado como de contenido publico.

http://localhost/milfs/api.php
Consulta cuales formularios hay en la instancia.

http://localhost/milfs/api.php?id=3
Consulta todo el contenido que se ha introducido en un formulario
pasándole el id como parametro.

http://localhost/milfs/api.php?identificador=04718326a4922f93d9f7b5f6f682d111


Para que se muestren las imagenes por medio de la api.php en las versiones antes del 20150218 
se debe hacer la siguiente entrada en el mysql

INSERT INTO `form_campos` (`id`, `id_especialista`, `id_empresa`, `campo_nombre`, `campo_descripcion`, `campo_tipo`, `campo_area`, `orden`, `activo`, `identificador`, `bloqueo`, `tipo_contenido`) VALUES
(0, 0, 1, 'imagen', 'Campo especial para la imagen', 15, 0, 0, 1, 'imagen', 0, '');


Consulta todos los datos que se han llenado en cada formulario pasando
el identificador como parametro, cabe anotar que cuando se edita un
formulario se guarda la versión anterior de este campo por lo que si
se quiere conocer el estado actual de un formulario que ha sido
editado, debería filtrarse por timestamp para conocer su ultima
versión o vesiones anteriores.


http://qwerty.co/demo/api.php?dato=126
Consulta la info sobre un dato en concreto pasando  el id del dato
como parametro.
