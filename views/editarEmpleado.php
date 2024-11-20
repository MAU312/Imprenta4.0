<?php
require_once '../models/Empleado.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<script>alert('Identificación no válida.'); window.location.href='listaEmpleados.php';</script>";
    exit;
}
$empleado = new Empleado();
$empleado->setIdentificacion($id);
$data = $empleado->listar();
$empleadoData = $data[0];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-center mb-6 text-blue-700">Editar Empleado</h1>
        <form action="../controllers/EmpleadosController.php?op=agregar" method="POST"
            class="bg-white shadow-md rounded-lg p-6 mt-6 w-full max-w-3xl">
            <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="identificacion" class="block font-medium text-gray-700">Identificación:</label>
                <input type="text" name="identificacion" id="identificacion" value="<?= $empleadoData->getIdentificacion(); ?>" readonly
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>


            <div>
                <label for="numero_asegurado" class="block font-medium text-gray-700">Número Asegurado:</label>
                <input type="text" name="numero_asegurado" id="numero_asegurado" value="<?= $empleadoData->getNumeroAsegurado(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="nombre" class="block font-medium text-gray-700">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?= $empleadoData->getNombre(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="primer_apellido" class="block font-medium text-gray-700">Primer Apellido:</label>
                <input type="text" name="primer_apellido" id="primer_apellido" value="<?= $empleadoData->getPrimerApellido(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="segundo_apellido" class="block font-medium text-gray-700">Segundo Apellido:</label>
                <input type="text" name="segundo_apellido" id="segundo_apellido" value="<?= $empleadoData->getSegundoApellido(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="fecha_nacimiento" class="block font-medium text-gray-700">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $empleadoData->getFechaNacimiento(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="edad" class="block font-medium text-gray-700">Edad:</label>
                <input type="number" name="edad" id="edad" value="<?= $empleadoData->getEdad(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="telefono1" class="block font-medium text-gray-700">Teléfono 1:</label>
                <input type="text" name="telefono1" id="telefono1" value="<?= $empleadoData->getTelefono1(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="correo" class="block font-medium text-gray-700">Correo Electrónico:</label>
                <input type="email" name="correo" id="correo" value="<?= $empleadoData->getCorreo(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="sexo" class="block font-medium text-gray-700">Sexo:</label>
                <input type="text" name="sexo" id="sexo" value="<?= $empleadoData->getSexo(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="estado_civil" class="block font-medium text-gray-700">Estado Civil:</label>
                <input type="text" name="estado_civil" id="estado_civil" value="<?= $empleadoData->getEstadoCivil(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="lugar_nacimiento" class="block font-medium text-gray-700">Lugar de Nacimiento:</label>
                <input type="text" name="lugar_nacimiento" id="lugar_nacimiento" value="<?= $empleadoData->getLugarNacimiento(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="nacionalidad" class="block font-medium text-gray-700">Nacionalidad:</label>
                <input type="text" name="nacionalidad" id="nacionalidad" value="<?= $empleadoData->getNacionalidad(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="direccion_domicilio" class="block font-medium text-gray-700">Dirección Domicilio:</label>
                <input type="text" name="direccion_domicilio" id="direccion_domicilio" value="<?= $empleadoData->getDireccionDomicilio(); ?>" required
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="telefono2" class="block font-medium text-gray-700">Teléfono 2:</label>
                <input type="text" name="telefono2" id="telefono2" value="<?= $empleadoData->getTelefono2(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="nombre_contacto1" class="block font-medium text-gray-700">Nombre Contacto 1:</label>
                <input type="text" name="nombre_contacto1" id="nombre_contacto1" value="<?= $empleadoData->getNombreContacto1(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="parentesco_contacto1" class="block font-medium text-gray-700">Parentesco Contacto 1:</label>
                <input type="text" name="parentesco_contacto1" id="parentesco_contacto1" value="<?= $empleadoData->getParentescoContacto1(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="telefono_contacto1" class="block font-medium text-gray-700">Teléfono Contacto 1:</label>
                <input type="text" name="telefono_contacto1" id="telefono_contacto1" value="<?= $empleadoData->getTelefonoContacto1(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="direccion_contacto1" class="block font-medium text-gray-700">Dirección Contacto 1:</label>
                <input type="text" name="direccion_contacto1" id="direccion_contacto1" value="<?= $empleadoData->getDireccionContacto1(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="nombre_contacto2" class="block font-medium text-gray-700">Nombre Contacto 2:</label>
                <input type="text" name="nombre_contacto2" id="nombre_contacto2" value="<?= $empleadoData->getNombreContacto2(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="parentesco_contacto2" class="block font-medium text-gray-700">Parentesco Contacto 2:</label>
                <input type="text" name="parentesco_contacto2" id="parentesco_contacto2" value="<?= $empleadoData->getParentescoContacto2(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="telefono_contacto2" class="block font-medium text-gray-700">Teléfono Contacto 2:</label>
                <input type="text" name="telefono_contacto2" id="telefono_contacto2" value="<?= $empleadoData->getTelefonoContacto2(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="direccion_contacto2" class="block font-medium text-gray-700">Dirección Contacto 2:</label>
                <input type="text" name="direccion_contacto2" id="direccion_contacto2" value="<?= $empleadoData->getDireccionContacto2(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="tipo_sangre" class="block font-medium text-gray-700">Tipo de Sangre:</label>
                <input type="text" name="tipo_sangre" id="tipo_sangre" value="<?= $empleadoData->getTipoSangre(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="padecimientos" class="block font-medium text-gray-700">Padecimientos:</label>
                <textarea name="padecimientos" id="padecimientos" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"><?= $empleadoData->getPadecimientos(); ?></textarea>
            </div>

            <div>
                <label for="discapacidades" class="block font-medium text-gray-700">Discapacidades:</label>
                <textarea name="discapacidades" id="discapacidades" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"><?= $empleadoData->getDiscapacidades(); ?></textarea>
            </div>

            <div>
                <label for="intervenciones" class="block font-medium text-gray-700">Intervenciones:</label>
                <textarea name="intervenciones" id="intervenciones" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"><?= $empleadoData->getIntervenciones(); ?></textarea>
            </div>

            <div>
                <label for="uso_aparatos" class="block font-medium text-gray-700">Uso de Aparatos:</label>
                <textarea name="uso_aparatos" id="uso_aparatos" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"><?= $empleadoData->getUsoAparatos(); ?></textarea>
            </div>

            <div>
                <label for="medicamentos" class="block font-medium text-gray-700">Medicamentos:</label>
                <textarea name="medicamentos" id="medicamentos" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"><?= $empleadoData->getMedicamentos(); ?></textarea>
            </div>

            <div>
                <label for="dosificacion" class="block font-medium text-gray-700">Dosificación:</label>
                <textarea name="dosificacion" id="dosificacion" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"><?= $empleadoData->getDosificacion(); ?></textarea>
            </div>

            <div>
                <label for="frecuencia" class="block font-medium text-gray-700">Frecuencia:</label>
                <textarea name="frecuencia" id="frecuencia" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"><?= $empleadoData->getFrecuencia(); ?></textarea>
            </div>

            <div>
                <label for="proposito" class="block font-medium text-gray-700">Propósito:</label>
                <textarea name="proposito" id="proposito" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"><?= $empleadoData->getProposito(); ?></textarea>
            </div>

            <div>
                <label for="fecha_ingreso" class="block font-medium text-gray-700">Fecha de Ingreso:</label>
                <input type="date" name="fecha_ingreso" id="fecha_ingreso" value="<?= $empleadoData->getFechaIngreso(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="jefe_supervisor" class="block font-medium text-gray-700">Jefe Supervisor:</label>
                <input type="text" name="jefe_supervisor" id="jefe_supervisor" value="<?= $empleadoData->getJefeSupervisor(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="puesto_actual" class="block font-medium text-gray-700">Puesto Actual:</label>
                <input type="text" name="puesto_actual" id="puesto_actual" value="<?= $empleadoData->getPuestoActual(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label for="ultimo_grado_estudio" class="block font-medium text-gray-700">Último Grado de Estudio:</label>
                <input type="text" name="ultimo_grado_estudio" id="ultimo_grado_estudio" value="<?= $empleadoData->getUltimoGradoEstudio(); ?>"
                    class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Guardar
                </button>
            </div>
        </form>
        <a href="listaEmpleados.php" class="block text-center text-blue-600 hover:underline mt-4">Regresar</a>
    </div>
</body>

</html>