<?php
require_once '../models/TablaProductos.php';

// Verificar si se ha enviado la operación deseada
switch ($_GET["op"]) {
    case 'listar':
        listar();
        break;

    case 'agregar':
        //agregar();
        break;

    case 'editar':
        //editar();
        break;

    case 'eliminar':
        //eliminar();
        break;
}


function listar()
{
    try {
        // Crear una instancia del modelo
        $tablaProductos = new TablaProductos();

        // Obtener los datos de la lista de productos
        $datos = $tablaProductos->listar();

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
                "message" => "No hay datos disponibles."
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
            "idMaterial" => $fila->getIdMateriales(),
            "nombreMaterial" => $fila->getMaterial(),
            "cantidadDisponible" => $fila->getCantidad_Inventario(),
            "valorInventario" => $fila->getValor_Inventario()
        );
    }
    return $data;
}


function agregar()
{
    $nombreMaterial = isset($_POST["nombreMaterial"]) ? trim($_POST["nombreMaterial"]) : "";
    $cantidadDisponible = isset($_POST["cantidadDisponible"]) ? trim($_POST["cantidadDisponible"]) : "";
    $valorInventario = isset($_POST["valorInventario"]) ? trim($_POST["valorInventario"]) : "";

    if (empty($nombreMaterial) || empty($cantidadDisponible) || empty($valorInventario)) {
        echo "Favor ingresar todos los datos";
        return;
    }

    $material = new TablaProductos();
    $material->setNombreMaterial($nombreMaterial);
    $material->setCantidad_Inventario($cantidadDisponible);
    $material->setValor_Inventario($valorInventario);

    try {
        $resultado = $material->agregar();

        if ($resultado) {
            echo "1";

        } else {
            echo "No fue posible la operación";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
/*
function editar()
{
    $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
    $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";

    

    if (empty($id) || empty($nombre) || empty($descripcion) || empty($precio)) {
        echo "Favor ingresar todos los datos";
        return;
    }

    $producto = new TablaProductos();
    $producto->setId($id);
    $producto->setNombre($nombre);
    $producto->setDescripcion($descripcion);
    $producto->setPrecio($precio);

    try {
        $resultado = $producto->editar($id, $nombre, $descripcion, $precio);

        if ($resultado) {
            echo "1";
        } else {
            echo "No fue posible la operación";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

function eliminar()
{
    $id = isset($_POST["id"]) ? trim($_POST["id"]) : "";

    if (empty($id)) {
        echo "Favor ingresar todos los datos";
        return;
    }

    $producto = new TablaProductos();
    $producto->setId($id);

    try {
        $resultado = $producto->eliminar($id);

        if ($resultado) {
            echo "1";
        } else {
            echo "No fue posible la operación";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
    */