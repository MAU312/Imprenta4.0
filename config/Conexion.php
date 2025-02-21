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
        // Conexión MySQL
        
        // Aquí hace la conexión a la base de datos, las variables se encuentran en la clase global
        try {
            $options = [
                PDO::MYSQL_ATTR_SSL_CA => SSL_CERT_PATH // Agrega la ruta al certificado SSL
            ];

            $cn = new PDO("mysql:host=".DB_HOST_MYSQL.
            ";dbname=".DB_NAME_MYSQL.
            ";charset=utf8",
            DB_USER_MYSQL,
            DB_PASSWORD_MYSQL,
            $options); // Asegúrate de pasar las opciones
            $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $cn;
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}

