<?php
require_once '../config/Conexion.php';

class Empleado extends Conexion
{
    protected static $cnx;
    private $identificacion;
    private $numero_asegurado;
    private $nombre;
    private $primer_apellido;
    private $segundo_apellido;
    private $fecha_nacimiento;
    private $edad;
    private $telefono1;
    private $correo;
    private $sexo;
    private $estado_civil;
    private $lugar_nacimiento;
    private $nacionalidad;
    private $direccion_domicilio;
    private $telefono2;
    private $nombre_contacto1;
    private $parentesco_contacto1;
    private $telefono_contacto1;
    private $direccion_contacto1;
    private $nombre_contacto2;
    private $parentesco_contacto2;
    private $telefono_contacto2;
    private $direccion_contacto2;
    private $tipo_sangre;
    private $padecimientos;
    private $discapacidades;
    private $intervenciones;
    private $uso_aparatos;
    private $medicamentos;
    private $dosificacion;
    private $frecuencia;
    private $proposito;
    private $fecha_ingreso;
    private $jefe_supervisor;
    private $puesto_actual;
    private $ultimo_grado_estudio;

    // Getters y Setters
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;
    }

    public function getNumeroAsegurado()
    {
        return $this->numero_asegurado;
    }

    public function setNumeroAsegurado($numero_asegurado)
    {
        $this->numero_asegurado = $numero_asegurado;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getPrimerApellido()
    {
        return $this->primer_apellido;
    }

    public function setPrimerApellido($primer_apellido)
    {
        $this->primer_apellido = $primer_apellido;
    }

    public function getSegundoApellido()
    {
        return $this->segundo_apellido;
    }

    public function setSegundoApellido($segundo_apellido)
    {
        $this->segundo_apellido = $segundo_apellido;
    }

    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento($fecha_nacimiento)
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    public function getEdad()
    {
        return $this->edad;
    }

    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    public function getTelefono1()
    {
        return $this->telefono1;
    }

    public function setTelefono1($telefono1)
    {
        $this->telefono1 = $telefono1;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getEstadoCivil()
    {
        return $this->estado_civil;
    }

    public function setEstadoCivil($estado_civil)
    {
        $this->estado_civil = $estado_civil;
    }

    public function getLugarNacimiento()
    {
        return $this->lugar_nacimiento;
    }

    public function setLugarNacimiento($lugar_nacimiento)
    {
        $this->lugar_nacimiento = $lugar_nacimiento;
    }

    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;
    }

    public function getDireccionDomicilio()
    {
        return $this->direccion_domicilio;
    }

    public function setDireccionDomicilio($direccion_domicilio)
    {
        $this->direccion_domicilio = $direccion_domicilio;
    }

    public function getTelefono2()
    {
        return $this->telefono2;
    }

    public function setTelefono2($telefono2)
    {
        $this->telefono2 = $telefono2;
    }

    public function getNombreContacto1()
    {
        return $this->nombre_contacto1;
    }

    public function setNombreContacto1($nombre_contacto1)
    {
        $this->nombre_contacto1 = $nombre_contacto1;
    }

    public function getParentescoContacto1()
    {
        return $this->parentesco_contacto1;
    }

    public function setParentescoContacto1($parentesco_contacto1)
    {
        $this->parentesco_contacto1 = $parentesco_contacto1;
    }

    public function getTelefonoContacto1()
    {
        return $this->telefono_contacto1;
    }

    public function setTelefonoContacto1($telefono_contacto1)
    {
        $this->telefono_contacto1 = $telefono_contacto1;
    }

    public function getDireccionContacto1()
    {
        return $this->direccion_contacto1;
    }

    public function setDireccionContacto1($direccion_contacto1)
    {
        $this->direccion_contacto1 = $direccion_contacto1;
    }

    public function getNombreContacto2()
    {
        return $this->nombre_contacto2;
    }

    public function setNombreContacto2($nombre_contacto2)
    {
        $this->nombre_contacto2 = $nombre_contacto2;
    }

    public function getParentescoContacto2()
    {
        return $this->parentesco_contacto2;
    }

    public function setParentescoContacto2($parentesco_contacto2)
    {
        $this->parentesco_contacto2 = $parentesco_contacto2;
    }

    public function getTelefonoContacto2()
    {
        return $this->telefono_contacto2;
    }

    public function setTelefonoContacto2($telefono_contacto2)
    {
        $this->telefono_contacto2 = $telefono_contacto2;
    }

    public function getDireccionContacto2()
    {
        return $this->direccion_contacto2;
    }

    public function setDireccionContacto2($direccion_contacto2)
    {
        $this->direccion_contacto2 = $direccion_contacto2;
    }

    // Getters y Setters

    public function getTipoSangre()
    {
        return $this->tipo_sangre;
    }

    public function setTipoSangre($tipo_sangre)
    {
        $this->tipo_sangre = $tipo_sangre;
    }

    public function getPadecimientos()
    {
        return $this->padecimientos;
    }

    public function setPadecimientos($padecimientos)
    {
        $this->padecimientos = $padecimientos;
    }

    public function getDiscapacidades()
    {
        return $this->discapacidades;
    }

    public function setDiscapacidades($discapacidades)
    {
        $this->discapacidades = $discapacidades;
    }

    public function getIntervenciones()
    {
        return $this->intervenciones;
    }

    public function setIntervenciones($intervenciones)
    {
        $this->intervenciones = $intervenciones;
    }

    public function getUsoAparatos()
    {
        return $this->uso_aparatos;
    }

    public function setUsoAparatos($uso_aparatos)
    {
        $this->uso_aparatos = $uso_aparatos;
    }

    public function getMedicamentos()
    {
        return $this->medicamentos;
    }

    public function setMedicamentos($medicamentos)
    {
        $this->medicamentos = $medicamentos;
    }

    public function getDosificacion()
    {
        return $this->dosificacion;
    }

    public function setDosificacion($dosificacion)
    {
        $this->dosificacion = $dosificacion;
    }

    public function getFrecuencia()
    {
        return $this->frecuencia;
    }

    public function setFrecuencia($frecuencia)
    {
        $this->frecuencia = $frecuencia;
    }

    public function getProposito()
    {
        return $this->proposito;
    }

    public function setProposito($proposito)
    {
        $this->proposito = $proposito;
    }

    public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }

    public function setFechaIngreso($fecha_ingreso)
    {
        $this->fecha_ingreso = $fecha_ingreso;
    }

    public function getJefeSupervisor()
    {
        return $this->jefe_supervisor;
    }

    public function setJefeSupervisor($jefe_supervisor)
    {
        $this->jefe_supervisor = $jefe_supervisor;
    }

    public function getPuestoActual()
    {
        return $this->puesto_actual;
    }

    public function setPuestoActual($puesto_actual)
    {
        $this->puesto_actual = $puesto_actual;
    }

    public function getUltimoGradoEstudio()
    {
        return $this->ultimo_grado_estudio;
    }

    public function setUltimoGradoEstudio($ultimo_grado_estudio)
    {
        $this->ultimo_grado_estudio = $ultimo_grado_estudio;
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
        $query = "SELECT 
        id, identificacion, numero_asegurado, nombre, primer_apellido, segundo_apellido,
        fecha_nacimiento, edad, telefono1, correo, sexo, estado_civil, lugar_nacimiento, nacionalidad, direccion_domicilio,
        telefono2, nombre_contacto1, parentesco_contacto1, telefono_contacto1, direccion_contacto1, nombre_contacto2,
        parentesco_contacto2, telefono_contacto2, direccion_contacto2, tipo_sangre, padecimientos, discapacidades, intervenciones,
        uso_aparatos, medicamentos, dosificacion, frecuencia, proposito, fecha_ingreso, jefe_supervisor, puesto_actual, ultimo_grado_estudio
    FROM empleados;";

        try {
            self::getConexion();

            $resultado = self::$cnx->prepare($query);
            $resultado->execute();
            $filas = $resultado->fetchAll(PDO::FETCH_ASSOC);

            $data = array();
            foreach ($filas as $fila) {
                $tabla = new self();
                $tabla->setIdentificacion($fila["identificacion"]);
                $tabla->setNumeroAsegurado($fila["numero_asegurado"]);
                $tabla->setNombre($fila["nombre"]);
                $tabla->setPrimerApellido($fila["primer_apellido"]);
                $tabla->setSegundoApellido($fila["segundo_apellido"]);
                $tabla->setFechaNacimiento($fila["fecha_nacimiento"]);
                $tabla->setEdad($fila["edad"]);
                $tabla->setTelefono1($fila["telefono1"]);
                $tabla->setCorreo($fila["correo"]);
                $tabla->setSexo($fila["sexo"]);
                $tabla->setEstadoCivil($fila["estado_civil"]);
                $tabla->setLugarNacimiento($fila["lugar_nacimiento"]);
                $tabla->setNacionalidad($fila["nacionalidad"]);
                $tabla->setDireccionDomicilio($fila["direccion_domicilio"]);
                $tabla->setTelefono2($fila["telefono2"]);
                $tabla->setNombreContacto1($fila["nombre_contacto1"]);
                $tabla->setParentescoContacto1($fila["parentesco_contacto1"]);
                $tabla->setTelefonoContacto1($fila["telefono_contacto1"]);
                $tabla->setDireccionContacto1($fila["direccion_contacto1"]);
                $tabla->setNombreContacto2($fila["nombre_contacto2"]);
                $tabla->setParentescoContacto2($fila["parentesco_contacto2"]);
                $tabla->setTelefonoContacto2($fila["telefono_contacto2"]);
                $tabla->setDireccionContacto2($fila["direccion_contacto2"]);
                $tabla->setTipoSangre($fila["tipo_sangre"]);
                $tabla->setPadecimientos($fila["padecimientos"]);
                $tabla->setDiscapacidades($fila["discapacidades"]);
                $tabla->setIntervenciones($fila["intervenciones"]);
                $tabla->setUsoAparatos($fila["uso_aparatos"]);
                $tabla->setMedicamentos($fila["medicamentos"]);
                $tabla->setDosificacion($fila["dosificacion"]);
                $tabla->setFrecuencia($fila["frecuencia"]);
                $tabla->setProposito($fila["proposito"]);
                $tabla->setFechaIngreso($fila["fecha_ingreso"]);
                $tabla->setJefeSupervisor($fila["jefe_supervisor"]);
                $tabla->setPuestoActual($fila["puesto_actual"]);
                $tabla->setUltimoGradoEstudio($fila["ultimo_grado_estudio"]);
                $data[] = $tabla;
            }

            return $data;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los empleados: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    public function agregar()
    {
        $query = "INSERT INTO empleados (
                identificacion, numero_asegurado, nombre, primer_apellido, segundo_apellido,
                fecha_nacimiento, edad, telefono1, correo, sexo, estado_civil, lugar_nacimiento,
                nacionalidad, direccion_domicilio, telefono2, nombre_contacto1, parentesco_contacto1,
                telefono_contacto1, direccion_contacto1, nombre_contacto2, parentesco_contacto2,
                telefono_contacto2, direccion_contacto2, tipo_sangre, padecimientos, discapacidades,
                intervenciones, uso_aparatos, medicamentos, dosificacion, frecuencia, proposito,
                fecha_ingreso, jefe_supervisor, puesto_actual, ultimo_grado_estudio
              ) VALUES (
                :identificacion, :numero_asegurado, :nombre, :primer_apellido, :segundo_apellido,
                :fecha_nacimiento, :edad, :telefono1, :correo, :sexo, :estado_civil, :lugar_nacimiento,
                :nacionalidad, :direccion_domicilio, :telefono2, :nombre_contacto1, :parentesco_contacto1,
                :telefono_contacto1, :direccion_contacto1, :nombre_contacto2, :parentesco_contacto2,
                :telefono_contacto2, :direccion_contacto2, :tipo_sangre, :padecimientos, :discapacidades,
                :intervenciones, :uso_aparatos, :medicamentos, :dosificacion, :frecuencia, :proposito,
                :fecha_ingreso, :jefe_supervisor, :puesto_actual, :ultimo_grado_estudio
              )";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);

            $resultado->execute([
                ':identificacion' => $this->identificacion,
                ':numero_asegurado' => $this->numero_asegurado,
                ':nombre' => $this->nombre,
                ':primer_apellido' => $this->primer_apellido,
                ':segundo_apellido' => $this->segundo_apellido,
                ':fecha_nacimiento' => $this->fecha_nacimiento,
                ':edad' => $this->edad,
                ':telefono1' => $this->telefono1,
                ':correo' => $this->correo,
                ':sexo' => $this->sexo,
                ':estado_civil' => $this->estado_civil,
                ':lugar_nacimiento' => $this->lugar_nacimiento,
                ':nacionalidad' => $this->nacionalidad,
                ':direccion_domicilio' => $this->direccion_domicilio,
                ':telefono2' => $this->telefono2,
                ':nombre_contacto1' => $this->nombre_contacto1,
                ':parentesco_contacto1' => $this->parentesco_contacto1,
                ':telefono_contacto1' => $this->telefono_contacto1,
                ':direccion_contacto1' => $this->direccion_contacto1,
                ':nombre_contacto2' => $this->nombre_contacto2,
                ':parentesco_contacto2' => $this->parentesco_contacto2,
                ':telefono_contacto2' => $this->telefono_contacto2,
                ':direccion_contacto2' => $this->direccion_contacto2,
                ':tipo_sangre' => $this->tipo_sangre,
                ':padecimientos' => $this->padecimientos,
                ':discapacidades' => $this->discapacidades,
                ':intervenciones' => $this->intervenciones,
                ':uso_aparatos' => $this->uso_aparatos,
                ':medicamentos' => $this->medicamentos,
                ':dosificacion' => $this->dosificacion,
                ':frecuencia' => $this->frecuencia,
                ':proposito' => $this->proposito,
                ':fecha_ingreso' => $this->fecha_ingreso,
                ':jefe_supervisor' => $this->jefe_supervisor,
                ':puesto_actual' => $this->puesto_actual,
                ':ultimo_grado_estudio' => $this->ultimo_grado_estudio
            ]);


            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al agregar el empleado: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    public function editar()
    {
        $query = "UPDATE empleados SET
                numero_asegurado = :numero_asegurado,
                nombre = :nombre,
                primer_apellido = :primer_apellido,
                segundo_apellido = :segundo_apellido,
                fecha_nacimiento = :fecha_nacimiento,
                edad = :edad,
                telefono1 = :telefono1,
                correo = :correo,
                sexo = :sexo,
                estado_civil = :estado_civil,
                lugar_nacimiento = :lugar_nacimiento,
                nacionalidad = :nacionalidad,
                direccion_domicilio = :direccion_domicilio,
                telefono2 = :telefono2,
                nombre_contacto1 = :nombre_contacto1,
                parentesco_contacto1 = :parentesco_contacto1,
                telefono_contacto1 = :telefono_contacto1,
                direccion_contacto1 = :direccion_contacto1,
                nombre_contacto2 = :nombre_contacto2,
                parentesco_contacto2 = :parentesco_contacto2,
                telefono_contacto2 = :telefono_contacto2,
                direccion_contacto2 = :direccion_contacto2,
                tipo_sangre = :tipo_sangre,
                padecimientos = :padecimientos,
                discapacidades = :discapacidades,
                intervenciones = :intervenciones,
                uso_aparatos = :uso_aparatos,
                medicamentos = :medicamentos,
                dosificacion = :dosificacion,
                frecuencia = :frecuencia,
                proposito = :proposito,
                fecha_ingreso = :fecha_ingreso,
                jefe_supervisor = :jefe_supervisor,
                puesto_actual = :puesto_actual,
                ultimo_grado_estudio = :ultimo_grado_estudio
              WHERE identificacion = :identificacion";

        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);

            $resultado->execute([
                ':numero_asegurado' => $this->numero_asegurado,
                ':nombre' => $this->nombre,
                ':primer_apellido' => $this->primer_apellido,
                ':segundo_apellido' => $this->segundo_apellido,
                ':fecha_nacimiento' => $this->fecha_nacimiento,
                ':edad' => $this->edad,
                ':telefono1' => $this->telefono1,
                ':correo' => $this->correo,
                ':sexo' => $this->sexo,
                ':estado_civil' => $this->estado_civil,
                ':lugar_nacimiento' => $this->lugar_nacimiento,
                ':nacionalidad' => $this->nacionalidad,
                ':direccion_domicilio' => $this->direccion_domicilio,
                ':telefono2' => $this->telefono2,
                ':nombre_contacto1' => $this->nombre_contacto1,
                ':parentesco_contacto1' => $this->parentesco_contacto1,
                ':telefono_contacto1' => $this->telefono_contacto1,
                ':direccion_contacto1' => $this->direccion_contacto1,
                ':nombre_contacto2' => $this->nombre_contacto2,
                ':parentesco_contacto2' => $this->parentesco_contacto2,
                ':telefono_contacto2' => $this->telefono_contacto2,
                ':direccion_contacto2' => $this->direccion_contacto2,
                ':tipo_sangre' => $this->tipo_sangre,
                ':padecimientos' => $this->padecimientos,
                ':discapacidades' => $this->discapacidades,
                ':intervenciones' => $this->intervenciones,
                ':uso_aparatos' => $this->uso_aparatos,
                ':medicamentos' => $this->medicamentos,
                ':dosificacion' => $this->dosificacion,
                ':frecuencia' => $this->frecuencia,
                ':proposito' => $this->proposito,
                ':fecha_ingreso' => $this->fecha_ingreso,
                ':jefe_supervisor' => $this->jefe_supervisor,
                ':puesto_actual' => $this->puesto_actual,
                ':ultimo_grado_estudio' => $this->ultimo_grado_estudio,
                ':identificacion' => $this->identificacion
            ]);

            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al editar el empleado: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    public function verificar()
    {
        $query = "SELECT COUNT(*) as total FROM empleados WHERE identificacion = :identificacion";
        try {
            self::getConexion();
            $resultado = self::$cnx->prepare($query);
            $resultado->execute([":identificacion" => $this->identificacion]);
            $fila = $resultado->fetch(PDO::FETCH_ASSOC);
            return $fila['total'] > 0;
        } catch (PDOException $e) {
            throw new Exception("Error al verificar el empleado: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    public function obtenerDetalles($identificacion)
    {
        $query = "SELECT * FROM empleados WHERE identificacion = :identificacion";

        try {
            self::getConexion();
            $stmt = self::$cnx->prepare($query);
            $stmt->bindParam(':identificacion', $identificacion, PDO::PARAM_STR);
            $stmt->execute();

            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $empleado;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los detalles del empleado: " . $e->getMessage());
        } finally {
            self::desconectar();
        }
    }

    public function eliminar($identificacion)
    {
        try {
            self::getConexion();
            $sql = "DELETE FROM empleados WHERE identificacion = :identificacion";
            $stmt = self::$cnx->prepare($sql);
            $stmt->bindParam(':identificacion', $identificacion, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Error al eliminar empleado: " . $e->getMessage());
        }
    }
}
