<?php
require_once '../config/Conexion.php';

class HorariosEmpleados extends Conexion
{
    protected static $cnx;
    private $nombre;
    private $periodo;
    private $diasTrabajados = []; // Array de días trabajados
    private $horasDeLlegada = []; // Array de horas de llegada
    private $horasDeSalida = [];  // Array de horas de salida

    // Getters y setters

    public function __construct()
    {
        parent::__construct();
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getPeriodo()
    {
        return $this->periodo;
    }

    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }

    public function getDiasTrabajados()
    {
        return $this->diasTrabajados;
    }

    public function setDiasTrabajados($diasTrabajados)
    {
        $this->diasTrabajados = $diasTrabajados;
    }

    public function getHorasDeLlegada()
    {
        return $this->horasDeLlegada;
    }

    public function setHorasDeLlegada($horasDeLlegada)
    {
        $this->horasDeLlegada = $horasDeLlegada;
    }

    public function getHorasDeSalida()
    {
        return $this->horasDeSalida;
    }

    public function setHorasDeSalida($horasDeSalida)
    {
        $this->horasDeSalida = $horasDeSalida;
    }

    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }

    public function agregar()
    {
        try {
            self::getConexion(); // Asegurar que la conexión esté activa

            // Insertar el empleado en la tabla principal
            $sql = "INSERT INTO horarios_empleados (nombre, periodo) VALUES (?, ?)";
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(1, $this->nombre);
            $stmt->bindParam(2, $this->periodo);
            $stmt->execute();

            // Obtener el ID del empleado insertado
            $empleado_id = self::$cnx->lastInsertId();

            // Insertar los días trabajados y las horas en una tabla relacionada
            foreach ($this->diasTrabajados as $index => $dia) {
                $horaLlegada = $this->horasDeLlegada[$index];
                $horaSalida = $this->horasDeSalida[$index];

                $sql = "INSERT INTO dias_trabajados (empleado_id, dia, hora_llegada, hora_salida) VALUES (?, ?, ?, ?)";
                $stmt = self::$cnx->prepare($sql);
                $stmt->bindParam(1, $empleado_id);
                $stmt->bindParam(2, $dia);
                $stmt->bindParam(3, $horaLlegada);
                $stmt->bindParam(4, $horaSalida);
                $stmt->execute();
            }

            return true; // Éxito
        } catch (Exception $e) {
            throw $e; // Lanzar la excepción para manejarla en el controlador
        } finally {
            self::desconectar(); // Cerrar la conexión
        }
    }

    public function buscarPorPeriodo()
    {
        try {
            self::getConexion(); // Asegurar que la conexión esté activa

            $sql = "SELECT e.nombre, e.periodo, d.dia, d.hora_llegada, d.hora_salida FROM horarios_empleados e JOIN dias_trabajados d ON e.id = d.empleado_id WHERE e.periodo = ?";
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(1, $this->periodo);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            throw $e; // Lanzar la excepción para manejarla en el controlador
        } finally {
            self::desconectar(); // Cerrar la conexión
        }
    }
}
?>