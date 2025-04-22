<?php

require_once '../models/entradaMaterial.php'; // Asegúrate de que este archivo esté en la ubicación correcta

// Verificar si se ha enviado la operación deseada
if (isset($_GET["op"])) {
    switch ($_GET["op"]) {
        case 'listarDetalles':
            listarDetalles();
            break;
        case 'agregarEntrada':
            insertarEntrada();
            break;
        case 'editarEntrada':
            editarEntrada();
            break;
        case 'eliminarEntrada':
            eliminarEntrada();
            break;
    }
}

function listarDetalles()
{
    if (isset($_GET['idMaterial'])) {
        $idMaterial = $_GET['idMaterial'];

        // Crear una instancia del modelo TablaProductos
        $detalleEntrada = new TablaProductos();

        // Llamar al método del modelo que obtiene los detalles por idMaterial
        $resultado = $detalleEntrada->obtenerDetallesPorMaterial($idMaterial);

        if ($resultado) {
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

function insertarEntrada()
{
    // Verificar si se ha proporcionado el idMaterial en la URL
    if (isset($_GET['idMaterial'])) {
        $idMaterial = $_GET['idMaterial'];

        // Recibir y sanitizar los valores enviados desde el formulario
        $proveedor = $_POST['proveedor'];
        $factura = $_POST['factura'];
        $cantidadResma = $_POST['cantidadResma'];
        $pliegosResma = $_POST['pliegosResma'];
        $cantidadPliegos = $_POST['cantidadPliegos'];
        $precioPliego = $_POST['precioPliego'];
        $descuento = $_POST['descuento'] ?? 0;
        $tipoCambio = $_POST['tipoCambio'] ?? 1.00;

        // Crear una instancia del modelo
        $detalleEntrada = new TablaProductos();

        // Llamar al método que inserta la nueva entrada en la tabla, utilizando un stored procedure
        $resultado = $detalleEntrada->insertarEntrada(
            $idMaterial,
            $proveedor,
            $factura,
            $cantidadResma,
            $pliegosResma,
            $cantidadPliegos,
            $precioPliego,
            $descuento,
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

function editarEntrada() {
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
    // Obtener los datos del JSON
    $idMaterial = isset($data["idMaterial"]) ? intval($data["idMaterial"]) : 0;  // Asegúrate de obtener el idMaterial
    $idDetalleEntrada = isset($data["idDetalleEntrada"]) ? intval($data["idDetalleEntrada"]) : 0;
    $proveedor = isset($data["proveedor"]) ? trim($data["proveedor"]) : "";
    $factura = isset($data["factura"]) ? trim($data["factura"]) : 0;
    $cantidadResma = isset($data["cantidadResma"]) ? intval($data["cantidadResma"]) : 0;
    $pliegosResma = isset($data["pliegosResma"]) ? intval($data["pliegosResma"]) : 0;
    $cantidadPliegos = isset($data["cantidadPliegos"]) ? intval($data["cantidadPliegos"]) : 0;
    $precioPliego = isset($data["precioPliego"]) ? floatval($data["precioPliego"]) : 0;
    $descuento = isset($data["descuento"]) ? floatval($data["descuento"]) : 0;
    $tipoCambio = isset($data["tipoCambio"]) ? floatval($data["tipoCambio"]) : 1.00;

    // Validación de datos
    if ($idDetalleEntrada <= 0 || $proveedor === "" || $factura <= 0 || $cantidadResma <= 0 || $pliegosResma <= 0 || $cantidadPliegos <= 0 || $precioPliego <= 0 || $descuento < 0 || $tipoCambio <= 0) {
        echo json_encode([
            "success" => false,
            "message" => "Todos los campos deben estar correctamente completados."
        ]);
        return;
    }
    

    // Cargar el modelo
    require_once "../models/TablaDetalleEntrada.php";
    $TablaDetalleEntrada = new TablaDetalleEntrada();

    // Setear los valores en el modelo
    $TablaDetalleEntrada->setIdMaterial($idMaterial);
    $TablaDetalleEntrada->setIdDetalleEntrada($idDetalleEntrada);
    $TablaDetalleEntrada->setProveedor($proveedor);
    $TablaDetalleEntrada->setFactura($factura);
    $TablaDetalleEntrada->setCantidadResma($cantidadResma);
    $TablaDetalleEntrada->setPliegosResma($pliegosResma);
    $TablaDetalleEntrada->setCantidadPliegos($cantidadPliegos);
    $TablaDetalleEntrada->setPrecioPliego($precioPliego);
    $TablaDetalleEntrada->setDescuento($descuento);
    $TablaDetalleEntrada->setTipoCambio($tipoCambio);

    try {
        // Ejecutar la actualización en la base de datos
        $resultado = $TablaDetalleEntrada->editarEntrada();

        

    
        if ($resultado) {
            echo json_encode([
                "success" => true,
                "message" => "Entrada actualizada correctamente"
            ]);
            
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Error al actualizar la entrada en el modelo"
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "success" => false,
            "message" => "Excepción: " . $e->getMessage()
        ]);
    }
    
}




function eliminarEntrada() {
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
