<?php
require_once '../models/salidaMaterial.php'; // Asegúrate de que este archivo esté en la ubicación correcta

// Verificar si se ha enviado la operación deseada
if (isset($_GET["op"])) {
    switch ($_GET["op"]) {
        case 'listarDetalles':
            listarDetalles();
            break;
        case 'agregarSalida':
            insertarSalida();
            break;
        case 'editarSalida':
            editarSalida();
            break;
        case 'eliminarSalida':
            eliminarSalida();
            break;
    }
}

function listarDetalles()
{
    if (isset($_GET['idMaterial'])) {
        $idMaterial = $_GET['idMaterial'];

        // Crear una instancia del modelo TablaProductos
        $detalleSalida = new salidaMaterial();

        // Llamar al método del modelo que obtiene los detalles por idMaterial
        $resultado = $detalleSalida->obtenerDetallesPorMaterial($idMaterial);

        if ($resultado) {
            // Eliminar el campo 'idMaterial' de cada detalle
            foreach ($resultado as &$detalle) {
                unset($detalle['idMaterial']);
            }
            unset($detalle); // Liberar la referencia
            // Si se encontraron detalles, devolverlos como JSON
            echo json_encode([
                "success" => true,
                "data" => $resultado
            ]);
        } else {
            // Si no se encontraron detalles, devolver un mensaje
            echo json_encode([
                "success" => false,
                "message" => "No se encontraron detalles para el material solicitado."
            ]);
        }
    } else {
        // Manejar el caso donde no se envió el idMaterial
        echo json_encode(['success' => false, 'message' => 'ID de material no proporcionado.']);
    }
}

function insertarSalida()
{
    // Verificar si se ha proporcionado el idMaterial en la URL
    if (isset($_GET['idMaterial'])) {
        $idMaterial = $_GET['idMaterial'];

        // Recibir y sanitizar los valores enviados desde el formulario
        $cliente = $_POST['cliente'];
        $corte = $_POST['corte'];
        $produccion = $_POST['produccion'];
        $cantidadPliegos = $_POST['cantidadPliegos'];
        $precioPliego = $_POST['precioPliego'];
        $tipoCambio = $_POST['tipoCambio'] ?? 1.00;

        // Crear una instancia del modelo
        $detalleSalida = new salidaMaterial();

        // Llamar al método que inserta la nueva salida en la tabla, utilizando un stored procedure
        $resultado = $detalleSalida->insertarSalida(
            $idMaterial,
            $cliente,
            $corte,
            $produccion,
            $cantidadPliegos,
            $precioPliego,
            $tipoCambio
        );

        // Verificar si la inserción fue exitosa
        if ($resultado) {
            echo '1'; // Éxito
        } else {
            echo '3'; // Error al intentar insertar
        }
    } else {
        echo 'ID de material no proporcionado.'; // Error si no se proporciona el idMaterial
    }
}

function editarSalida() {
    // Leer los datos JSON del cuerpo de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si los datos fueron recibidos correctamente
    if (!$data) {
        echo json_encode([
            "success" => false,
            "message" => "Datos inválidos o no recibidos."
        ]);
        return;
    }

    // Obtener los datos del JSON
    $idMaterial = isset($data["idMaterial"]) ? intval($data["idMaterial"]) : 0;
    $idDetalleSalida = isset($data["idDetalleSalida"]) ? intval($data["idDetalleSalida"]) : 0;
    $cliente = isset($data["cliente"]) ? $data["cliente"] : "";
    $corte = isset($data["corte"]) ? $data["corte"] : "";
    $produccion = isset($data["produccion"]) ? $data["produccion"] : "";
    $cantidadPliegos = isset($data["cantidadPliegos"]) ? floatval($data["cantidadPliegos"]) : 0;
    $precioPliego = isset($data["precioPliego"]) ? floatval($data["precioPliego"]) : 0;
    $tipoCambio = isset($data["tipoCambio"]) ? floatval($data["tipoCambio"]) : 1.00;

    // Validación de datos
    if ($idDetalleSalida <= 0 || $cliente === "" || $corte === "" || $produccion <= 0 || $cantidadPliegos <= 0 || $precioPliego <= 0 || $tipoCambio <= 0) {
        echo json_encode([
            "success" => false,
            "message" => "Todos los campos deben estar correctamente completados."
        ]);
        return;
    }

    // Cargar el modelo
    require_once "../models/TablaDetalleSalida.php";
    $TablaDetalleSalida = new TablaDetalleSalida();

    // Setear los valores en el modelo
    $TablaDetalleSalida->setIdMaterial($idMaterial);
    $TablaDetalleSalida->setIdDetalleSalida($idDetalleSalida);
    $TablaDetalleSalida->setCliente($cliente);
    $TablaDetalleSalida->setCorte($corte);
    $TablaDetalleSalida->setProduccion($produccion);
    $TablaDetalleSalida->setCantidadPliegos($cantidadPliegos);
    $TablaDetalleSalida->setPrecioPliego($precioPliego);
    $TablaDetalleSalida->setTipoCambio($tipoCambio);

    try {
        // Ejecutar la actualización en la base de datos
        $resultado = $TablaDetalleSalida->editarSalida();
    
        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Salida actualizada correctamente"
            ]);
            
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Error al actualizar la salida en el modelo"
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "success" => false,
            "message" => "Excepción: " . $e->getMessage()
        ]);
    }
    
}




function eliminarSalida() {
    $idDetalleEntrada = isset($_POST["idDetalleEntrada"]) ? intval($_POST["idDetalleEntrada"]) : 0;

    if (empty($idDetalleEntrada)) {
        echo json_encode(["success" => false, "message" => "ID de entrada no válido"]);
        return;
    }


    require_once "../models/TablaDetalleEntrada.php";
    $TablaDetalleEntrada = new TablaDetalleEntrada();
    
    $TablaDetalleEntrada->setIdDetalleEntrada($idDetalleEntrada);

    try {
        // Ejecutar la actualización en la base de datos
        $resultado = $TablaDetalleEntrada->eliminarEntrada();
    
        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Entrada eliminada correctamente"
            ]);
            
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Error al eliminar la entrada en el modelo"
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "success" => false,
            "message" => "Excepción: " . $e->getMessage()
        ]);
    }
}