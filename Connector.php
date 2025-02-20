<?php
$host = "imprenta4-0.mysql.database.azure.com";
$user = "Sebastian";
$password = "Bootysniper1311";
$database = "imprenta4-0";

// Inicializa la conexión sin SSL
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $user, $password, $database, 3306, NULL, 0); // Cambia MYSQLI_CLIENT_SSL a 0

if (mysqli_connect_errno()) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa a MySQL en Azure";
}
?>
