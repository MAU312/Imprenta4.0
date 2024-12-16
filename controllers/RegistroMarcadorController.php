<?php
require_once '../models/TablaRegisMarcador.php';

class RegistroMarcadorController
{

// Verificar si se ha enviado la operación deseada
switch ($_GET["op"]) {
    case 'listar':
        listar(); // Llama al método que lista los usuarios
        break;

    case 'agregar':
        agregar(); // Llama al método que agrega un nuevo usuario
        break;

    case 'actualizar':
        actualizar(); // Llama al método que obtiene los detalles de un usuario específico
        break;

    case 'eliminar':
        eliminar(); // Llama al método que elimina un usuario
        break;

    case 'obtenerPorId':
        obtenerPorId(); // Llama al método que actualiza el rol de un usuario
        break;

    default:
        echo "Operación no válida"; // Mensaje para operaciones no reconocidas
        break;
}

    
    // Método para listar todos los registros
public function listar()
{
    try {
        // Crear una instancia de la tabla
        $tabla = new TablaRegisMarcador();

        // Obtener los datos de los registros
        $registros = $tabla->listar();

        // Verificar si hay registros
        if (!empty($registros)) {
            // Transformar los datos a un array de forma separada
            $data = $this->transformarDatos($registros);

            // Preparar los resultados para la respuesta JSON
            $resultados = array(
                "success" => true,
                "data" => $data
            );
        } else {
            // Enviar mensaje de error si no hay registros
            $resultados = array(
                "success" => false,
                "message" => "No hay registros disponibles."
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
/**
 * Función separada para transformar los datos de objetos a arrays
 */
private function transformarDatos($registros)
{
    $data = array();
    foreach ($registros as $registro) {
        $data[] = array(
            "idMarcador" => $registro->getId(),
            "colaborador" => $registro->getColaborador(),
            "viernes_entrada" => $registro->getViernesEntrada(),
            "viernes_salida" => $registro->getViernesSalida(),
            "lunes_entrada" => $registro->getLunesEntrada(),
            "lunes_salida" => $registro->getLunesSalida(),
            "martes_entrada" => $registro->getMartesEntrada(),
            "martes_salida" => $registro->getMartesSalida(),
            "miercoles_entrada" => $registro->getMiercolesEntrada(),
            "miercoles_salida" => $registro->getMiercolesSalida(),
            "jueves_entrada" => $registro->getJuevesEntrada(),
            "jueves_salida" => $registro->getJuevesSalida(),
            "sabado_entrada" => $registro->getSabadoEntrada(),
            "sabado_salida" => $registro->getSabadoSalida(),
            "debe_horas" => $registro->getDebeHoras()
        );
    }
    return $data;
}



    // Método para agregar un nuevo registro
    public function agregarRegistro($datos)
    {
        try {
            $tabla = new TablaRegisMarcador();
            $tabla->setColaborador($datos['colaborador']);
            $tabla->setViernesEntrada($datos['viernes_entrada']);
            $tabla->setViernesSalida($datos['viernes_salida']);
            $tabla->setLunesEntrada($datos['lunes_entrada']);
            $tabla->setLunesSalida($datos['lunes_salida']);
            $tabla->setMartesEntrada($datos['martes_entrada']);
            $tabla->setMartesSalida($datos['martes_salida']);
            $tabla->setMiercolesEntrada($datos['miercoles_entrada']);
            $tabla->setMiercolesSalida($datos['miercoles_salida']);
            $tabla->setJuevesEntrada($datos['jueves_entrada']);
            $tabla->setJuevesSalida($datos['jueves_salida']);
            $tabla->setSabadoEntrada($datos['sabado_entrada']);
            $tabla->setSabadoSalida($datos['sabado_salida']);
            $tabla->setDebeHoras($datos['debe_horas']);

            if ($tabla->agregar()) {
                return "Registro agregado correctamente.";
            } else {
                return "Error al agregar el registro.";
            }
        } catch (Exception $e) {
            echo "Error al agregar registro: " . $e->getMessage();
            return false;
        }
    }

    // Método para actualizar un registro existente
    public function actualizarRegistro($id, $datos)
    {
        try {
            $tabla = new TablaRegisMarcador();
            $tabla->setId($idMarcador);
            $tabla->setColaborador($datos['colaborador']);
            $tabla->setViernesEntrada($datos['viernes_entrada']);
            $tabla->setViernesSalida($datos['viernes_salida']);
            $tabla->setLunesEntrada($datos['lunes_entrada']);
            $tabla->setLunesSalida($datos['lunes_salida']);
            $tabla->setMartesEntrada($datos['martes_entrada']);
            $tabla->setMartesSalida($datos['martes_salida']);
            $tabla->setMiercolesEntrada($datos['miercoles_entrada']);
            $tabla->setMiercolesSalida($datos['miercoles_salida']);
            $tabla->setJuevesEntrada($datos['jueves_entrada']);
            $tabla->setJuevesSalida($datos['jueves_salida']);
            $tabla->setSabadoEntrada($datos['sabado_entrada']);
            $tabla->setSabadoSalida($datos['sabado_salida']);
            $tabla->setDebeHoras($datos['debe_horas']);

            if ($tabla->actualizar()) {
                return "Registro actualizado correctamente.";
            } else {
                return "Error al actualizar el registro.";
            }
        } catch (Exception $e) {
            echo "Error al actualizar registro: " . $e->getMessage();
            return false;
        }
    }

    // Método para eliminar un registro
    public function eliminarRegistro($idMarcador)
    {
        try {
            $tabla = new TablaRegisMarcador();
            $tabla->setId($idMarcador);

            if ($tabla->eliminar()) {
                return "Registro eliminado correctamente.";
            } else {
                return "Error al eliminar el registro.";
            }
        } catch (Exception $e) {
            echo "Error al eliminar registro: " . $e->getMessage();
            return false;
        }
    }

    // Método para obtener un registro por su ID
    public function obtenerRegistroPorId($idMarcador)
    {
        try {
            $tabla = new TablaRegisMarcador();
            $registro = $tabla->obtenerPorId($idMarcador);

            if ($registro) {
                return $registro;
            } else {
                return "No se encontró el registro.";
            }
        } catch (Exception $e) {
            echo "Error al obtener registro: " . $e->getMessage();
            return false;
        }
    }
}
