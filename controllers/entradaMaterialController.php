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
        case 'agregarEntrada':
            editarEntrada();
            break;
        case 'agregarEntrada':
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
            $idMaterial, $proveedor, $factura, $cantidadResma, 
            $pliegosResma, $cantidadPliegos, $precioPliego, 
            $descuento, $tipoCambio
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

function editarEntrada() 
{
    // Obtener y validar los datos del formulario
    $idDetalleEntrada = isset($_POST["idDetalleEntrada"]) ? intval($_POST["idDetalleEntrada"]) : 0;
    $proveedor = isset($_POST["proveedor"]) ? trim($_POST["proveedor"]) : "";
    $factura = isset($_POST["factura"]) ? intval($_POST["factura"]) : 0;
    $cantidadResma = isset($_POST["cantidadResma"]) ? intval($_POST["cantidadResma"]) : 0;
    $pliegosResma = isset($_POST["pliegosResma"]) ? intval($_POST["pliegosResma"]) : 0;
    $cantidadPliegos = isset($_POST["cantidadPliegos"]) ? intval($_POST["cantidadPliegos"]) : 0;
    $precioPliego = isset($_POST["precioPliego"]) ? floatval($_POST["precioPliego"]) : 0.0;
    $descuento = isset($_POST["descuento"]) ? trim($_POST["descuento"]) : "0";
    $tipoCambio = isset($_POST["tipoCambio"]) ? floatval($_POST["tipoCambio"]) : 1.0;

    // Validar que los datos obligatorios no estén vacíos
    if (empty($idDetalleEntrada) || empty($proveedor) || empty($factura) || empty($cantidadResma) || empty($pliegosResma) || empty($cantidadPliegos) || empty($precioPliego)) {
        echo json_encode(["success" => false, "message" => "Datos incompletos"]);
        return;
    }

    // Crear una instancia del modelo
    $tablaProductos = new TablaProductos();

    // Asignar los valores al modelo
    $tablaProductos->setIdDetalleEntrada($idDetalleEntrada);
    $tablaProductos->setProveedor($proveedor);
    $tablaProductos->setFactura($factura);
    $tablaProductos->setCantidadResma($cantidadResma);
    $tablaProductos->setPliegosResma($pliegosResma);
    $tablaProductos->setCantidadPliegos($cantidadPliegos);
    $tablaProductos->setPrecioPliego($precioPliego);
    $tablaProductos->setDescuento($descuento);
    $tablaProductos->setTipoCambio($tipoCambio);

    try {
        // Intentar editar la entrada
        if ($tablaProductos->editarDetalleEntrada()) {
            echo json_encode(["success" => true, "message" => "Entrada actualizada correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo actualizar la entrada."]);
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
}

function eliminarEntrada() 
{
    // Obtener el ID de la entrada a eliminar
    $idDetalleEntrada = isset($_POST["idDetalleEntrada"]) ? intval($_POST["idDetalleEntrada"]) : 0;

    // Validar que el ID no esté vacío
    if (empty($idDetalleEntrada)) {
        echo json_encode(["success" => false, "message" => "ID de entrada no válido"]);
        return;
    }

    // Crear una instancia del modelo
    $tablaProductos = new TablaProductos();
    $tablaProductos->setIdDetalleEntrada($idDetalleEntrada);

    try {
        // Intentar eliminar la entrada
        if ($tablaProductos->eliminarDetalleEntrada()) {
            echo json_encode(["success" => true, "message" => "Entrada eliminada correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo eliminar la entrada."]);
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
}
