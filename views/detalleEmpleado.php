<?php
require_once '../models/Empleado.php';

// Verificar si se proporcionó un ID
if (isset($_GET['identificacion'])) {
    $identificacion = $_GET['identificacion'];

    // Crear instancia del modelo Empleado
    $empleado = new Empleado();

    // Obtener los detalles del empleado
    $detalle = $empleado->obtenerDetalles($identificacion);

    if (!$detalle) {
        die("No se encontró un empleado con la identificación proporcionada.");
    }
} else {
    die("No se proporcionó un ID de empleado.");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Empleado</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="flex bg-gray-100">
    <!-- Incluir el sidebar -->
    <?php include './assets/Fragments/sidebar.php'; ?>

    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">Perfil de Empleado</h1>

        <!-- Contenedor del perfil -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg border border-gray-300 p-6">
            <!-- Información general -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Información General</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><strong>Identificación:</strong> <span><?php echo $detalle['identificacion']; ?></span></div>
                    <div><strong>Número Asegurado:</strong> <span><?php echo $detalle['numero_asegurado']; ?></span></div>
                    <div><strong>Nombre Completo:</strong>
                        <span><?php echo $detalle['nombre'] . ' ' . $detalle['primer_apellido'] . ' ' . $detalle['segundo_apellido']; ?></span>
                    </div>
                    <div><strong>Fecha de Nacimiento:</strong> <span><?php echo $detalle['fecha_nacimiento']; ?></span></div>
                    <div><strong>Edad:</strong> <span><?php echo $detalle['edad']; ?></span></div>
                    <div><strong>Teléfono 1:</strong> <span><?php echo $detalle['telefono1']; ?></span></div>
                    <div><strong>Teléfono 2:</strong> <span><?php echo $detalle['telefono2']; ?></span></div>
                    <div><strong>Correo Electrónico:</strong> <span><?php echo $detalle['correo']; ?></span></div>
                    <div><strong>Sexo:</strong> <span><?php echo $detalle['sexo']; ?></span></div>
                    <div><strong>Estado Civil:</strong> <span><?php echo $detalle['estado_civil']; ?></span></div>
                    <div><strong>Lugar de Nacimiento:</strong> <span><?php echo $detalle['lugar_nacimiento']; ?></span></div>
                    <div><strong>Nacionalidad:</strong> <span><?php echo $detalle['nacionalidad']; ?></span></div>
                    <div><strong>Dirección Domicilio:</strong> <span><?php echo $detalle['direccion_domicilio']; ?></span></div>
                </div>
            </div>

            <!-- Contactos de emergencia -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Contactos de Emergencia</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <strong>Nombre Contacto 1:</strong> <span><?php echo $detalle['nombre_contacto1']; ?></span><br>
                        <strong>Parentesco:</strong> <span><?php echo $detalle['parentesco_contacto1']; ?></span><br>
                        <strong>Teléfono:</strong> <span><?php echo $detalle['telefono_contacto1']; ?></span><br>
                        <strong>Dirección:</strong> <span><?php echo $detalle['direccion_contacto1']; ?></span>
                    </div>
                    <div>
                        <strong>Nombre Contacto 2:</strong> <span><?php echo $detalle['nombre_contacto2']; ?></span><br>
                        <strong>Parentesco:</strong> <span><?php echo $detalle['parentesco_contacto2']; ?></span><br>
                        <strong>Teléfono:</strong> <span><?php echo $detalle['telefono_contacto2']; ?></span><br>
                        <strong>Dirección:</strong> <span><?php echo $detalle['direccion_contacto2']; ?></span>
                    </div>
                </div>
            </div>

            <!-- Salud -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Información de Salud</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><strong>Tipo de Sangre:</strong> <span><?php echo $detalle['tipo_sangre']; ?></span></div>
                    <div><strong>Padecimientos:</strong> <span><?php echo $detalle['padecimientos']; ?></span></div>
                    <div><strong>Discapacidades:</strong> <span><?php echo $detalle['discapacidades']; ?></span></div>
                    <div><strong>Intervenciones Quirúrgicas:</strong> <span><?php echo $detalle['intervenciones']; ?></span></div>
                    <div><strong>Uso de Aparatos:</strong> <span><?php echo $detalle['uso_aparatos']; ?></span></div>
                    <div><strong>Medicamentos:</strong> <span><?php echo $detalle['medicamentos']; ?></span></div>
                    <div><strong>Dosificación:</strong> <span><?php echo $detalle['dosificacion']; ?></span></div>
                    <div><strong>Frecuencia:</strong> <span><?php echo $detalle['frecuencia']; ?></span></div>
                    <div><strong>Propósito:</strong> <span><?php echo $detalle['proposito']; ?></span></div>
                </div>
            </div>

            <!-- Laboral -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-gray-700 mb-4">Información Laboral</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><strong>Fecha de Ingreso:</strong> <span><?php echo $detalle['fecha_ingreso']; ?></span></div>
                    <div><strong>Jefe/Supervisor:</strong> <span><?php echo $detalle['jefe_supervisor']; ?></span></div>
                    <div><strong>Puesto Actual:</strong> <span><?php echo $detalle['puesto_actual']; ?></span></div>
                    <div><strong>Último Grado de Estudio:</strong> <span><?php echo $detalle['ultimo_grado_estudio']; ?></span></div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="container flex justify-center mt-4">
                <!-- Botón de regresar centrado -->
                <a href="listaEmpleados.php" class="btnRegresar bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Regresar a la lista de empleados
                </a>
            </div>
        </div>
    </div>
</body>

</html>