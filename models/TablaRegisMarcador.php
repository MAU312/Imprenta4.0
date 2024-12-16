<?php
require_once '../config/Conexion.php';

class TablaRegisMarcador extends Conexion
{
    protected static $cnx;
    private $idMarcador;
    private $colaborador;
    private $viernes_entrada;
    private $viernes_salida;
    private $lunes_entrada;
    private $lunes_salida;
    private $martes_entrada;
    private $martes_salida;
    private $miercoles_entrada;
    private $miercoles_salida;
    private $jueves_entrada;
    private $jueves_salida;
    private $sabado_entrada;
    private $sabado_salida;
    private $debe_horas;

    // Constructor vacío
    public function __construct() {}

    // Getters y Setters
    public function getId()
    {
        return $this->idMarcador;
    }
    public function setId($id)
    {
        $this->id = $idMarcador;
    }

    public function getColaborador()
    {
        return $this->colaborador;
    }
    public function setColaborador($colaborador)
    {
        $this->colaborador = $colaborador;
    }

    public function getViernesEntrada()
    {
        return $this->viernes_entrada;
    }
    public function setViernesEntrada($viernes_entrada)
    {
        $this->viernes_entrada = $viernes_entrada;
    }

    public function getViernesSalida()
    {
        return $this->viernes_salida;
    }
    public function setViernesSalida($viernes_salida)
    {
        $this->viernes_salida = $viernes_salida;
    }

    public function getLunesEntrada()
    {
        return $this->lunes_entrada;
    }
    public function setLunesEntrada($lunes_entrada)
    {
        $this->lunes_entrada = $lunes_entrada;
    }

    public function getLunesSalida()
    {
        return $this->lunes_salida;
    }
    public function setLunesSalida($lunes_salida)
    {
        $this->lunes_salida = $lunes_salida;
    }

    public function getMartesEntrada()
    {
        return $this->martes_entrada;
    }
    public function setMartesEntrada($martes_entrada)
    {
        $this->martes_entrada = $martes_entrada;
    }

    public function getMartesSalida()
    {
        return $this->martes_salida;
    }
    public function setMartesSalida($martes_salida)
    {
        $this->martes_salida = $martes_salida;
    }

    public function getMiercolesEntrada()
    {
        return $this->miercoles_entrada;
    }
    public function setMiercolesEntrada($miercoles_entrada)
    {
        $this->miercoles_entrada = $miercoles_entrada;
    }

    public function getMiercolesSalida()
    {
        return $this->miercoles_salida;
    }
    public function setMiercolesSalida($miercoles_salida)
    {
        $this->miercoles_salida = $miercoles_salida;
    }

    public function getJuevesEntrada()
    {
        return $this->jueves_entrada;
    }
    public function setJuevesEntrada($jueves_entrada)
    {
        $this->jueves_entrada = $jueves_entrada;
    }

    public function getJuevesSalida()
    {
        return $this->jueves_salida;
    }
    public function setJuevesSalida($jueves_salida)
    {
        $this->jueves_salida = $jueves_salida;
    }

    public function getSabadoEntrada()
    {
        return $this->sabado_entrada;
    }
    public function setSabadoEntrada($sabado_entrada)
    {
        $this->sabado_entrada = $sabado_entrada;
    }

    public function getSabadoSalida()
    {
        return $this->sabado_salida;
    }
    public function setSabadoSalida($sabado_salida)
    {
        $this->sabado_salida = $sabado_salida;
    }

    public function getDebeHoras()
    {
        return $this->debe_horas;
    }
    public function setDebeHoras($debe_horas)
    {
        $this->debe_horas = $debe_horas;
    }

    // Métodos de conexión
    public static function getConexion()
    {
        self::$cnx = Conexion::conectar();
    }

    public static function desconectar()
    {
        self::$cnx = null;
    }

