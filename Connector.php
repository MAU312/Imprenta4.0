<?php
$host = "imprenta4-0.mysql.database.azure.com";
$user = "Sebastian";
$password = "Bootysniper1311";
$database = "imprenta";

// Define la ruta al certificado SSL
define('SSL_CERT_PATH', __DIR__ . '/certs/DigiCertGlobalRootCA.crt.pem');

// Inicializa la conexión con SSL
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, SSL_CERT_PATH, NULL, NULL);
mysqli_real_connect($conn, $host, $user, $password, $database, 3306, NULL, MYSQLI_CLIENT_SSL);

if (mysqli_connect_errno()) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa a MySQL en Azure";
}
?>
