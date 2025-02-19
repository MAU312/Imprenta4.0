<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Materiales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- Enlace de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">Home</h1>

        <!-- Conversor de medidas con icono mejorado -->
        <div class="bg-white rounded-lg shadow-md border border-gray-300 mb-6 p-4">
            <h2 class="text-xl font-semibold mb-4 text-center">Conversor de Medidas</h2>
            <div class="flex flex-col space-y-4">
                <div class="flex justify-between items-center">
                    <div class="flex flex-col w-1/2 pr-2">
                        <label id="labelInput" for="inputValor" class="mb-1 text-gray-700">Pulgadas:</label>
                        <input type="number" id="inputValor" placeholder="Ingrese valor" class="border rounded-lg p-2" />
                    </div>
                    <div class="flex justify-center">
                        <!-- Botón con icono de cambio (flechas en círculo) -->
                        <button id="swapButton" class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-semibold rounded-full shadow-lg px-6 py-3 transition-transform transform hover:scale-105">
                            <i class="fas fa-sync-alt"></i> <!-- Ícono de flechas en círculo -->
                        </button>
                    </div>
                    <div class="flex flex-col w-1/2 pl-2">
                        <label id="labelOutput" for="outputValor" class="mb-1 text-gray-700">Centímetros:</label>
                        <input type="text" id="outputValor" placeholder="Resultado" class="border rounded-lg p-2" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let isPulgadasToCentimetros = true; // Para saber si estamos convirtiendo de pulgadas a centímetros

        // Función para realizar las conversiones
        function convertir() {
            const valorInput = parseFloat(document.getElementById('inputValor').value);
            if (!isNaN(valorInput)) {
                if (isPulgadasToCentimetros) {
                    const centimetros = valorInput * 2.54; // De pulgadas a centímetros
                    document.getElementById('outputValor').value = centimetros.toFixed(2);
                } else {
                    const pulgadas = valorInput / 2.54; // De centímetros a pulgadas
                    document.getElementById('outputValor').value = pulgadas.toFixed(2);
                }
            } else {
                document.getElementById('outputValor').value = '';
            }
        }

        // Detectar cambios en el input para hacer la conversión automática
        document.getElementById('inputValor').addEventListener('input', convertir);

        // Botón para cambiar entre pulgadas y centímetros
        document.getElementById('swapButton').addEventListener('click', function() {
            const labelInput = document.getElementById('labelInput');
            const labelOutput = document.getElementById('labelOutput');
            const inputValor = document.getElementById('inputValor');
            const outputValor = document.getElementById('outputValor');

            // Cambiar las etiquetas
            if (isPulgadasToCentimetros) {
                labelInput.textContent = 'Centímetros:';
                labelOutput.textContent = 'Pulgadas:';
                inputValor.placeholder = 'Ingrese centímetros';
                outputValor.placeholder = 'Resultado en pulgadas';
            } else {
                labelInput.textContent = 'Pulgadas:';
                labelOutput.textContent = 'Centímetros:';
                inputValor.placeholder = 'Ingrese pulgadas';
                outputValor.placeholder = 'Resultado en centímetros';
            }

            // Limpiar los valores de entrada y salida
            inputValor.value = '';
            outputValor.value = '';

            // Cambiar el estado de la conversión
            isPulgadasToCentimetros = !isPulgadasToCentimetros;
        });
    </script>
</body>

</html>