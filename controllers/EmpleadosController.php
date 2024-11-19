<?php
require_once '../models/Empleado.php'; 

// Verificar si se ha enviado la operación deseada
switch ($_GET["op"]) {
    case 'listar':
        listar();
        break;

    case 'agregar':
        agregar();
        break;

    case 'editar':
        //editar();
        break;

    case 'eliminar':
        //eliminar();
        break;
}

function listar()
{
    try {
        // Crear una instancia del modelo
        $empleado = new Empleado();

        // Obtener los datos de los empleados
        $datos = $empleado->listar();

        // Verificar si hay datos
        if (!empty($datos)) {
            // Transformar los datos a un array de forma separada
            $data = transformarDatos($datos);

            // Preparar los resultados para la respuesta JSON
            $resultados = array(
                "success" => true,
                "data" => $data
            );
        } else {
            // Enviar mensaje de error si no hay datos
            $resultados = array(
                "success" => false,
                "message" => "No hay empleados disponibles."
            );
        }

        // Enviar la respuesta JSON
        echo json_encode($resultados);
    } catch (Exception $e) {
        // Enviar mensaje de error si ocurrió una excepción
        echo json_encode([
            "success" => false,
            "message" => "Error: " . $e->getMessage()
        ]);
    }
}

/**
 * Función separada para transformar los datos de objetos a arrays
 */
function transformarDatos($datos)
{
    $data = array();
    foreach ($datos as $fila) {
        $data[] = array(
            "identificacion" => $fila->getIdentificacion(),
            "numero_asegurado" => $fila->getNumeroAsegurado(),
            "nombre" => $fila->getNombre(),
            "primer_apellido" => $fila->getPrimerApellido(),
            "segundo_apellido" => $fila->getSegundoApellido(),
            "fecha_nacimiento" => $fila->getFechaNacimiento(),
            "edad" => $fila->getEdad(),
            "telefono1" => $fila->getTelefono1(),
            "correo" => $fila->getCorreo(),
            "sexo" => $fila->getSexo(),
            "estado_civil" => $fila->getEstadoCivil(),
            "lugar_nacimiento" => $fila->getLugarNacimiento(),
            "nacionalidad" => $fila->getNacionalidad(),
            "direccion_domicilio" => $fila->getDireccionDomicilio(),
            "telefono2" => $fila->getTelefono2(),
            "nombre_contacto1" => $fila->getNombreContacto1(),
            "parentesco_contacto1" => $fila->getParentescoContacto1(),
            "telefono_contacto1" => $fila->getTelefonoContacto1(),
            "direccion_contacto1" => $fila->getDireccionContacto1(),
            "nombre_contacto2" => $fila->getNombreContacto2(),
            "parentesco_contacto2" => $fila->getParentescoContacto2(),
            "telefono_contacto2" => $fila->getTelefonoContacto2(),
            "direccion_contacto2" => $fila->getDireccionContacto2(),
            "tipo_sangre" => $fila->getTipoSangre(),
            "padecimientos" => $fila->getPadecimientos(),
            "discapacidades" => $fila->getDiscapacidades(),
            "intervenciones" => $fila->getIntervenciones(),
            "uso_aparatos" => $fila->getUsoAparatos(),
            "medicamentos" => $fila->getMedicamentos(),
            "dosificacion" => $fila->getDosificacion(),
            "frecuencia" => $fila->getFrecuencia(),
            "proposito" => $fila->getProposito(),
            "fecha_ingreso" => $fila->getFechaIngreso(),
            "jefe_supervisor" => $fila->getJefeSupervisor(),
            "puesto_actual" => $fila->getPuestoActual(),
            "ultimo_grado_estudio" => $fila->getUltimoGradoEstudio()
        );
    }
    return $data;
}

/*
function agregar()
{
    $identificacion = isset($_POST["identificacion"]) ? trim($_POST["identificacion"]) : "";
    $numAsegurado = isset($_POST["numAsegurado"]) ? trim($_POST["numAsegurado"]) : "";
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    // Agregar el resto de los campos aquí...

    if (empty($identificacion) || empty($nombre) || empty($numAsegurado)) {
        echo "Favor ingresar todos los datos";
        return;
    }

    $empleado = new Empleado();
    $empleado->setIdentificacion($identificacion);
    $empleado->setNumAsegurado($numAsegurado);
    $empleado->setNombre($nombre);
    // Agregar el resto de los setters...

    try {
        $resultado = $empleado->agregar();

        if ($resultado) {
            echo "1"; // Operación exitosa
        } else {
            echo "No fue posible la operación";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function editar()
{
    $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    // Agregar los campos a editar aquí...

    if (empty($id) || empty($nombre)) {
        echo "Favor ingresar todos los datos";
        return;
    }

    $empleado = new Empleado();
    $empleado->setId($id);
    $empleado->setNombre($nombre);
    // Agregar el resto de los setters...

    try {
        $resultado = $empleado->editar($id);

        if ($resultado) {
            echo "1"; // Operación exitosa
        } else {
            echo "No fue posible la operación";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function eliminar()
{
    $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";

    if (empty($id)) {
        echo "Favor ingresar todos los datos";
        return;
    }

    $empleado = new Empleado();
    $empleado->setId($id);

    try {
        $resultado = $empleado->eliminar($id);

        if ($resultado) {
            echo "1"; // Operación exitosa
        } else {
            echo "No fue posible la operación";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
*/