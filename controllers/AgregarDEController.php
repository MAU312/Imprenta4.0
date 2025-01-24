<?php
require_once '../models/AgregarDetalleEntrada.php';

// Verificar si se ha enviado la operación deseada
switch ($_GET["op"]) {
    case 'listar':
        listar();
        break;

    case 'agregar':
        agregar();
        break;
}

function agregar()
{
    try {
        // Verificar si se han enviado los datos del formulario
        if (
            isset($_POST["proveedor"]) &&
            isset($_POST["factura"]) &&
            isset($_POST["cantidadResma"]) &&
            isset($_POST["pliegoResma"]) &&
            isset($_POST["cantidadPliego"]) &&
            isset($_POST["precioPliego"]) &&
            isset($_POST['descuento']) &&
            isset($_POST['tipoCambio'])
        ) {

            // Crear una nueva instancia del modelo
            $agregarDetalleEntrada = new AgregarDetalleEntrada();

            // Asignar los valores del formulario al modelo
            $agregarDetalleEntrada->setFactura($_POST["factura"]);
            $agregarDetalleEntrada->setProveedor($_POST["proveedor"]);
            $agregarDetalleEntrada->setCantidadResma($_POST["cantidadResma"]);
            $agregarDetalleEntrada->setPliegoResma($_POST["pliegoResma"]);
            $agregarDetalleEntrada->setCantidadPliego($_POST["cantidadPliego"]);
            $agregarDetalleEntrada->setPrecioPliego($_POST["precioPliego"]);
            $agregarDetalleEntrada->setDescuento($_POST["descuento"]);
            $agregarDetalleEntrada->setTipoCambio($_POST["tipoCambio"]);

            // Insertar el nuevo detalle de entrada en la base de datos
            $resultado = $agregarDetalleEntrada->insertar();

            if ($resultado) {
                // Respuesta de éxito en formato JSON
                echo json_encode([
                    "success" => true,
                    "message" => "Detalle de entrada agregado correctamente."
                ]);
            } else {
                // Respuesta de error en caso de fallo en la inserción
                echo json_encode([
                    "success" => false,
                    "message" => "Error al agregar el detalle de entrada."
                ]);
            }
        } else {
            // Respuesta de error si faltan campos
            echo json_encode([
                "success" => false,
                "message" => "Faltan datos del formulario."
            ]);
        }
    } catch (Exception $e) {
        // Respuesta de error si ocurre una excepción
        echo json_encode([
            "success" => false,
            "message" => "Error: " . $e->getMessage()
        ]);
    }
}
