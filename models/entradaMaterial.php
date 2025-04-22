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

    // Método para insertar una nueva entrada de material
    public function insertarEntrada($idMaterial, $proveedor, $factura, $cantidadResma, $pliegosResma, $cantidadPliegos, $precioPliego, $descuento, $tipoCambio)
    {
        // SQL para llamar al stored procedure
        $sql = "CALL agregarEntradaMaterial(?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($sql);

            // Vincular parámetros
            $stmt->bindParam(1, $idMaterial, PDO::PARAM_INT);
            $stmt->bindParam(2, $proveedor, PDO::PARAM_STR);
            $stmt->bindParam(3, $factura, PDO::PARAM_STR);
            $stmt->bindParam(4, $cantidadResma, PDO::PARAM_INT);
            $stmt->bindParam(5, $pliegosResma, PDO::PARAM_INT);
            $stmt->bindParam(6, $cantidadPliegos, PDO::PARAM_INT);
            $stmt->bindParam(7, $precioPliego, PDO::PARAM_STR);
            $stmt->bindParam(8, $descuento, PDO::PARAM_STR);
            $stmt->bindParam(9, $tipoCambio, PDO::PARAM_STR);

            // Ejecutar el stored procedure
            if ($stmt->execute()) {
                return true; // Retorna true si la inserción fue exitosa
            } else {
                return false; // Si algo falla, retorna false
            }
        } catch (PDOException $e) {
            throw new Exception("Error al insertar la entrada: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    public function editarEntrada() {
        $query = "CALL editarEntradaMaterial(:idDetalleEntrada, :idMateriales, :proveedor, :factura, :cantidadResma, :pliegosResma, :cantidadPliegos, :precioPliego, :descuento, :tipoCambio)";
        
        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);
    
            $stmt->bindParam(":idDetalleEntrada", $this->idDetalleEntrada, PDO::PARAM_INT);
            $stmt->bindParam(":idMateriales", $this->idMateriales, PDO::PARAM_INT);
            $stmt->bindParam(":proveedor", $this->proveedor, PDO::PARAM_STR);
            $stmt->bindParam(":factura", $this->factura, PDO::PARAM_STR);
            $stmt->bindParam(":cantidadResma", $this->cantidadResma, PDO::PARAM_INT);
            $stmt->bindParam(":pliegosResma", $this->pliegosResma, PDO::PARAM_INT);
            $stmt->bindParam(":cantidadPliegos", $this->cantidadPliegos, PDO::PARAM_INT);
            $stmt->bindParam(":precioPliego", $this->precioPliego, PDO::PARAM_STR);
            $stmt->bindParam(":descuento", $this->descuento, PDO::PARAM_STR);
            $stmt->bindParam(":tipoCambio", $this->tipoCambio, PDO::PARAM_STR);
    
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar la entrada: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }
     

    public function eliminarEntrada() {
        $query = "CALL eliminarEntradaMaterial(:idDetalleEntrada)";
        
        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(":idDetalleEntrada", $this->idDetalleEntrada, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar la entrada: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }
}
