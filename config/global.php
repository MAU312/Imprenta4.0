<?php
define('DB_NAME_MYSQL', 'imprenta'); // Nombre de tu BD en Azure
define('DB_HOST_MYSQL', 'imprenta4-0.mysql.database.azure.com'); // Servidor de Azure
define('DB_USER_MYSQL', 'Sebastian'); // Usuario de Azure
define('DB_PASSWORD_MYSQL', 'Bootysniper1311'); // Tu contraseña
define('DB_CERT_PATH', '/certs/DigiCertGlobalRootCA.crt'); // Ruta del certificado SSL


$db = mysqli_init();
mysqli_ssl_set($db, NULL, NULL, DB_CERT_PATH, NULL, NULL);

if (!mysqli_real_connect($db, DB_HOST_MYSQL, DB_USER_MYSQL, DB_PASSWORD_MYSQL, DB_NAME_MYSQL, 3306, NULL, MYSQLI_CLIENT_SSL)) {
    die("Connection failed: " . mysqli_connect_error());
}

// Verificar la conexión
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error); // Mensaje de error detallado
}