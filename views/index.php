<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
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
        <div class="w-full max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4 text-center">Conversor de Medidas</h2>
            <div class="flex flex-col space-y-4">
                <div class="flex justify-between items-center">
                    <div class="flex flex-col w-1/2 pr-2">
                        <label for="inputValor" class="mb-1 text-gray-700">Valor:</label>
                        <input type="number" id="inputValor" placeholder="Ingrese valor" class="border rounded-lg p-2" />
                        <select id="inputUnidad" class="border rounded-lg p-2 mt-2">
                            <option value="mm">Milímetros</option>
                            <option value="cm">Centímetros</option>
                            <option value="m">Metros</option>
                            <option value="km">Kilómetros</option>
                            <option value="in">Pulgadas</option>
                            <option value="ft">Pies</option>
                            <option value="yd">Yardas</option>
                            <option value="mi">Millas</option>
                        </select>
                    </div>
                    <div class="flex justify-center">
                        <span class="text-2xl">=</span>
                    </div>
                    <div class="flex flex-col w-1/2 pl-2">
                        <label for="outputValor" class="mb-1 text-gray-700">Resultado:</label>
                        <input type="text" id="outputValor" placeholder="Resultado" class="border rounded-lg p-2" readonly />
                        <select id="outputUnidad" class="border rounded-lg p-2 mt-2">
                            <option value="mm">Milímetros</option>
                            <option value="cm" selected>Centímetros</option>
                            <option value="m">Metros</option>
                            <option value="km">Kilómetros</option>
                            <option value="in">Pulgadas</option>
                            <option value="ft">Pies</option>
                            <option value="yd">Yardas</option>
                            <option value="mi">Millas</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const conversiones = {
            mm: 1,
            cm: 10,
            m: 1000,
            km: 1000000,
            in: 25.4,
            ft: 304.8,
            yd: 914.4,
            mi: 1609344
        };

        function convertir() {
            const valor = parseFloat(document.getElementById('inputValor').value);
            const unidadDesde = document.getElementById('inputUnidad').value;
            const unidadHasta = document.getElementById('outputUnidad').value;

            if (!isNaN(valor)) {
                const resultado = (valor * conversiones[unidadDesde]) / conversiones[unidadHasta];
                document.getElementById('outputValor').value = Number.isInteger(resultado) ? resultado : resultado.toFixed(6).replace(/\.0+$/, '');
            } else {
                document.getElementById('outputValor').value = '';
            }
        }

        // Agregar los listeners a los cambios
        document.getElementById('inputValor').addEventListener('input', convertir);
        document.getElementById('inputUnidad').addEventListener('change', convertir);
        document.getElementById('outputUnidad').addEventListener('change', convertir);
    </script>
</body>

</html>