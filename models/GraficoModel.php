<?php
require_once '../config/Conexion.php';

class GraficoModel
{

    // Función para obtener la conexión
    private function obtenerConexion()
    {
        $conexion = new Conexion(); // Aquí asumo que tu clase Conexion existe y tiene el método conectar
        return $conexion->conectar(); // Este método debería devolver el objeto PDO
    }

    // Función para obtener las ventas por mes
    public function obtenerVentasPorMes($anio)
    {
        // Obtener la conexión de la base de datos
        $pdo = $this->obtenerConexion(); // Aquí obtienes la conexión de la base de datos

        // Consulta SQL
        $sql = "SELECT MONTH(fechaDetalle) AS mes, COUNT(idDetalleSalida) AS cantidadVentas
                FROM detallesalida
                WHERE YEAR(fechaDetalle) = ?
                GROUP BY MONTH(fechaDetalle)";

        // Preparar y ejecutar la consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$anio]);

        // Obtener los resultados
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerGastosEIngresosPorMes($anio2)
    {
        $pdo = $this->obtenerConexion();

        // Gastos (detalleentrada)
        $sqlGastos = "SELECT MONTH(fechaDetalle) AS mes, SUM(precioTotal) AS total
                  FROM detalleentrada
                  WHERE YEAR(fechaDetalle) = ?
                  GROUP BY MONTH(fechaDetalle)";
        $stmtGastos = $pdo->prepare($sqlGastos);
        $stmtGastos->execute([$anio2]);
        $gastosData = $stmtGastos->fetchAll(PDO::FETCH_ASSOC);

        // Ingresos (detallesalida)
        $sqlIngresos = "SELECT MONTH(fechaDetalle) AS mes, SUM(precioTotal) AS total
                    FROM detallesalida
                    WHERE YEAR(fechaDetalle) = ?
                    GROUP BY MONTH(fechaDetalle)";
        $stmtIngresos = $pdo->prepare($sqlIngresos);
        $stmtIngresos->execute([$anio2]);
        $ingresosData = $stmtIngresos->fetchAll(PDO::FETCH_ASSOC);

        // Inicializar arrays con 12 meses
        $gastos = array_fill(0, 12, 0);
        $ingresos = array_fill(0, 12, 0);

        foreach ($gastosData as $gasto) {
            $mes = intval($gasto['mes']) - 1;
            $gastos[$mes] = floatval($gasto['total']);
        }

        foreach ($ingresosData as $ingreso) {
            $mes = intval($ingreso['mes']) - 1;
            $ingresos[$mes] = floatval($ingreso['total']);
        }

        return [
            'gastos' => $gastos,
            'ingresos' => $ingresos
        ];
    }
}
