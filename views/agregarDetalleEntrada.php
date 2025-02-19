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
        <h1 class="text-2xl font-bold mb-4">Agregar Entrada</h1>

        <form id="formAgregarDetalleEntrada" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="factura" class="block text-sm font-medium text-gray-700">Número de Factura</label>
                <input type="text" id="factura" name="factura" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="proveedor" class="block text-sm font-medium text-gray-700">Proveedor</label>
                <input type="text" id="proveedor" name="proveedor" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="cantidadResma" class="block text-sm font-medium text-gray-700">Cantidad de Resma</label>
                <input type="number" id="cantidadResma" name="cantidadResma" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="pliegoResma" class="block text-sm font-medium text-gray-700">Pliego por Resma</label>
                <input type="number" id="pliegoResma" name="pliegoResma" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="cantidadPliego" class="block text-sm font-medium text-gray-700">Cantidad de Pliegos</label>
                <input type="number" id="cantidadPliego" name="cantidadPliego" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="precioPliego" class="block text-sm font-medium text-gray-700">Precio por Pliego</label>
                <input type="number" id="precioPliego" name="precioPliego" step="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="descuento" class="block text-sm font-medium text-gray-700">Descuento</label>
                <input type="number" id="descuento" name="descuento" step="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <div class="mb-4">
                <label for="tipoCambio" class="block text-sm font-medium text-gray-700">Tipo de Cambio</label>
                <input type="number" id="tipoCambio" name="tipoCambio" step="0.01" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Agregar Entrada
            </button>
        </form>

        <!-- Footer -->
        <footer class="text-center text-gray-600 text-sm mt-6">
            &copy; 2024 Tu Empresa. Todos los derechos reservados.
        </footer>
    </div>

    <!-- JavaScript para manejar el CRUD -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/JavaScript/agregarDE.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</body>

</html>
