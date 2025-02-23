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
