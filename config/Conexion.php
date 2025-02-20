<?php
// La forma de hacer llamados a la clase
require_once "global.php";

class Conexion
{
    function __construct()
    {
        # code...
    }
    
    public static function conectar(){
        // conexión mysql
        try {
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::MYSQL_ATTR_SSL_CA => '/home/site/wwwroot/db/DigiCertGlobalRootCA.crt.pem', // Ruta al certificado SSL
            ];
            
            $cn = new PDO("mysql:host=".DB_HOST_MYSQL.";dbname=".DB_NAME_MYSQL, DB_USER_MYSQL, DB_PASSWORD_MYSQL, $options);
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
