# TPE
Participantes:
    Ferrante Tomas Abel:

 tomax19cr7@gmail.com

    Romero Fabi�n Ignacio:

fabian.romero.ignacio@gmail.com


Documentaci�n del api:


Conexi�n con la base de datos:

En la ruta models/album.models.php, ir al m�todo getconection();

Aqu� se puede configurar el nombre de la base de datos, el usuario y la contrase�a. Root ser�a el usuario y en � � ir�a la contrase�a.





Solicitudes tipo get:

Aclaracion las solicitudes de tipo get estan dise�ados para el unico uso de las tablas  �album� y �sugerencia�, si usted tiene un fallo y no salta el error, verifique el nombre de las tablas.

Obtener todos los datos de una tabla, para realizar esta accion simplemente hay que colocar el nombre de la tabla despues del endpoint, en este caso album.






Obtener los datos de un album espesifico, para obtener un album en especifico los llamamos con su id de la siguiente manera.Me trae el album con el id 2.



Filtrado de seccion, agreamos los parametros �linkto� y �equalto�, en el primero vamos a colocar la columna de la tabla, en el segundo parametro colocamos el valor exacto de lo que queremos filtrar.
En este ejemplo filtre todos los album con la el id_categoria 3.







Ordenar datos, agregando los par�metros OrderBy y OrderModel, en OrderBy indicamos la columna a ordenar y en OrderModel establecemos el tipo de orden con las palabras reservadas ASC(Ascendente) DESC(Descendente).
En el siguiente ejemplo ordeno de la �a� a la �z� el nombre de los �lbumes.






Paginado, agregando los par�metros startAt (indicar la posici�n inicial desde donde se empiezan a limitar, la primera posici�n es el 0) y endAt (indica la cantidad de datos que se desean paginar).
El siguiente ejemplo indica que me van a mostrar solo los primeros 3 �lbumes.



Tambi�n nuestra api fue dise�ada para que se puedan ordenar y paginar a la vez, como lo muestro en el siguiente ejemplo.




Solicitudes de tipo POST:


Insertar �lbum sugerido, esta opci�n permite que los usuarios puedan dejar de forma sugerida �lbumes, pueden agregar (nombre del �lbum, g�nero y artista). 








Para hacer un post todos los datos deben estar cargados de lo contrario dar� un recurso de tipo 404.

                 

Solicitudes de tipo PUT:


Editar datos del �lbum sugeridos por el usuario, para editar los datos sugeridos por el usuario.





Si ingresa datos vac�os, devolver� un recurso de tipo 404.