    // Método para listar los registros
    public function listar()
    {
        $query = "SELECT * FROM RegistroMarcador";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            $filas = $resultado->fetchAll();

            $data = array();
            foreach ($filas as $fila) {
                $horario = new self();
                $horario->setId($fila["idMarcador"]);
                $horario->setColaborador($fila["colaborador"]);
                $horario->setViernesEntrada($fila["viernes_entrada"]);
                $horario->setViernesSalida($fila["viernes_salida"]);
                $horario->setLunesEntrada($fila["lunes_entrada"]);
                $horario->setLunesSalida($fila["lunes_salida"]);
                $horario->setMartesEntrada($fila["martes_entrada"]);
                $horario->setMartesSalida($fila["martes_salida"]);
                $horario->setMiercolesEntrada($fila["miercoles_entrada"]);
                $horario->setMiercolesSalida($fila["miercoles_salida"]);
                $horario->setJuevesEntrada($fila["jueves_entrada"]);
                $horario->setJuevesSalida($fila["jueves_salida"]);
                $horario->setSabadoEntrada($fila["sabado_entrada"]);
                $horario->setSabadoSalida($fila["sabado_salida"]);
                $horario->setDebeHoras($fila["debe_horas"]);
                $data[] = $horario;
            }

            return $data;
        } catch (PDOException $e) {
            throw new Exception("Error al listar horarios detallados: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    // Método para agregar un registro
    public function agregar()
    {
        $query = "INSERT INTO RegistroMarcador 
                  (colaborador, viernes_entrada, viernes_salida, lunes_entrada, lunes_salida, martes_entrada, martes_salida, miercoles_entrada, miercoles_salida, jueves_entrada, jueves_salida, sabado_entrada, sabado_salida, debe_horas) 
                  VALUES 
                  (:colaborador, :viernes_entrada, :viernes_salida, :lunes_entrada, :lunes_salida, :martes_entrada, :martes_salida, :miercoles_entrada, :miercoles_salida, :jueves_entrada, :jueves_salida, :sabado_entrada, :sabado_salida, :debe_horas)";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":colaborador", $this->colaborador);
            $resultado->bindParam(":viernes_entrada", $this->viernes_entrada);
            $resultado->bindParam(":viernes_salida", $this->viernes_salida);
            $resultado->bindParam(":lunes_entrada", $this->lunes_entrada);
            $resultado->bindParam(":lunes_salida", $this->lunes_salida);
            $resultado->bindParam(":martes_entrada", $this->martes_entrada);
            $resultado->bindParam(":martes_salida", $this->martes_salida);
            $resultado->bindParam(":miercoles_entrada", $this->miercoles_entrada);
            $resultado->bindParam(":miercoles_salida", $this->miercoles_salida);
            $resultado->bindParam(":jueves_entrada", $this->jueves_entrada);
            $resultado->bindParam(":jueves_salida", $this->jueves_salida);
            $resultado->bindParam(":sabado_entrada", $this->sabado_entrada);
            $resultado->bindParam(":sabado_salida", $this->sabado_salida);
            $resultado->bindParam(":debe_horas", $this->debe_horas);

            $resultado->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al agregar el horario detallado: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    public function actualizar()
    {
        $query = "UPDATE RegistroMarcador SET 
                    colaborador = :colaborador,
                    viernes_entrada = :viernes_entrada,
                    viernes_salida = :viernes_salida,
                    lunes_entrada = :lunes_entrada,
                    lunes_salida = :lunes_salida,
                    martes_entrada = :martes_entrada,
                    martes_salida = :martes_salida,
                    miercoles_entrada = :miercoles_entrada,
                    miercoles_salida = :miercoles_salida,
                    jueves_entrada = :jueves_entrada,
                    jueves_salida = :jueves_salida,
                    sabado_entrada = :sabado_entrada,
                    sabado_salida = :sabado_salida,
                    debe_horas = :debe_horas
                  WHERE idMarcador = :idMarcador";
    
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":colaborador", $this->colaborador);
            $resultado->bindParam(":viernes_entrada", $this->viernes_entrada);
            $resultado->bindParam(":viernes_salida", $this->viernes_salida);
            $resultado->bindParam(":lunes_entrada", $this->lunes_entrada);
            $resultado->bindParam(":lunes_salida", $this->lunes_salida);
            $resultado->bindParam(":martes_entrada", $this->martes_entrada);
            $resultado->bindParam(":martes_salida", $this->martes_salida);
            $resultado->bindParam(":miercoles_entrada", $this->miercoles_entrada);
            $resultado->bindParam(":miercoles_salida", $this->miercoles_salida);
            $resultado->bindParam(":jueves_entrada", $this->jueves_entrada);
            $resultado->bindParam(":jueves_salida", $this->jueves_salida);
            $resultado->bindParam(":sabado_entrada", $this->sabado_entrada);
            $resultado->bindParam(":sabado_salida", $this->sabado_salida);
            $resultado->bindParam(":debe_horas", $this->debe_horas);
            $resultado->bindParam(":idMarcador", $this->idMarcador);
    
            $resultado->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar el horario detallado: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }
    
    public function eliminar()
    {
        $query = "DELETE FROM RegistroMarcador WHERE idMarcador = :idMarcador";
    
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idMarcador", $this->idMarcador);
    
            $resultado->execute();
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar el horario detallado: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }
    
    public function obtenerPorId($idMarcador)
    {
        $query = "SELECT * FROM RegistroMarcador WHERE idMarcador = :idMarcador";
    
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->bindParam(":idMarcador", $idMarcador);
            $resultado->execute();
            $fila = $resultado->fetch();
    
            if ($fila) {
                $this->setId($fila["idMarcador"]);
                $this->setColaborador($fila["colaborador"]);
                $this->setViernesEntrada($fila["viernes_entrada"]);
                $this->setViernesSalida($fila["viernes_salida"]);
                $this->setLunesEntrada($fila["lunes_entrada"]);
                $this->setLunesSalida($fila["lunes_salida"]);
                $this->setMartesEntrada($fila["martes_entrada"]);
                $this->setMartesSalida($fila["martes_salida"]);
                $this->setMiercolesEntrada($fila["miercoles_entrada"]);
                $this->setMiercolesSalida($fila["miercoles_salida"]);
                $this->setJuevesEntrada($fila["jueves_entrada"]);
                $this->setJuevesSalida($fila["jueves_salida"]);
                $this->setSabadoEntrada($fila["sabado_entrada"]);
                $this->setSabadoSalida($fila["sabado_salida"]);
                $this->setDebeHoras($fila["debe_horas"]);
                return $this;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new Exception("Error al obtener el horario detallado: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }
    

}

