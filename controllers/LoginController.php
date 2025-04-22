<?php

require_once '../models/Usuario.php';

switch ($_GET["op"]) {
    case 'Login':
        session_start();
        $Email_Login = isset($_POST["email"]) ? trim($_POST["email"]) : "";
        $Clave = isset($_POST["password"]) ? trim($_POST["password"]) : "";

        if (empty($Email_Login) || empty($Clave)) {
            echo json_encode(["error" => "Por favor, ingresa tu correo y contraseña."]);
            exit();
        }

        $Usuario = new Usuario();
        $Usuario->setEmail($Email_Login);
        $Usuario->setClave($Clave);

        $UsuarioData = $Usuario->verificarCredencialesDb();

        if (!is_array($UsuarioData) || empty($UsuarioData)) {
            echo json_encode(["error" => "Correo o contraseña incorrectos."]);
            exit();
        }

        // Iniciar sesión y guardar datos
        $_SESSION['user_id'] = $UsuarioData['idUsuario'];
        $_SESSION['user_nombreUsu'] = $UsuarioData['nombreUsu'];
        $_SESSION['user_nombre'] = $UsuarioData['nombre'];
        $_SESSION['user_apellidos'] = $UsuarioData['apellido'];
        $_SESSION['user_apellidos2'] = $UsuarioData['apellido2'];
        $_SESSION['user_email'] = $UsuarioData['email'];
        $_SESSION['user_Password'] = $UsuarioData['clave'];
        $_SESSION['user_activo'] = $UsuarioData['activo'];
        $_SESSION['user_Rol'] = $UsuarioData['idRol'];

        // Respuesta en formato JSON según el rol
        switch ($UsuarioData['idRol']) {
            case 1:
                echo json_encode(["success" => "admin"]);
                break;
            case 2:
                echo json_encode(["success" => "index"]);
                break;
            case 3:
                echo json_encode(["success" => "mensajero"]);
                break;
            case 4:
                echo json_encode(["success" => "index"]);
                break;
            default:
                echo json_encode(["error" => "Rol no reconocido."]);
        }
        exit();

    case 'CerrarSesion':
        session_start();
        session_unset(); // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión
        echo json_encode(["success" => "Sesión cerrada correctamente."]);
        exit();
}

