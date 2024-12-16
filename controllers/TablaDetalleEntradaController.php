<?php
require_once '../models/TablaDetalleEntrada.php';

// Verificar si se ha enviado la operación deseada
switch ($_GET["op"]) {
    case 'listar':
        listar();
        break;

    case 'agregar':
        // agregar();
        break;

    case 'editar':
        // editar();
        break;

    case 'eliminar':
        // eliminar();
        break;
}

function listar()
{
    try {
        // Crear una instancia del modelo
        $tablaDetalleEntrada = new TablaDetalleEntrada();

        // Obtener los datos de la lista de detalle de entrada
        $datos = $tablaDetalleEntrada->listar();

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
            "idDetalleEntrada" => $fila->getIdDetalleEntrada(),
            "idMaterial" => $fila->getIdMaterial(),
            "fechaDetalle" => $fila->getFechaDetalle(),
            "proveedor" => $fila->getProveedor(),
            "factura" => $fila->getFactura(),
            "cantidadResma" => $fila->getCantidadResma(),
            "pliegosResma" => $fila->getPliegosResma(),
            "cantidadPliegos" => $fila->getCantidadPliegos(),
            "precioPliego" => $fila->getPrecioPliego(),
            "subtotal" => $fila->getSubtotal(),
            "descuento" => $fila->getDescuento(),
            "tipoCambio" => $fila->getTipoCambio(),
            "precioTotal" => $fila->getPrecioTotal()
        );
    }
    return $data;
}


/*
 

function agregar()
{
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $descripcion = isset($_POST["descripcion"]) ? trim($_POST["descripcion"]) : "";
    $precio = isset($_POST["precio"]) ? trim($_POST["precio"]) : "";

    if (empty($nombre) || empty($descripcion) || empty($precio)) {
        echo "Favor ingresar todos los datos";
        return;
    }

    $producto = new TablaProductos();
    $producto->setNombre($nombre);
    $producto->setDescripcion($descripcion);
    $producto->setPrecio($precio);

    try {
        $resultado = $producto->agregar();

        if ($resultado) {
            echo "1";

        } else {
            echo "No fue posible la operación";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

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