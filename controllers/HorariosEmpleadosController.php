<?php
require_once '../models/HorariosEmpleados.php'; // Asegúrate de que este archivo esté en la ubicación correcta

// Verificar si se ha enviado la operación deseada
if (isset($_GET["op"])) {
    switch ($_GET["op"]) {
        case 'agregar':
            agregar();
            break;
        case 'buscarPorPeriodo':
            buscarPorPeriodo();
            break;
        default:
            echo json_encode(["success" => false, "message" => "Operación no válida."]);
            break;
    }
} else {
    echo json_encode(["success" => false, "message" => "No se especificó ninguna operación."]);
}

function agregar()
{
    // Recibir los datos enviados desde el frontend en formato JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Validar que se recibieron datos
    if (empty($data)) {
        echo json_encode(["success" => false, "message" => "No se recibieron datos."]);
        return;
    }

    $horariosEmpleados = new HorariosEmpleados(); // Instancia del modelo

    try {
        // Recorrer los datos de los empleados
        foreach ($data as $empleado) {
            // Validar que los datos del empleado estén completos
            if (empty($empleado['nombre']) || empty($empleado['periodo']) || empty($empleado['diasTrabajados']) || empty($empleado['horasDeLlegada']) || empty($empleado['horasDeSalida'])) {
                echo json_encode(["success" => false, "message" => "Datos incompletos para el empleado: " . $empleado['nombre']]);
                return;
            }

            // Asignar los datos al modelo
            $horariosEmpleados->setNombre($empleado['nombre']);
            $horariosEmpleados->setPeriodo($empleado['periodo']);
            $horariosEmpleados->setDiasTrabajados($empleado['diasTrabajados']);
            $horariosEmpleados->setHorasDeLlegada($empleado['horasDeLlegada']);
            $horariosEmpleados->setHorasDeSalida($empleado['horasDeSalida']);

            // Guardar los datos en la base de datos
            if (!$horariosEmpleados->agregar()) {
                echo json_encode(["success" => false, "message" => "Error al guardar los datos del empleado: " . $empleado['nombre']]);
                return;
            }
        }

        // Respuesta de éxito
        echo json_encode(["success" => true, "message" => "Datos guardados correctamente."]);
    } catch (Exception $e) {
        // Captura de errores
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
}

function buscarPorPeriodo()
{
    header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON

    $periodo = isset($_GET['periodo']) ? trim($_GET['periodo']) : '';

    if (empty($periodo)) {
        echo json_encode(["success" => false, "message" => "Debes especificar un período para buscar."]);
        return;
    }

    $horariosEmpleados = new HorariosEmpleados();

    try {
        $resultados = $horariosEmpleados->buscarPorPeriodo($periodo);
        echo json_encode(["success" => true, "data" => $resultados]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
}
?>