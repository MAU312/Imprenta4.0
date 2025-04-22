<?php
//CONSTANTES
define('DB_NAME_MYSQL', 'imprenta');
define('DB_HOST_MYSQL', 'localhost');
define('DB_USER_MYSQL', 'root');
define('DB_PASSWORD_MYSQL', 'borona12');
//Change the password and the user if you needed

$db = new mysqli(DB_HOST_MYSQL, DB_USER_MYSQL, DB_PASSWORD_MYSQL, DB_NAME_MYSQL);

// Verificar la conexión
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error); // Mensaje de error detallado
}