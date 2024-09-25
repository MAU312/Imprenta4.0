<?php

require_once '../config/Conexion.php';

final class Usuario extends Conexion
{

    //ATRIBUTOS DE USUARIOS
    protected static $cnx;
    private $idUsuario = null;
    private $nombreUsuario = null;
    private $email = null;
    private $clave = null;
    private $Rol = null;
    
   
    //Constructor
    public function __construct()
    {
    }

    //Encapsuladores
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
}
public function getnombreUsuario()
{
    return $this->nombreUsuario;
}
public function setnombreUsuario($nombreUsuario)
{
    $this->nombreUsuario = $nombreUsuario;
}
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getnombreUsuario()
    {
        return $this->nombreUsuario;
    }
    public function setnombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;
    }
    
    public function getClave()
    {
        return $this->clave;
    }
    public function setClave($clave)
    {
        $this->clave = $clave;
    }
    public function getRol()
    {
        return $this->Rol;
    }
    public function setRol($Rol)
    {
        $this->Rol = $Rol;
    }

    //Funciones de Conexion y Desconexion de Base de Datos esoooooooooo
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }

    //Ver si es un usuario que ya esta registrado en la base de datos

    public function verificarExistenciaDb()
    {
        $query = "SELECT * FROM usuarios WHERE email=:email";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $email = $this->getEmail();
            $resultado->bindParam(":email", $email, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();

            $encontrado = false;
            foreach ($resultado->fetchAll() as $reg) {
                $encontrado = true;
            }
            return $encontrado;
            var_dump($encontrado);
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function verificarCredencialesDb()
    {
        $query = "SELECT * FROM usuarios WHERE email=:email LIMIT 1";
        self::getConexion();
        try {
            $resultado = self::$cnx->prepare($query);
            $email = $this->getEmail();
            $Clave = $this->getClave();
            $resultado->bindParam(":email", $email, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();

            $usuario = $resultado->fetch(PDO::FETCH_ASSOC); // Almacena el resultado en una variable temporal
            return $usuario; // Retorna el resultado
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function actualizarRolUsuario($id, $rol)
    {
        $query = "UPDATE usuarios SET idRol=:rol WHERE idUsuario=:id";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":rol", $rol, PDO::PARAM_INT);
            $resultado->bindParam(":id", $id, PDO::PARAM_INT);
            $resultado->execute();
            self::desconectar();
            return true;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function guardarEnDb()
    {
        $query = "INSERT INTO usuarios (nombre, apellido, email, telefono, clave, idRol, sexo) 
    VALUES (:nombre, :apellido, :email, :telefono, :clave, :idRol, :sexo)";
        try {
            self::getConexion();
            $nombre = strtoupper($this->getNombre());
            $apellido = strtoupper($this->getApellido());
            $email = $this->getEmail();
            $telefono = $this->getTelefono();
            $clave = $this->getClave();
            $idRol = $this->getRol();
            $sexo = $this->getSexo();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":apellido", $apellido, PDO::PARAM_STR);
            $resultado->bindParam(":email", $email, PDO::PARAM_STR);
            $resultado->bindParam(":telefono", $telefono, PDO::PARAM_STR);
            $resultado->bindParam(":clave", $clave, PDO::PARAM_STR);
            $resultado->bindParam(":idRol", $idRol, PDO::PARAM_INT);
            $resultado->bindParam(":sexo", $sexo, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            return true;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }

    public function listarTodosUsuarios()
    {
        $query = "SELECT * FROM usuarios";
        $arr = array();
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            self::desconectar();
            foreach ($resultado->fetchAll() as $encontrado) {
                $user = new Usuario();
                $user->setIdUsuario($encontrado['idUsuario']);
                $user->setNombre($encontrado['nombre']);
                $user->setApellido($encontrado['apellido']);
                $user->setEmail($encontrado['email']);
                $user->setTelefono($encontrado['telefono']);
                $user->setClave($encontrado['clave']);
                $user->setRol($encontrado['idRol']);
                $user->setSexo($encontrado['sexo']);
                $arr[] = $user;
            }
            return $arr;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();;
            return json_encode($error);
        }
    }


    //Ver si el email que ingresa el usuario es correcto
    public function verificarExistenciaEmail()
    {
        $query = "SELECT idUsuario,nombre,apellidos,email,telefono FROM usuarios where email=:email";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $email = $this->getEmail();
            $resultado->bindParam(":email", $email, PDO::PARAM_STR);
            $resultado->execute();
            self::desconectar();
            $encontrado = true;
            $arr = array();
            foreach ($resultado->fetchAll() as $reg) {
                $arr[] = $reg['idUsuario'];
                $arr[] = $reg['nombre'];
                $arr[] = $reg['apellidos'];
                $arr[] = $reg['email'];
                $arr[] = $reg['telefono'];
            }
            return $arr;
            return $encontrado;
        } catch (PDOException $Exception) {
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }

    public function EliminarUsuario()
    {
        $query = "DELETE FROM usuarios WHERE idUsuario=:id";
        try {
            self::getConexion();
            $id = $this->getIdUsuario();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":id", $id, PDO::PARAM_INT);

            self::$cnx->beginTransaction(); // Desactiva el autocommit
            $resultado->execute();
            self::$cnx->commit(); // Realiza el commit y vuelve al modo autocommit
            self::desconectar();

            return $resultado->rowCount();
        } catch (PDOException $Exception) {
            self::$cnx->rollBack();
            self::desconectar();
            $error = "Error " . $Exception->getCode() . ": " . $Exception->getMessage();
            return $error;
        }
    }
}
