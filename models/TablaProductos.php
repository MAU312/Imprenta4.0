<?php
require_once '../config/Conexion.php';

class TablaProductos extends Conexion
{
    protected static $cnx;
    private $idMateriales;
    private $Material;
    private $Cantidad_Inventario;
    private $Valor_Inventario;

    // Getters y setters

    public function __construct() {}

    public function getIdMateriales()
    {
        return $this->idMateriales;
    }
    public function setIdMateriales($idMateriales)
    {
        $this->idMateriales = $idMateriales;
    }
    public function getMaterial()
    {
        return $this->Material;
    }
    public function setMaterial($Material)
    {
        $this->Material = $Material;
    }
    public function getCantidad_Inventario()
    {
        return $this->Cantidad_Inventario;
    }
    public function setCantidad_Inventario($Cantidad_Inventario)
    {
        $this->Cantidad_Inventario = $Cantidad_Inventario;
    }
    public function getValor_Inventario()
    {
        return $this->Valor_Inventario;
    }
    public function setValor_Inventario($Valor_Inventario)
    {
        $this->Valor_Inventario = $Valor_Inventario;
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
        $query = "CALL listarMateriales()";

        try {
            // Intentamos conectar dentro del bloque try para capturar cualquier fallo en la conexión
            self::getConexion();

            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            $filas = $resultado->fetchAll();

            $data = array();
            foreach ($filas as $fila) {
                $tabla = new self();  // Asumiendo que esta clase tiene setters para cada atributo
                $tabla->setIdMateriales($fila["idMaterial"]);
                $tabla->setMaterial($fila["nombreMaterial"]);
                $tabla->setCantidad_Inventario($fila["cantidadDisponible"]);
                $tabla->setValor_Inventario($fila["valorInventario"]);
                $data[] = $tabla;
            }

            return $data;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los registros: " . $e->getMessage());
        } finally {
            // Aseguramos la desconexión al final de la ejecución
            self::desconectar();
        }
    }

    public function insertarMaterial($nombreMaterial, $cantidadDisponible, $valorInventario)
    {
        $query = "CALL insertarMaterial(:nombreMaterialre, :cantidadDisponible, :valorInventario)";

        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(':nombreMaterialre', $nombreMaterial);
            $stmt->bindParam(':cantidadDisponible', $cantidadDisponible);
            $stmt->bindParam(':valorInventario', $valorInventario);

            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Error al insertar el material: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }
}

