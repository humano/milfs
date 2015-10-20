# API de MILFS

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


http://datos.labmde.org/api.php?dato=52772
Consulta la info sobre un dato en concreto pasando  el id del dato
como parametro.

Para entender el manejo de la api se debe tener en cuenta lo siguiente:

Cuando se crea un formulario MILF le asigna un ID unico a cada formulario que aparece en el JSON como: "form_id": pero esto solo es util si se quiere hacer referencia al fomulario especifico llamando la API sin ningun parametro, asi:

http://datos.labmde.org/api.php

Si se quiere leer los datos en un formulario especifico la api se llama de la siguiente forma:

http://datos.labmde.org/api.php?id=19

De esta forma la API nos entrega todos los datos, para hacer ejercicios de visualizacion de datos lo recomendable es utilizar los ID de los campos, especificado en el JSON asi: "id_campo"
Cada campo asociado a un formulario se le asigna un ID unico.

# Manejo de Imagenes

Milf permite almacenar imagenes para los formularios, las imagenes quedan almacenadas en el sistema de archivos del servidor, y genera de forma automatica 3 tamaños (150px 300px y 600px) y tambien almacena la imagen en el tamaño original.

Lo siguiente es un ejemplo de como la **API** entrega un dato tipo **IMAGEN**:
~~~

 {
        "0": 53326,
        "id_dato": 53326,
        "1": 21,
        "id_formulario": 21,
        "2": "Viaje a pie",
        "formulario": "Viaje a pie",
        "3": "imagen",
        "campo_nombre": "imagen",
        "4": 0,
        "id_campo": 0,
        "5": "7b2deb5cb4580984c8acd71c09e0f1f1.jpg",
        "contenido": "7b2deb5cb4580984c8acd71c09e0f1f1.jpg",
        "6": 1432608321,
        "timestamp": 1432608321,
        "7": "4b0d9a636567465bed3ada5a2e6f2fa6",
        "identificador": "4b0d9a636567465bed3ada5a2e6f2fa6",
        "8": 0,
        "orden": 0
    },

~~~

Ahora para usar la imagen se debe completar la URL, como se ve en los siguientes ejemplos:

**Para usar la imagen de 600px**

http://datos.labmde.org/milfs/images/secure/?file=600/7b2deb5cb4580984c8acd71c09e0f1f1.jpg

**Para usar la imagen de 300px**

http://datos.labmde.org/milfs/images/secure/?file=300/7b2deb5cb4580984c8acd71c09e0f1f1.jpg

**Para usar la imagen de 150px**

http://datos.labmde.org/milfs/images/secure/?file=150/7b2deb5cb4580984c8acd71c09e0f1f1.jpg

**Para usar la imagen FULL o Original**

http://datos.labmde.org/milfs/images/secure/?file=full/7b2deb5cb4580984c8acd71c09e0f1f1.jpg

**Nota:** Es importante que observe que el JSON entrega el dato de la siguiente forma: 
~~~
"5": "7b2deb5cb4580984c8acd71c09e0f1f1.jpg",
~~~

Cada imagen queda codificada de la siguiente forma: 7b2deb5cb4580984c8acd71c09e0f1f1.jpg que sera el nombre de la imagen asignada por el sistema.

