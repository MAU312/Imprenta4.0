<?php
require_once '../config/Conexion.php';

class TablaDetalleEntrada extends Conexion
{
    protected static $cnx;
    private $idDetalleEntrada;
    private $idMaterial; // <- antes era $idMateriales
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

    public function listar()
    {
        $query = "CALL listarDetalleEntrada()";

        try {
            self::getConexion();

            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            $filas = $resultado->fetchAll();

            $data = array();
            foreach ($filas as $fila) {
                $tabla = new self();  // Crear una nueva instancia de la clase
                $tabla->setIdDetalleEntrada($fila["idDetalleEntrada"]);
                $tabla->setIdMaterial($fila["idMaterial"]);
                $tabla->setFechaDetalle($fila["fechaDetalle"]);
                $tabla->setProveedor($fila["proveedor"]);
                $tabla->setFactura($fila["factura"]);
                $tabla->setCantidadResma($fila["cantidadResma"]);
                $tabla->setPliegosResma($fila["pliegosResma"]);
                $tabla->setCantidadPliegos($fila["cantidadPliegos"]);
                $tabla->setPrecioPliego($fila["precioPliego"]);
                $tabla->setSubtotal($fila["subtotal"]);
                $tabla->setDescuento($fila["descuento"]);
                $tabla->setTipoCambio($fila["tipoCambio"]);
                $tabla->setPrecioTotal($fila["precioTotal"]);
                $data[] = $tabla;
            }

            return $data;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los registros: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    public function editarEntrada()
    {
        // Consulta para llamar al stored procedure
        $query = "CALL editarEntradaMaterial(
            :idDetalleEntrada,
            :proveedor, 
            :factura, 
            :cantidadResma, 
            :pliegosResma, 
            :cantidadPliegos, 
            :precioPliego, 
            :descuento, 
            :tipoCambio
          )";

        try {
            self::getConexion();

            // Preparar la consulta
            $stmt = self::$cnx->prepare($query);

            // Depuración de los valores
            error_log("Proveedor: " . $this->proveedor); // Verifica que el valor de proveedor es correcto
            error_log("Factura: " . $this->factura); // Verifica que el valor de factura es correcto

            // Vincular los parámetros
            $stmt->bindParam(':idDetalleEntrada', $this->idDetalleEntrada);
            $stmt->bindParam(':proveedor', $this->proveedor);
            $stmt->bindParam(':factura', $this->factura);
            $stmt->bindParam(':cantidadResma', $this->cantidadResma);
            $stmt->bindParam(':pliegosResma', $this->pliegosResma);
            $stmt->bindParam(':cantidadPliegos', $this->cantidadPliegos);
            $stmt->bindParam(':precioPliego', $this->precioPliego);
            $stmt->bindParam(':descuento', $this->descuento);
            $stmt->bindParam(':tipoCambio', $this->tipoCambio);

            // Ejecutar la consulta
            $resultado = $stmt->execute();

            if (!$resultado) {
                $errorInfo = $stmt->errorInfo();
                error_log("Error en editarEntrada: " . implode(" | ", $errorInfo)); // <- Esto se verá en logs
            }

            return $resultado;
        } catch (PDOException $e) {
            error_log("Error en editarEntrada: " . $e->getMessage());  // Esto registra el error en el log
            throw new Exception("Error al editar la entrada: " . $e->getMessage());  // Aquí aún puedes lanzar la excepción para manejarla fuera
        } finally {
            self::desconectar();
        }
    }



    public function eliminarEntrada()
    {
        $query = "DELETE FROM detalleentrada WHERE idDetalleEntrada = :idDetalleEntrada";

        try {
            self::getConexion();

            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(':idDetalleEntrada', $this->idDetalleEntrada);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar la entrada: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }
}
