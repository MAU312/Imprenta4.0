<?php
// CONSTANTES
define('DB_NAME_MYSQL', 'imprenta');
define('DB_HOST_MYSQL', 'imprenta4-0.mysql.database.azure.com'); // Cambia esto
define('DB_USER_MYSQL', 'Sebastian'); // Cambia esto
define('DB_PASSWORD_MYSQL', 'Bootysniper1311'); // Cambia esto
define('SSL_CERT_PATH', __DIR__ . '/certs/DigiCertGlobalRootCA.crt.pem');

$db = new mysqli(DB_HOST_MYSQL, DB_USER_MYSQL, DB_PASSWORD_MYSQL, DB_NAME_MYSQL);

// Verifica conexión
if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}

?>
