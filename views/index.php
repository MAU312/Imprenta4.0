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

        <!-- Cuadro de conversión de pulgadas a centímetros y viceversa -->
        <div class="bg-white rounded-lg shadow-md border border-gray-300 mb-6 p-4">
            <h2 class="text-xl font-semibold mb-4 text-center">Conversor de Medidas</h2>
            <div class="flex flex-col space-y-4">
                <div class="flex justify-between">
                    <div class="flex flex-col w-1/2 pr-2">
                        <label for="inputPulgadas" class="mb-1 text-gray-700">Pulgadas:</label>
                        <input type="number" id="inputPulgadas" placeholder="Ingrese pulgadas" class="border rounded-lg p-2" />
                    </div>
                    <div class="flex flex-col w-1/2 pl-2">
                        <label for="outputCentimetros" class="mb-1 text-gray-700">Centímetros:</label>
                        <input type="text" id="outputCentimetros" placeholder="Resultado en centímetros" class="border rounded-lg p-2" readonly />
                    </div>
                </div>
                <div class="flex justify-between">
                    <div class="flex flex-col w-1/2 pr-2">
                        <label for="inputCentimetros" class="mb-1 text-gray-700">Centímetros:</label>
                        <input type="number" id="inputCentimetros" placeholder="Ingrese centímetros" class="border rounded-lg p-2" />
                    </div>
                    <div class="flex flex-col w-1/2 pl-2">
                        <label for="outputPulgadas" class="mb-1 text-gray-700">Pulgadas:</label>
                        <input type="text" id="outputPulgadas" placeholder="Resultado en pulgadas" class="border rounded-lg p-2" readonly />
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Footer -->
        <footer class="text-center text-gray-600 text-sm">
            &copy; 2024 Tu Empresa. Todos los derechos reservados.
        </footer>
    </div>

    <script>
        // Conversión de pulgadas a centímetros
        document.getElementById('inputPulgadas').addEventListener('input', function() {
            const pulgadas = parseFloat(this.value);
            if (!isNaN(pulgadas)) {
                const centimetros = pulgadas * 2.54;
                document.getElementById('outputCentimetros').value = centimetros.toFixed(2);
            } else {
                document.getElementById('outputCentimetros').value = '';
            }
        });

        // Conversión de centímetros a pulgadas
        document.getElementById('inputCentimetros').addEventListener('input', function() {
            const centimetros = parseFloat(this.value);
            if (!isNaN(centimetros)) {
                const pulgadas = centimetros / 2.54;
                document.getElementById('outputPulgadas').value = pulgadas.toFixed(2);
            } else {
                document.getElementById('outputPulgadas').value = '';
            }
        });
    </script>



    <!-- JavaScript para manejar el CRUD -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="./assets/JavaScript/mostrar.js"></script>
</body>

</html>