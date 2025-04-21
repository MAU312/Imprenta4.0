<?php
// CONSTANTES
define('DB_NAME_MYSQL', 'imprenta');
define('DB_HOST_MYSQL', 'imprenta4-0.mysql.database.azure.com'); 
define('DB_USER_MYSQL', 'Sebastian'); 
define('DB_PASSWORD_MYSQL', 'Bootysniper1311');
define('SSL_CERT_PATH', __DIR__ . '/certs/DigiCertGlobalRootCA.crt.pem');

$db = new mysqli(DB_HOST_MYSQL, DB_USER_MYSQL, DB_PASSWORD_MYSQL, DB_NAME_MYSQL, 3306, SSL_CERT_PATH);

// Verificar la conexión
if ($db->connect_error) {
    // Devolver un mensaje de error en formato JSON si hay un problema con la conexión
    echo json_encode(["error" => "Conexión fallida: " . $db->connect_error]);
    exit(); // Detener la ejecución
}
?>
