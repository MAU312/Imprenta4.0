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
        editar();
        break;

    case 'verificar':
        verificar();
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

function agregar()
{
    try {
        $empleado = new Empleado();

        $empleado->setIdentificacion($_POST["identificacion"]);
        $empleado->setNumeroAsegurado($_POST["numero_asegurado"]);
        $empleado->setNombre($_POST["nombre"]);
        $empleado->setPrimerApellido($_POST["primer_apellido"]);
        $empleado->setSegundoApellido($_POST["segundo_apellido"]);
        $empleado->setFechaNacimiento($_POST["fecha_nacimiento"]);
        $empleado->setEdad($_POST["edad"]);
        $empleado->setTelefono1($_POST["telefono1"]);
        $empleado->setCorreo($_POST["correo"]);
        $empleado->setSexo($_POST["sexo"]);
        $empleado->setEstadoCivil($_POST["estado_civil"]);
        $empleado->setLugarNacimiento($_POST["lugar_nacimiento"]);
        $empleado->setNacionalidad($_POST["nacionalidad"]);
        $empleado->setDireccionDomicilio($_POST["direccion_domicilio"]);
        $empleado->setTelefono2($_POST["telefono2"]);
        $empleado->setNombreContacto1($_POST["nombre_contacto1"]);
        $empleado->setParentescoContacto1($_POST["parentesco_contacto1"]);
        $empleado->setTelefonoContacto1($_POST["telefono_contacto1"]);
        $empleado->setDireccionContacto1($_POST["direccion_contacto1"]);
        $empleado->setNombreContacto2($_POST["nombre_contacto2"]);
        $empleado->setParentescoContacto2($_POST["parentesco_contacto2"]);
        $empleado->setTelefonoContacto2($_POST["telefono_contacto2"]);
        $empleado->setDireccionContacto2($_POST["direccion_contacto2"]);
        $empleado->setTipoSangre($_POST["tipo_sangre"]);
        $empleado->setPadecimientos($_POST["padecimientos"]);
        $empleado->setDiscapacidades($_POST["discapacidades"]);
        $empleado->setIntervenciones($_POST["intervenciones"]);
        $empleado->setUsoAparatos($_POST["uso_aparatos"]);
        $empleado->setMedicamentos($_POST["medicamentos"]);
        $empleado->setDosificacion($_POST["dosificacion"]);
        $empleado->setFrecuencia($_POST["frecuencia"]);
        $empleado->setProposito($_POST["proposito"]);
        $empleado->setFechaIngreso($_POST["fecha_ingreso"]);
        $empleado->setJefeSupervisor($_POST["jefe_supervisor"]);
        $empleado->setPuestoActual($_POST["puesto_actual"]);
        $empleado->setUltimoGradoEstudio($_POST["ultimo_grado_estudio"]);

        $resultado = $empleado->agregar();

        echo json_encode(["success" => $resultado]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}


function editar()
{
    try {
        $empleado = new Empleado();

        $empleado->setIdentificacion($_POST["identificacion"]);
        $empleado->setNumeroAsegurado($_POST["numero_asegurado"]);
        $empleado->setNombre($_POST["nombre"]);
        $empleado->setPrimerApellido($_POST["primer_apellido"]);
        $empleado->setSegundoApellido($_POST["segundo_apellido"]);
        $empleado->setFechaNacimiento($_POST["fecha_nacimiento"]);
        $empleado->setEdad($_POST["edad"]);
        $empleado->setTelefono1($_POST["telefono1"]);
        $empleado->setCorreo($_POST["correo"]);
        $empleado->setSexo($_POST["sexo"]);
        $empleado->setEstadoCivil($_POST["estado_civil"]);
        $empleado->setLugarNacimiento($_POST["lugar_nacimiento"]);
        $empleado->setNacionalidad($_POST["nacionalidad"]);
        $empleado->setDireccionDomicilio($_POST["direccion_domicilio"]);
        $empleado->setTelefono2($_POST["telefono2"]);
        $empleado->setNombreContacto1($_POST["nombre_contacto1"]);
        $empleado->setParentescoContacto1($_POST["parentesco_contacto1"]);
        $empleado->setTelefonoContacto1($_POST["telefono_contacto1"]);
        $empleado->setDireccionContacto1($_POST["direccion_contacto1"]);
        $empleado->setNombreContacto2($_POST["nombre_contacto2"]);
        $empleado->setParentescoContacto2($_POST["parentesco_contacto2"]);
        $empleado->setTelefonoContacto2($_POST["telefono_contacto2"]);
        $empleado->setDireccionContacto2($_POST["direccion_contacto2"]);
        $empleado->setTipoSangre($_POST["tipo_sangre"]);
        $empleado->setPadecimientos($_POST["padecimientos"]);
        $empleado->setDiscapacidades($_POST["discapacidades"]);
        $empleado->setIntervenciones($_POST["intervenciones"]);
        $empleado->setUsoAparatos($_POST["uso_aparatos"]);
        $empleado->setMedicamentos($_POST["medicamentos"]);
        $empleado->setDosificacion($_POST["dosificacion"]);
        $empleado->setFrecuencia($_POST["frecuencia"]);
        $empleado->setProposito($_POST["proposito"]);
        $empleado->setFechaIngreso($_POST["fecha_ingreso"]);
        $empleado->setJefeSupervisor($_POST["jefe_supervisor"]);
        $empleado->setPuestoActual($_POST["puesto_actual"]);
        $empleado->setUltimoGradoEstudio($_POST["ultimo_grado_estudio"]);

        $resultado = $empleado->editar();

        echo json_encode(["success" => $resultado]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}

function verificar()
{
    try {
        $empleado = new Empleado();
        $empleado->setIdentificacion($_POST["identificacion"]);
        $existe = $empleado->verificar();

        echo json_encode([
            "success" => $existe,
            "message" => $existe ? "Empleado encontrado." : "El empleado no existe."
        ]);
    } catch (Exception $e) {
        echo json_encode([
            "success" => false,
            "message" => "Error: " . $e->getMessage()
        ]);
    }
}