<?php
// CONSTANTES
define('DB_NAME_MYSQL', 'imprenta');
define('DB_HOST_MYSQL', 'imprenta4-0.mysql.database.azure.com'); // Cambiado de localhost a Azure
define('DB_USER_MYSQL', 'Sebastian@imprenta4-0.mysql.database.azure.com'); // Asegúrate de usar el usuario completo
define('DB_PASSWORD_MYSQL', 'Bootysniper1311'); // Cambia la contraseña si es necesario
define('SSL_CERT_PATH', __DIR__ . '/certs/DigiCertGlobalRootCA.crt.pem');

$db = new mysqli(DB_HOST_MYSQL, DB_USER_MYSQL, DB_PASSWORD_MYSQL, DB_NAME_MYSQL, 3306, NULL, MYSQLI_CLIENT_SSL);

// Verificar la conexión
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error); // Mensaje de error detallado
}
?>
