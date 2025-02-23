<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Materiales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Efecto de hover en las filas de la tabla */
        #tbllistado tbody tr:hover {
            background-color: #f0f4f8;
            /* Color de fondo suave al pasar el mouse */
        }

        #popup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            /* Fondo oscuro */
            z-index: 1000;
            /* Asegúrate de que el popup esté encima de otros elementos */
        }
    </style>
</head>

<body class="flex bg-gray-100">
    <!-- Incluir el sidebar -->
    <?php include './assets/Fragments/sidebar.php'; ?>

    <div class="flex-1 p-6">
        <div class="flex items-center mb-6">
            <button onclick="showPopup()" class="flex items-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out mr-2" style="margin-left: 5%;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Agregar Material
            </button>
            <h1 class="text-3xl font-bold text-blue-700 flex-1" style="margin-left: 15%;">Inventario de Materiales</h1>
        </div>

        <!-- Popup -->
        <div id="popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 w-96">
                <h2 class="text-lg font-bold mb-4">Nombre del Material</h2>
                <input type="text" id="materialName" class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Ingresa el nombre del material" name="material">
                <div class="mt-4 flex justify-end">
                    <button onclick="addMaterial()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Agregar</button>
                    <button onclick="closePopup()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2">Cancelar</button>
                </div>
            </div>
        </div>


        <script>
            function showPopup() {
                document.getElementById('popup').classList.remove('hidden');
            }

            function closePopup() {
                document.getElementById('popup').classList.add('hidden');
            }
        </script>



        <!-- Tabla de materiales -->
        <div class="w-full bg-white rounded-lg shadow-lg border border-gray-300 mb-6 overflow-x-auto">
            <table id="tbllistado" class="min-w-full bg-white rounded-lg border-collapse">
                <thead class="bg-gray-200">
                    <tr class="border-b">
                        <th class="px-6 py-4 text-left text-gray-700">ID</th>
                        <th class="px-6 py-4 text-left text-gray-700">Material</th>
                        <th class="px-6 py-4 text-left text-gray-700">Cantidad Inventario</th>
                        <th class="px-6 py-4 text-left text-gray-700">Valor Inventario</th>
                        <th class="px-6 py-4 text-left text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody id="materialTableBody" class="text-gray-700">
                    <!-- Aquí se insertarán los registros de la tabla -->
                </tbody>
            </table>
        </div>
    </div>


    <!-- JavaScript para manejar el CRUD -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="./assets/JavaScript/mostrar.js"></script>
    <script src="./assets/JavaScript/agregarMaterial.js"></script>
</body>

</html>