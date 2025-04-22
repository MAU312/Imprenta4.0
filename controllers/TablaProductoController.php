<?php
require_once '../models/TablaProductos.php'; // Asegúrate de que este archivo esté en la ubicación correcta

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
    case 'detalles':
        //listarDetalles(); // Llama a la función para obtener detalles
        break;

    case 'eliminar':
        //eliminar();
        eliminar();
        break;
}

function listar()
{
    try {
        $tablaProductos = new TablaProductos();
        
        // Parámetros de DataTables
        $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
        $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
        $searchValue = isset($_GET['searchValue']) ? trim($_GET['searchValue']) : '';
        
        // Obtener los datos con filtrado
        $datos = $tablaProductos->listar($start, $length, $searchValue);
        
        // Obtener el total de registros
        $totalRegistros = $tablaProductos->contarTotalRegistros();
        
        // Obtener el total de registros filtrados
        $totalFiltrados = $searchValue ? $tablaProductos->contarRegistrosFiltrados($searchValue) : $totalRegistros;

        if (!empty($datos)) {
            $data = transformarDatos($datos);
            
            $resultados = array(
                "success" => true,
                "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 1,
                "recordsTotal" => $totalRegistros,
                "recordsFiltered" => $totalFiltrados,
                "data" => $data
            );
        } else {
            $resultados = array(
                "success" => true,
                "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => array(),
                "message" => "No se encontraron registros"
            );
        }

        echo json_encode($resultados);
    } catch (Exception $e) {
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
            "idMateriales" => $fila->getIdMateriales(),
            "material" => $fila->getMaterial(),
            "cantidad_inventario" => $fila->getCantidad_Inventario(),
            "valor_inventario" => $fila->getValor_Inventario()
        );
    }
    return $data;
}

function agregar()
{
    // Obtiene y limpia el nombre del material
    $material = isset($_POST["material"]) ? trim($_POST["material"]) : "";

    if (empty($material)) {
        echo "Favor ingresar todos los datos";
        return;
    }

    $tablaProductos = new TablaProductos(); // Instancia del modelo
    $tablaProductos->setMaterial($material); // Asigna el material

    try {
        // Primero, verifica si el material ya existe
        if ($tablaProductos->existeMaterial()) {
            echo "2"; // Respuesta: el material ya existe
            return;
        }

        // Llama al método agregar del modelo
        if ($tablaProductos->agregar()) {
            echo "1"; // Respuesta exitosa
        } else {
            echo "3"; // Respuesta de error (no fue posible la operación)
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage(); // Captura de errores
    }
}
function editar() {
    $idMateriales = isset($_POST["idMateriales"]) ? intval($_POST["idMateriales"]) : 0;
    $material = isset($_POST["material"]) ? trim($_POST["material"]) : "";
    if (empty($idMateriales) || empty($material)) {
        echo json_encode(["success" => false, "message" => "Datos incompletos"]);
        return;
    }
    $tablaProductos = new TablaProductos();
    $tablaProductos->setIdMateriales($idMateriales);
    $tablaProductos->setMaterial($material);
    try {
        if ($tablaProductos->editar()) {
            echo json_encode(["success" => true]); // Enviar respuesta JSON correcta
        } else {
            echo json_encode(["success" => false, "message" => "Error al actualizar"]);
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}
function eliminar() {
    // Obtener el ID del material a eliminar
    $idMateriales = isset($_POST["idMateriales"]) ? intval($_POST["idMateriales"]) : 0;
    if (empty($idMateriales)) {
        echo json_encode(["success" => false, "message" => "ID de material no válido"]);
        return;
    }
    // Crear una instancia del modelo
    $tablaProductos = new TablaProductos();
    $tablaProductos->setIdMateriales($idMateriales);
    try {
        // Intentar eliminar el material
        if ($tablaProductos->eliminar()) {
            echo json_encode(["success" => true, "message" => "Material eliminado correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "No se pudo eliminar el material."]);
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
}