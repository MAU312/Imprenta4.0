<?php

require_once '../models/Usuario.php';

switch ($_GET["op"]) {

    case 'insertar':
       
        $nombreUsu = isset($_POST["nombreUsu"]) ? trim($_POST["nombreUsu"]) : "";
        $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
        $apellido = isset($_POST["apellido"]) ? trim($_POST["apellido"]) : "";
        $apellido2 = isset($_POST["apellido2"]) ? trim($_POST["apellido2"]) : ""; // Segundo apellido
        $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
        $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
        $rol = isset($_POST["idRol"]) ? trim($_POST["idRol"]) : 2;
        $activo = isset($_POST["activo"]) ? trim($_POST["activo"]) : 1; // Estado activo
    
        // Crear una instancia de Usuario
        $usuario = new Usuario();
    
        // Asignar valores a la instancia
        $usuario->setNombreUsu($nombreUsu);
        $usuario->setNombre($nombre);
        $usuario->setApellido($apellido);
        $usuario->setApellido2($apellido2);
        $usuario->setEmail($email);
        $usuario->setClave(password_hash($password, PASSWORD_BCRYPT)); // Hash de la clave
        $usuario->setRol($rol);
        $usuario->setActivo($activo);
    
        // Verificar existencia del email en la BD
        $encontrado = $usuario->verificarExistenciaDb();
    
        if (!$encontrado) {
            // Si el usuario no existe, guardarlo
            $resultado = $usuario->guardarEnDb();
    
            if ($resultado === true) {
                echo json_encode(["status" => "success", "message" => "Usuario agregado exitosamente."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al guardar el usuario: " . $resultado]);
            }
        } else {
            // Si el usuario ya existe
            echo json_encode(["status" => "error", "message" => "El usuario ya existe en la base de datos."]);
        }
        break;
    

    default:
        // Si se proporciona una operación no válida, retornamos un mensaje de error
        echo json_encode(["status" => "error", "message" => "Operación no válida"]);
}
?>
