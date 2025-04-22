<?php
require_once '../config/Conexion.php';

class TablaDetalleSalida extends Conexion
{
    protected static $cnx;
    private $idDetalleSalida;
    private $idMaterial;
    private $fechaDetalle;
    private $cliente;
    private $corte;
    private $produccion;
    private $cantidadPliegos;
    private $precioPliego;
    private $tipoCambio;
    private $precioTotal;

    // Getters y setters

    public function __construct() {}

    public function getIdDetalleSalida()
    {
        return $this->idDetalleSalida;
    }

    public function setIdDetalleSalida($idDetalleSalida)
    {
        $this->idDetalleSalida = $idDetalleSalida;
    }

    public function getIdMaterial()
    {
        return $this->idMaterial;
    }

    public function setIdMaterial($idMaterial)
    {
        $this->idMaterial = $idMaterial;
    }

    public function getFechaDetalle()
    {
        return $this->fechaDetalle;
    }

    public function setFechaDetalle($fechaDetalle)
    {
        $this->fechaDetalle = $fechaDetalle;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getCorte()
    {
        return $this->corte;
    }

    public function setCorte($corte)
    {
        $this->corte = $corte;
    }

    public function getProduccion()
    {
        return $this->produccion;
    }

    public function setProduccion($produccion)
    {
        $this->produccion = $produccion;
    }

    public function getCantidadPliegos()
    {
        return $this->cantidadPliegos;
    }

    public function setCantidadPliegos($cantidadPliegos)
    {
        $this->cantidadPliegos = $cantidadPliegos;
    }

    public function getPrecioPliego()
    {
        return $this->precioPliego;
    }

    public function setPrecioPliego($precioPliego)
    {
        $this->precioPliego = $precioPliego;
    }

    public function getTipoCambio()
    {
        return $this->tipoCambio;
    }

    public function setTipoCambio($tipoCambio)
    {
        $this->tipoCambio = $tipoCambio;
    }

    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    public function setPrecioTotal($precioTotal)
    {
        $this->precioTotal = $precioTotal;
    }

    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }

    // Métodos para interactuar con la base de datos

    public function agregarSalida()
    {
        $sql = "INSERT INTO detalle_salida (id_material, fecha_detalle, cliente, corte, produccion, cantidad_pliegos, precio_pliego, tipo_cambio, precio_total) 
                VALUES (:id_material, :fecha_detalle, :cliente, :corte, :produccion, :cantidad_pliegos, :precio_pliego, :tipo_cambio, :precio_total)";
        $stmt = self::$cnx->prepare($sql);
        $stmt->bindParam(':id_material', $this->idMaterial);
        $stmt->bindParam(':fecha_detalle', $this->fechaDetalle);
        $stmt->bindParam(':cliente', $this->cliente);
        $stmt->bindParam(':corte', $this->corte);
        $stmt->bindParam(':produccion', $this->produccion);
        $stmt->bindParam(':cantidad_pliegos', $this->cantidadPliegos);
        $stmt->bindParam(':precio_pliego', $this->precioPliego);
        $stmt->bindParam(':tipo_cambio', $this->tipoCambio);
        $stmt->bindParam(':precio_total', $this->precioTotal);

        return $stmt->execute();
    }

    public function editarSalida()
    {
        $query = "CALL editarSalidaMaterial(
            :idDetalleSalida,
            :cliente, 
            :corte, 
            :produccion, 
            :cantidadPliegos, 
            :precioPliego, 
            :tipoCambio
          )";

          try {
            self::getConexion();

            // Preparar la consulta
            $stmt = self::$cnx->prepare($query);

            // Vincular los parámetros
            $stmt->bindParam(':idDetalleSalida', $this->idDetalleSalida);
            $stmt->bindParam(':cliente', $this->cliente);
            $stmt->bindParam(':corte', $this->corte);
            $stmt->bindParam(':produccion', $this->produccion);
            $stmt->bindParam(':cantidadPliegos', $this->cantidadPliegos);
            $stmt->bindParam(':precioPliego', $this->precioPliego);
            $stmt->bindParam(':tipoCambio', $this->tipoCambio);

            // Ejecutar la consulta
            $resultado = $stmt->execute();
            if (!$resultado) {
                $errorInfo = $stmt->errorInfo();
                error_log("Error en editarEntrada: " . implode(" | ", $errorInfo)); // <- Esto se verá en logs
            }

            return $resultado;
        } catch (PDOException $e) {
            throw new Exception("Error al editar la entrada: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    public function eliminarSalida()
    {
        $sql = "DELETE FROM detalle_salida WHERE id_detalle_salida = :id_detalle_salida";
        $stmt = self::$cnx->prepare($sql);
        $stmt->bindParam(':id_detalle_salida', $this->idDetalleSalida);

        return $stmt->execute();
    }

}