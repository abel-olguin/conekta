<?php
/*mensualidades*/
/**

* Archivo de configuraciones aqui se crean todas las variables del sistemas
* puedes agregar tus propias variables sin embargo no recomiendo 
* modificar las variables que ya estan definidas
**/

/** ruta general del proyecto */
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);

/** ruta de las vistas */
define('views',dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);

define('DB_NAME', 'conekta');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'pruebas');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'pruebas');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Tabla de usuarios **/
define('tblUsers', 'tbl_usuarios');

/** Tabla Conekta **/
define('tblConekta', 'tbl_conekta');

/** Tabla Productos **/
define('tblProductos', 'tbl_articulos');

/** Tabla Cupones **/
define('tblCupones', 'tbl_cupones');

/** precio **/
define('precio', 50);
/** public key **/
define('publicKey', '');
/** private Key **/
define('privateKey', 'key_pxpRbAeDsPJCzK5yrAddsg');

?>