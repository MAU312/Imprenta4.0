<?php

require_once '../models/Usuario.php';

switch ($_GET["op"]) {

    case 'Login':
        session_start();
        $Email_Login = isset($_POST["email"]) ? $_POST["email"] : "";
        $Clave = isset($_POST["password"]) ? $_POST["password"] : "";

        $Usuario = new Usuario();
        $Usuario->setEmail($Email_Login);
        $Usuario->setClave($Clave);

        //var_dump("Hola1");

        $UsuarioData = $Usuario->verificarCredencialesDb();

        //var_dump($UsuarioData);
        if ($UsuarioData !== false && $UsuarioData !== null) {
            $_SESSION['user_id'] = $UsuarioData['idUsuario'];
            $_SESSION['user_nombreUsu'] = $UsuarioData['nombreUsu'];
            $_SESSION['user_nombre'] = $UsuarioData['nombre'];
            $_SESSION['user_apellidos'] = $UsuarioData['apellido'];
            $_SESSION['user_apellidos2'] = $UsuarioData['apellido2'];
            $_SESSION['user_email'] = $UsuarioData['email'];
            $_SESSION['user_Password'] = $UsuarioData['clave'];
            $_SESSION['user_activo'] = $UsuarioData['activo'];
            $_SESSION['user_Rol'] = $UsuarioData['idRol'];

            switch ($UsuarioData['idRol']) {
                case 1:
                    echo 'admin';
                    break;
                case 2:
                    echo 'index';
                    break;
                case 3:
                    echo 'mensajero';
                    break;
                case 4:
                    echo 'index';
                    break;
            }
        } else {
            echo '4';
        }
        break;

    case 'CerrarSesion':
        session_start();
        session_unset();
        session_destroy();
        echo 'success';
        break;
}
