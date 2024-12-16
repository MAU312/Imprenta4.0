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
            $idMaterial, $cliente, $corte, $produccion, 
            $cantidadPliegos, $precioPliego, $tipoCambio
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
?>
