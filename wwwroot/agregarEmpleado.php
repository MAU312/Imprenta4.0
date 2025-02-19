<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Empleado</title>
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
        <h1 class="text-2xl font-bold text-center mb-6 text-blue-700">Agregar Empleado</h1>
        <form action="../controllers/EmpleadosController.php?op=agregar" method="POST"
            class="bg-white shadow-md rounded-lg p-6 mt-6 w-full max-w-3xl">
            <div class="grid grid-cols-1 gap-4">

                <div>
                    <label for="identificacion" class="block text-gray-700 font-medium">Identificación:</label>
                    <input type="text" name="identificacion" id="identificacion" required
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="numero_asegurado" class="block text-gray-700 font-medium">Número Asegurado:</label>
                    <input type="text" name="numero_asegurado" id="numero_asegurado"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="nombre" class="block text-gray-700 font-medium">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" required
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="primer_apellido" class="block text-gray-700 font-medium">Primer Apellido:</label>
                    <input type="text" name="primer_apellido" id="primer_apellido" required
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="segundo_apellido" class="block text-gray-700 font-medium">Segundo Apellido:</label>
                    <input type="text" name="segundo_apellido" id="segundo_apellido"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="fecha_nacimiento" class="block text-gray-700 font-medium">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="edad" class="block text-gray-700 font-medium">Edad:</label>
                    <input type="number" name="edad" id="edad"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="telefono1" class="block text-gray-700 font-medium">Teléfono 1:</label>
                    <input type="text" name="telefono1" id="telefono1" required
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="correo" class="block text-gray-700 font-medium">Correo Electrónico:</label>
                    <input type="email" name="correo" id="correo"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="sexo" class="block text-gray-700 font-medium">Sexo:</label>
                    <select name="sexo" id="sexo" class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div>
                    <label for="estado_civil" class="block text-gray-700 font-medium">Estado Civil:</label>
                    <select name="estado_civil" id="estado_civil"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                        <option value="Soltero">Soltero</option>
                        <option value="Casado">Casado</option>
                        <option value="Divorciado">Divorciado</option>
                        <option value="Viudo">Viudo</option>
                    </select>
                </div>

                <div>
                    <label for="lugar_nacimiento" class="block text-gray-700 font-medium">Lugar de Nacimiento:</label>
                    <input type="text" name="lugar_nacimiento" id="lugar_nacimiento"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="nacionalidad" class="block text-gray-700 font-medium">Nacionalidad:</label>
                    <input type="text" name="nacionalidad" id="nacionalidad"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="direccion_domicilio" class="block text-gray-700 font-medium">Dirección Domicilio:</label>
                    <textarea name="direccion_domicilio" id="direccion_domicilio"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="telefono2" class="block text-gray-700 font-medium">Teléfono 2:</label>
                    <input type="text" name="telefono2" id="telefono2"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="nombre_contacto1" class="block text-gray-700 font-medium">Nombre Contacto 1:</label>
                    <input type="text" name="nombre_contacto1" id="nombre_contacto1"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="parentesco_contacto1" class="block text-gray-700 font-medium">Parentesco Contacto 1:</label>
                    <input type="text" name="parentesco_contacto1" id="parentesco_contacto1"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="telefono_contacto1" class="block text-gray-700 font-medium">Teléfono Contacto 1:</label>
                    <input type="text" name="telefono_contacto1" id="telefono_contacto1"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="direccion_contacto1" class="block text-gray-700 font-medium">Dirección Contacto 1:</label>
                    <textarea name="direccion_contacto1" id="direccion_contacto1"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="nombre_contacto2" class="block text-gray-700 font-medium">Nombre Contacto 2:</label>
                    <input type="text" name="nombre_contacto2" id="nombre_contacto2"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="parentesco_contacto2" class="block text-gray-700 font-medium">Parentesco Contacto 2:</label>
                    <input type="text" name="parentesco_contacto2" id="parentesco_contacto2"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="telefono_contacto2" class="block text-gray-700 font-medium">Teléfono Contacto 2:</label>
                    <input type="text" name="telefono_contacto2" id="telefono_contacto2"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="direccion_contacto2" class="block text-gray-700 font-medium">Dirección Contacto 2:</label>
                    <textarea name="direccion_contacto2" id="direccion_contacto2"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="tipo_sangre" class="block text-gray-700 font-medium">Tipo de Sangre:</label>
                    <input type="text" name="tipo_sangre" id="tipo_sangre"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="padecimientos" class="block text-gray-700 font-medium">Padecimientos:</label>
                    <textarea name="padecimientos" id="padecimientos"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="discapacidades" class="block text-gray-700 font-medium">Discapacidades:</label>
                    <textarea name="discapacidades" id="discapacidades"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="intervenciones" class="block text-gray-700 font-medium">Intervenciones:</label>
                    <textarea name="intervenciones" id="intervenciones"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="uso_aparatos" class="block text-gray-700 font-medium">Uso de Aparatos:</label>
                    <textarea name="uso_aparatos" id="uso_aparatos"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="medicamentos" class="block text-gray-700 font-medium">Medicamentos:</label>
                    <textarea name="medicamentos" id="medicamentos"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="dosificacion" class="block text-gray-700 font-medium">Dosificación:</label>
                    <textarea name="dosificacion" id="dosificacion"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="frecuencia" class="block text-gray-700 font-medium">Frecuencia:</label>
                    <textarea name="frecuencia" id="frecuencia"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="proposito" class="block text-gray-700 font-medium">Propósito:</label>
                    <textarea name="proposito" id="proposito"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300"></textarea>
                </div>

                <div>
                    <label for="fecha_ingreso" class="block text-gray-700 font-medium">Fecha de Ingreso:</label>
                    <input type="date" name="fecha_ingreso" id="fecha_ingreso"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="jefe_supervisor" class="block text-gray-700 font-medium">Jefe Supervisor:</label>
                    <input type="text" name="jefe_supervisor" id="jefe_supervisor"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="puesto_actual" class="block text-gray-700 font-medium">Puesto Actual:</label>
                    <input type="text" name="puesto_actual" id="puesto_actual"
                        class="w-full px-3 py-2 border rounded-md focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="ultimo_grado_estudio" class="block text-gray-700 font-medium">Último Grado de Estudio:</label>
                    <input type="text" name="ultimo_grado_estudio" id="ultimo_grado_estudio"
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