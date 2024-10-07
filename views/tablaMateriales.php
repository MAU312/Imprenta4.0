<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Materiales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">Inventario de Materiales</h1>

        <!-- Tabla de materiales -->
        <div class="bg-white rounded-lg shadow-md border border-gray-300 mb-6 overflow-hidden">
            <table id="tbllistado" class="table-auto w-full bg-white rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700">ID</th>
                        <th class="px-4 py-2 text-left text-gray-700">Material</th>
                        <th class="px-4 py-2 text-left text-gray-700">Cantidad Inventario</th>
                        <th class="px-4 py-2 text-left text-gray-700">Valor Inventario</th>
                    </tr>
                </thead>
                <tbody id="materialTableBody" class="text-gray-700">
                    <!-- Filas de materiales serán agregadas aquí -->
                </tbody>
            </table>
        </div>

        <!-- Botones para agregar, editar y eliminar -->
        <div class="flex justify-center space-x-4 mb-6">
            <button id="btnAgregar" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200"><i class="fas fa-plus"></i> Agregar Material</button>
            <button id="btnEditar" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-200"><i class="fas fa-edit"></i> Editar Material</button>
            <button id="btnEliminar" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200"><i class="fas fa-trash"></i> Eliminar Material</button>
        </div>

        <!-- Footer -->
        <footer class="text-center text-gray-600 text-sm">
            &copy; 2024 Tu Empresa. Todos los derechos reservados.
        </footer>
    </div>

    <!-- JavaScript para manejar el CRUD -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="./assets/JavaScript/mostrar.js"></script>
</body>

</html>