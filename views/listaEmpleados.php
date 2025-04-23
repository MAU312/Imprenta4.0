<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Información Personal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Efecto de hover en las filas de la tabla */
        #tblEmpleados tbody tr:hover {
            background-color: #f0f4f8;
        }
    </style>
</head>

<body class="flex bg-gray-100">
    <!-- Incluir el sidebar -->
    <?php include './assets/Fragments/sidebar.php'; ?>

    <div class="flex-1 p-6">
        <div class="flex items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-700 flex-1 text-center">Gestión de Información Personal</h1>
        </div>

        <!-- Tabla de empleados -->
        <div class="w-full bg-white rounded-lg shadow-lg border border-gray-300 mb-6 overflow-x-auto">
            <table id="tblEmpleados" class="min-w-full bg-white rounded-lg border-collapse">
                <thead class="bg-gray-200">
                    <tr class="border-b">
                        <th class="px-6 py-4 text-left text-gray-700">Identificación</th>
                        <th class="px-6 py-4 text-left text-gray-700">Nombre</th>
                        <th class="px-6 py-4 text-left text-gray-700">Apellido</th>
                        <th class="px-6 py-4 text-left text-gray-700">Teléfono</th>
                        <th class="px-6 py-4 text-left text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody id="empleadoTableBody" class="text-gray-700">
                    <!-- Aquí se insertarán los registros de manera dinámica -->
                </tbody>
            </table>
        </div>

        <div class="flex justify-center space-x-4 mb-6">
            <button id="btnAgregar" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span>Agregar Empleado</span>
            </button>

        </div>
    </div>

    <!-- JavaScript para manejar el CRUD -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="./assets/JavaScript/empleados.js"></script>
</body>

</html>