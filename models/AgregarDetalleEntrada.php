<?php
require_once '../config/Conexion.php';

class AgregarDetalleEntrada extends Conexion
{
    protected static $cnx;
    private $factura;
    private $proveedor;
    private $cantidadResma;
    private $pliegoResma;
    private $cantidadPliego;
    private $precioPliego;
    private $descuento;
    private $tipoCambio;


    public function __construct() {}

    public function getFactura()
    {
        return $this->factura;
    }

    public function setFactura($factura)
    {
        $this->factura = $factura;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
    }

    public function getCantidadResma()
    {
        return $this->cantidadResma;
    }

    public function setCantidadResma($cantidadResma)
    {
        $this->cantidadResma = $cantidadResma;
    }

    public function getPliegoResma()
    {
        return $this->pliegoResma;
    }

    public function setPliegoResma($pliegoResma)
    {
        $this->pliegoResma = $pliegoResma;
    }

    public function getCantidadPliego()
    {
        return $this->cantidadPliego;
    }

    public function setCantidadPliego($cantidadPliego)
    {
        $this->cantidadPliego = $cantidadPliego;
    }

    public function getPrecioPliego()
    {
        return $this->precioPliego;
    }

    public function setPrecioPliego($precioPliego)
    {
        $this->precioPliego = $precioPliego;
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

    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }

    public function insertar()
    {
        $query = "CALL InsertarDetalleEntrada(:factura, :proveedor, :cantidadResma, :pliegoResma, :cantidadPliego, :precioPliego, :descuento, :tipoCambio)";

        try {
            self::getConexion();

            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":factura", $this->factura);
            $resultado->bindParam(":proveedor", $this->proveedor);
            $resultado->bindParam(":cantidadResma", $this->cantidadResma);
            $resultado->bindParam(":pliegoResma", $this->pliegoResma);
            $resultado->bindParam(":cantidadPliego", $this->cantidadPliego);
            $resultado->bindParam(":precioPliego", $this->precioPliego);
            $resultado->bindParam(":descuento", $this->descuento);
            $resultado->bindParam(":tipoCambio", $this->tipoCambio);

            $resultado->execute();

            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al insertar el detalle de entrada: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }
}
