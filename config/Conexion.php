<?php
// La forma de hacer llamados a la clase
require_once "global.php";

class Conexion
{
    public static function conectar()
    {
        try {
            // Opciones de conexión
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::MYSQL_ATTR_SSL_CA => SSL_CERT_PATH, // Ruta al certificado SSL
            ];

            $cn = new PDO("mysql:host=".DB_HOST_MYSQL.";dbname=".DB_NAME_MYSQL, DB_USER_MYSQL, DB_PASSWORD_MYSQL, $options);
            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $cn;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
?>

