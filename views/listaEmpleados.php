<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Información Personal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        tbody tr:not(:last-child) {
            border-bottom: 5px solid #e0e0e0;
        }
    </style>
</head>

<body class="flex bg-gray-100">
    <!-- Incluir el sidebar -->
    <?php include './assets/Fragments/sidebar.php'; ?>

    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">Gestión de Información Personal</h1>

        <div class="bg-white rounded-lg shadow-md border border-gray-300 mb-6 overflow-hidden">
            <table id="tblEmpleados" class="table-auto w-full bg-white rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-700">Identificación</th>
                        <th class="px-6 py-3 text-left text-gray-700">Nombre</th>
                        <th class="px-6 py-3 text-left text-gray-700">Apellido</th>
                        <th class="px-6 py-3 text-left text-gray-700">Teléfono</th>
                        <th class="px-6 py-3 text-left text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody id="empleadoTableBody" class="text-gray-700">
                    <!-- Aquí se insertarán los registros de manera dinámica -->
                </tbody>
            </table>
        </div>

        <div class="flex justify-center space-x-4 mb-6">
            <button id="btnAgregar" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200"><i class="fas fa-plus"></i> Agregar Empleado</button>
        </div>

        <!-- Footer -->
        <footer class="text-center text-gray-600 text-sm">
            &copy; 2024 Tu Empresa. Todos los derechos reservados.
        </footer>
    </div>

    <!-- JavaScript para manejar el CRUD -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="./assets/JavaScript/empleados.js"></script>
</body>

</html>