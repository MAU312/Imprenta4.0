<?php
require_once '../models/TablaProductos.php';

if (isset($_GET['op'])) {
    $op = $_GET['op'];
    $modelo = new TablaProductos();

    switch ($op) {
        case 'valorTotal':
            $total = $modelo->obtenerValorTotalInventario();
            echo json_encode(['total' => number_format($total, 2, ',', '.')]);
            break;

        case 'importacionesMes':
            // Obtener el total de importaciones del mes usando el modelo
            $importacionesMes = $modelo->obtenerImportacionesMes();
            echo json_encode(['total' => $importacionesMes]); // Respuesta en formato JSON
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Operación no válida']);
            break;
    }
}
