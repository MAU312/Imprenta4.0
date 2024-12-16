<?php
require_once '../config/Conexion.php';

class salidaMaterial extends Conexion
{
    protected static $cnx;
    private $idDetalleSalida;
    private $idMateriales;
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

    // Obtener detalles de salida por material
    public function obtenerDetallesPorMaterial($idMaterial)
    {
        // Query para obtener los detalles de salida del material
        $query = "SELECT * FROM detallesalida WHERE idMateriales = :idMaterial";

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

    // Método para insertar una nueva salida de material
    public function insertarSalida($idMateriales, $cliente, $corte, $produccion, $cantidadPliegos, $precioPliego, $tipoCambio)
    {
        // SQL para llamar al stored procedure
        $sql = "CALL agregarSalidaMaterial(?, ?, ?, ?, ?, ?, ?)";

        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($sql);

            // Vincular parámetros
            $stmt->bindParam(1, $idMateriales, PDO::PARAM_INT);
            $stmt->bindParam(2, $cliente, PDO::PARAM_STR);
            $stmt->bindParam(3, $corte, PDO::PARAM_STR);
            $stmt->bindParam(4, $produccion, PDO::PARAM_STR);
            $stmt->bindParam(5, $cantidadPliegos, PDO::PARAM_INT);
            $stmt->bindParam(6, $precioPliego, PDO::PARAM_STR);
            $stmt->bindParam(7, $tipoCambio, PDO::PARAM_STR);

            // Ejecutar el stored procedure
            if ($stmt->execute()) {
                return true; // Retorna true si la inserción fue exitosa
            } else {
                return false; // Si algo falla, retorna false
            }
        } catch (PDOException $e) {
            throw new Exception("Error al insertar la salida: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }
}
?>
