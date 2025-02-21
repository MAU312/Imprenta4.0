<?php
// La forma de hacer llamados a la clase
require_once "global.php";

class Conexion
{
    public static function conectar(){
        // conexion mysql
        try {
            $options = array(
                PDO::MYSQL_ATTR_SSL_CA => SSL_CERT_PATH, // Ruta del certificado
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false // Cambia a true si deseas verificar el servidor
            );
            
            $cn = new PDO("mysql:host=".DB_HOST_MYSQL.
            ";dbname=".DB_NAME_MYSQL.
            ";charset=utf8",
            DB_USER_MYSQL,
            DB_PASSWORD_MYSQL,
            $options); // Agrega las opciones SSL aquí

            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $cn;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}

// Línea de código que ayuda a saber si está correctamente conectada la BD
/*
$conexion = Conexion::conectar();

if ($conexion) {
    var_dump($conexion);
    echo "Conexión exitosa a la base de datos";
} else {
    echo "Error al conectar a la base de datos";
}
*/


