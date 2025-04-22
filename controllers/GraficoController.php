<?php
require_once '../models/GraficoModel.php';

class GraficoController
{
    public function ventasPorMes()
    {
        // Obtener el año desde el parámetro GET (por defecto 2025)
        $anio = isset($_GET['anio']) ? intval($_GET['anio']) : date('Y');

        // Instanciamos el modelo para obtener los datos
        $graficoModel = new GraficoModel();
        $ventasPorMes = $graficoModel->obtenerVentasPorMes($anio);

        // Asegurarnos de que haya un valor para cada mes
        $ventas = array_fill(0, 12, 0); // Inicializar el array con ceros

        foreach ($ventasPorMes as $venta) {
            $mes = intval($venta['mes']) - 1; // 0-indexed
            $ventas[$mes] = intval($venta['cantidadVentas']); // Cambiar 'total' por 'cantidadVentas'
        }
        
        // Devolver los datos en formato JSON
        echo json_encode([
            'meses' => ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            'ventas' => $ventas,
            'max_y' => max($ventas) + 1 // para escalar el gráfico
        ]);
    }

    public function gastosEIngresosPorMes()
    {
        $anio2 = isset($_GET['anio2']) ? intval($_GET['anio2']) : date('Y'); // Aquí se recibe 'anio' correctamente

        // Obtener los datos de gastos e ingresos del modelo
        $graficoModel = new GraficoModel();
        $datos = $graficoModel->obtenerGastosEIngresosPorMes($anio2);

        // Inicializar los arrays para los meses con ceros
        $gastos = array_fill(0, 12, 0);
        $ingresos = array_fill(0, 12, 0);

        // Extraer los datos ya procesados
        $gastos = $datos['gastos'];
        $ingresos = $datos['ingresos'];

        // Devolver los datos en formato JSON
        echo json_encode([
            'meses' => ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            'gastos' => $gastos,  // Array de gastos con datos completos
            'ingresos' => $ingresos,  // Array de ingresos con datos completos
            'max_y' => max(max($gastos), max($ingresos)) + 1000 // margen para escalar el gráfico
        ]);
    }
}


// Enrutamiento simple
if (isset($_GET['op'])) {
    $controller = new GraficoController();

    switch ($_GET['op']) {
        case 'ventasPorMes':
            $controller->ventasPorMes();
            break;
        case 'gastosEIngresosPorMes':
            $controller->gastosEIngresosPorMes();
            break;
        default:
            echo json_encode(['error' => 'Operación no válida']);
            break;
    }
}
