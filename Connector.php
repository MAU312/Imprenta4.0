<?php
$host = "imprenta4-0.mysql.database.azure.com";
$user = "Sebastian";
$password = "Bootysniper1311";
$database = "imprenta";
$sslCertPath = "C:\\xampp\\htdocs\\Imprenta4.0\\certs\\DigiCertGlobalRootCA.crt.pem";

// Inicializa la conexión sin SSL
mysqli_ssl_set($conn, NULL, NULL, $sslCertPath, NULL, NULL); // Ruta al certificado
mysqli_real_connect($conn, $host, $user, $password, $database, 3306, NULL, MYSQLI_CLIENT_SSL);

if (mysqli_connect_errno()) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa a MySQL en Azure";
}
?>
