<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Materiales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
                <button onclick="limpiarConversor()" class="mt-4 bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 flex items-center justify-center text-sm w-fit mx-auto">
                    <i class="fas fa-eraser mr-1"></i> Limpiar
                </button>
            </div>
        </div>
        <!-- Ventas por Mes -->
        <div class="flex flex-wrap justify-center gap-6 p-4">
            <!-- Gráfico de Ventas por Mes -->
            <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-[48%]">
                <!-- Año -->
                <div class="flex justify-between items-center mb-4">
                    <label for="anio" class="font-medium text-gray-700">Selecciona un año:</label>
                    <select id="anio" name="anio" class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php
                        $anio_actual = isset($_GET['anio']) ? $_GET['anio'] : 2025;
                        for ($i = 2020; $i <= 2030; $i++) {
                            echo "<option value='$i' " . ($i == $anio_actual ? 'selected' : '') . ">$i</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Canvas -->
                <h2 class="text-2xl font-bold mb-4 text-center">Ventas por Mes</h2>
                <canvas id="graficoVentas"></canvas>
            </div>

            <!-- Gráfico de Gastos vs Ingresos -->
            <div class="bg-white p-6 rounded-lg shadow-lg w-full md:w-[48%]">
                <!-- Año -->
                <div class="flex justify-between items-center mb-4">
                    <label for="anio2" class="font-medium text-gray-700">Selecciona un año:</label>
                    <select id="anio2" name="anio2" class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <?php
                        $anio_actual = isset($_GET['anio2']) ? $_GET['anio2'] : 2025;
                        for ($i = 2020; $i <= 2030; $i++) {
                            echo "<option value='$i' " . ($i == $anio_actual ? 'selected' : '') . ">$i</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Canvas -->
                <h2 class="text-2xl font-bold mb-4 text-center">Gastos vs Ingresos (por mes)</h2>
                <canvas id="graficoGastosIngresos"></canvas>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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


    <script>
        let chartInstance = null; // Variable para almacenar la instancia del gráfico

        // Función para cargar los datos del gráfico
        async function cargarGrafico() {
            try {
                const anioSeleccionado = document.getElementById('anio').value;
                const response = await fetch(`../controllers/GraficoController.php?op=ventasPorMes&anio=${anioSeleccionado}`);
                const data = await response.json();

                if (chartInstance) {
                    // Si existe un gráfico previo, lo destruimos antes de crear uno nuevo
                    chartInstance.destroy();
                }

                // Crear un nuevo gráfico con los datos obtenidos
                const ctx = document.getElementById('graficoVentas').getContext('2d');
                chartInstance = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.meses,
                        datasets: [{
                            label: 'Ventas',
                            data: data.ventas,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: data.max_y // Escala del eje Y
                            }
                        }
                    }
                });
            } catch (error) {
                console.error("Error al obtener los datos del gráfico:", error);
            }
        }

        // Llamar a la función para cargar los datos al cargar la página
        cargarGrafico();

        // Agregar un event listener para actualizar el gráfico al cambiar el año
        document.getElementById('anio').addEventListener('change', cargarGrafico);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let chartInstanceGastosIngresos = null; // Variable para almacenar la instancia del gráfico de gastos e ingresos

            // Función para cargar los datos del gráfico de Gastos e Ingresos
            // Función para cargar los datos del gráfico de Gastos e Ingresos
            async function cargarGraficoGastosIngresos() {
                try {
                    const anioSeleccionado2 = document.getElementById('anio2').value; // Obtener el valor de 'anio2' para gastos e ingresos
                    console.log("Año seleccionado:", anioSeleccionado2);

                    const response = await fetch(`../controllers/GraficoController.php?op=gastosEIngresosPorMes&anio2=${anioSeleccionado2}`);
                    const data2 = await response.json(); // Obtener los datos en formato JSON
                    console.log("Datos recibidos:", data2);

                    if (chartInstanceGastosIngresos) {
                        // Si existe un gráfico previo, lo destruimos antes de crear uno nuevo
                        chartInstanceGastosIngresos.destroy();
                    }

                    // Crear un nuevo gráfico con los datos obtenidos
                    const ctx = document.getElementById('graficoGastosIngresos').getContext('2d');
                    chartInstanceGastosIngresos = new Chart(ctx, {
                        type: 'bar', // Tipo de gráfico (puede ser 'bar', 'line', etc.)
                        data: {
                            labels: data2.meses, // Etiquetas de los meses
                            datasets: [{
                                    label: 'Gastos', // Nombre de la serie de gastos
                                    data: data2.gastos, // Los datos de los gastos
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Color de fondo de las barras de gastos
                                    borderColor: 'rgba(255, 99, 132, 1)', // Color del borde de las barras de gastos
                                    borderWidth: 1 // Grosor del borde
                                },
                                {
                                    label: 'Ingresos', // Nombre de la serie de ingresos
                                    data: data2.ingresos, // Los datos de los ingresos
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo de las barras de ingresos
                                    borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras de ingresos
                                    borderWidth: 1 // Grosor del borde
                                }
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true, // Asegura que el eje Y empiece en 0
                                    max: data2.max_y // Escala del eje Y
                                }
                            }
                        }
                    });
                } catch (error) {
                    console.error("Error al obtener los datos del gráfico:", error); // En caso de error
                }
            }


            // Llamar a la función para cargar los datos del gráfico de Gastos e Ingresos al cargar la página
            cargarGraficoGastosIngresos();

            // Agregar un event listener para actualizar el gráfico de gastos e ingresos al cambiar el año
            document.getElementById('anio2').addEventListener('change', cargarGraficoGastosIngresos);
        });
    </script>


</body>

</html>