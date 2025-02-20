<?php
$host = "imprenta4-0.mysql.database.azure.com";
$user = "Sebastian@imprenta4-0.mysql.database.azure.com";
$password = "Bootysniper1311";
$database = "imprenta4-0";

$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, "/home/site/wwwroot/db/DigiCertGlobalRootCA.crt.pem", NULL, NULL);
mysqli_real_connect($conn, $host, $user, $password, $database, 3306, NULL, MYSQLI_CLIENT_SSL);

if (mysqli_connect_errno()) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa a MySQL en Azure";
}
?>
