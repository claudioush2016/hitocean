<h2>World of HIT (WoH) - Backend Challenge</h2>
Para el Testing

1- Clonar el repositorio
2- ejecutar composer i
3- ejecutar composer dump-autoload (para cargar helpers)
4- importar en postman el archivo hit.postman_collection.json
5- importar el archivo sql "hitocean.sql" a nuestra base de datos

<h3>Postman</h3>

Una vez importado el archivo a postman vamos a ver 2 carpetas

1- Admin (Todas las apis que involucran al admin es necesraio mandar email y password del admin, si se esta usando la base de datos del proyecto entonces seria
email = admin@prueba.com
password = 123456)

2- Players

En Admin vamos a ver 3 carpetas mas

1.1- Account (Posee api para crear un nuevo personaje en el juego).
1.2- Item (Posee api para agregar un nuevo item o modificar un item que ya exista dentro del juego)
1.3- Game (Posee api para saber quienes tienen disponible la "ulti" a su favor)

En player vamos a ver 2 apis sueltas

Attack Others: Se pasa por parametro userby userto y action para poder atacar del personaje a al personaje b

Equipament Item: Dado un email de usuario valido y el item_id del item valido, se equipa el item para poder ser utilizado en la pelea.

Aclaracion: Se podría haber echo con JWT para evitar en las apis de admin por ejemplo tener que mandar todo el rato password e email. No se incluyo el jwt ni ningún mecanismo de seguridad (como encryptar la contraseña del admin) dado que el ejercicio no era requerido
