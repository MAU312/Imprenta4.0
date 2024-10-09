<?php
require_once '../config/Conexion.php';

class TablaProductos extends Conexion
{
    protected static $cnx;
    private $idDetalleEntrada;
    private $idMateriales;
    private $fechaDetalle;
    private $proveedor;
    private $factura;
    private $cantidadResma;
    private $pliegosResma;
    private $cantidadPliegos;
    private $precioPliego;
    private $subtotal;
    private $descuento;
    private $tipoCambio;
    private $precioTotal;


    // Getters y setters

    public function __construct() {}

    public function getIdDetalleEntrada()
    {
        return $this->idDetalleEntrada;
    }

    public function setIdDetalleEntrada($idDetalleEntrada)
    {
        $this->idDetalleEntrada = $idDetalleEntrada;
    }

    public function getIdMateriales()
    {
        return $this->idMateriales;
    }

    public function setIdMateriales($idMateriales)
    {
        $this->idMateriales = $idMateriales;
    }

    public function getFechaDetalle()
    {
        return $this->fechaDetalle;
    }

    public function setFechaDetalle($fechaDetalle)
    {
        $this->fechaDetalle = $fechaDetalle;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
    }

    public function getFactura()
    {
        return $this->factura;
    }

    public function setFactura($factura)
    {
        $this->factura = $factura;
    }

    public function getCantidadResma()
    {
        return $this->cantidadResma;
    }

    public function setCantidadResma($cantidadResma)
    {
        $this->cantidadResma = $cantidadResma;
    }

    public function getPliegosResma()
    {
        return $this->pliegosResma;
    }

    public function setPliegosResma($pliegosResma)
    {
        $this->pliegosResma = $pliegosResma;
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

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    public function getDescuento()
    {
        return $this->descuento;
    }

    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
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

    // Obtener detalles por idMaterial
    public function obtenerDetallesPorMaterial($idMaterial)
    {
        // Query para obtener los detalles del material
        $query = "SELECT * FROM detalleentrada WHERE idMateriales = :idMaterial";

        try {
            // Intentamos conectar dentro del bloque try para capturar cualquier fallo en la conexión
            self::getConexion();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(':idMaterial', $idMaterial, PDO::PARAM_INT); // Vinculamos el parámetro
            $resultado->execute();

            // Recuperamos todas las filas
            $filas = $resultado->fetchAll(PDO::FETCH_ASSOC); // Obtener como array asociativo

            return $filas; // Retornar los resultados
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los detalles: " . $e->getMessage());
        } finally {
            // Aseguramos la desconexión al final de la ejecución
            self::desconectar();
        }
    }
}
