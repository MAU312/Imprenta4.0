<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo Excel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-blue-50 to-indigo-100">

    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <?php include './assets/Fragments/sidebar.php'; ?>

        <div class="flex-1 p-6">
            <div class="bg-white shadow-lg rounded-lg p-8 space-y-8">

                <!-- Encabezado -->
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Subir Archivo Excel</h1>
                    <p class="text-lg text-gray-600">Carga tu archivo Excel y verás la información de las horas de llegada y salida de los empleados.</p>
                </div>

                <!-- Formulario de carga de archivo -->
                <div class="space-y-4">
                    <!-- Input de archivo -->
                    <div class="flex justify-center">
                        <input type="file" id="excelFile" accept=".xlsx, .xls"
                            class="border-2 border-indigo-500 p-4 rounded-lg w-2/3 bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300" />
                    </div>

                    <!-- Botón de impresión -->
                    <div class="flex justify-center">
                        <button id="printButton" class="w-1/3 py-3 bg-indigo-500 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300"
                            disabled>Imprimir Nombres y Periodos</button>
                    </div>
                </div>

                <!-- Contenedor donde se mostrarán los resultados -->
                <div id="resultados" class="mt-8 space-y-6">
                    <!-- Los resultados se irán mostrando aquí -->
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById('excelFile').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, {
                    type: 'array'
                });

                const sheetName = workbook.SheetNames[0]; // Asumimos que estamos trabajando con la primera hoja
                const sheet = workbook.Sheets[sheetName];

                const rows = XLSX.utils.sheet_to_json(sheet, {
                    header: 1
                });

                // Llamamos a la función para imprimir los nombres y los periodos
                leer(rows);
            };

            reader.readAsArrayBuffer(file);
        });

        function excelDateToJSDate(excelDate) {
            const date = new Date((excelDate - 25569) * 86400 * 1000); // Convierte la fecha
            const offset = date.getTimezoneOffset(); // Ajustar la zona horaria
            return new Date(date.getTime() + offset * 60 * 1000);
        }

        function leer(rows) {
            const nameRows = [];
            for (let i = 5; i <= rows.length; i += 18) {
                nameRows.push(i);
            }

            const periodRows = [];
            for (let i = 6; i <= rows.length; i += 18) {
                periodRows.push(i);
            }

            const textoPlano = [];
            const horaInicio = [];
            const horaSalida = [];

            // Generar las filas donde se encuentran los datos, siguiendo el patrón
            for (let i = 10; i <= rows.length; i += 18) {
                for (let j = 0; j < 7; j++) { // Leer 7 filas consecutivas (bloque)
                    horaInicio.push(i + j); // Guardamos la fila a leer para hora de llegada
                    horaSalida.push(i + j); // Guardamos la fila a leer para hora de salida
                }
            }

            // Leer las filas especificadas y extraer las horas de llegada (columna D) y salida (columna E)
            horaInicio.forEach(fila => {
                const valor = rows[fila - 1] ? rows[fila - 1][3] : null; // Ajustar índice base 0 (columna D)
                if (valor) {
                    if (typeof valor === 'number') {
                        const fechaConvertida = excelDateToJSDate(valor);
                        textoPlano.push(fechaConvertida.toLocaleString());
                    } else {
                        textoPlano.push(String(valor).trim());
                    }
                } else {
                    textoPlano.push(""); // Si no hay valor, lo dejamos vacío
                }
            });

            const textoSalida = []; // Array para las horas de salida

            horaSalida.forEach(fila => {
                const valor = rows[fila - 1] ? rows[fila - 1][4] : null; // Ajustar índice base 0 (columna E)
                if (valor) {
                    if (typeof valor === 'number') {
                        const fechaConvertida = excelDateToJSDate(valor);
                        textoSalida.push(fechaConvertida.toLocaleString());
                    } else {
                        textoSalida.push(String(valor).trim());
                    }
                } else {
                    textoSalida.push(""); // Si no hay valor, lo dejamos vacío
                }
            });

            // Creamos un objeto para almacenar los resultados de manera estructurada
            const empleados = [];

            nameRows.forEach((rowIndex, i) => {
                const name = rows[rowIndex - 1] ? rows[rowIndex - 1][4] : undefined;
                const period = rows[periodRows[i] - 1] ? rows[periodRows[i] - 1][10] : undefined;

                let fechas = [];
                if (period) {
                    const [fechaInicio] = period.split(" - ");
                    const [dia, mes, anio] = fechaInicio.split("/").map(Number);
                    const fechaActual = new Date(anio, mes - 1, dia);

                    const diasSemana = ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"];
                    fechas = diasSemana.map((diaNombre, index) => {
                        const fecha = new Date(fechaActual);
                        fecha.setDate(fecha.getDate() + index);
                        return `${diaNombre} - ${fecha.toLocaleDateString("es-ES")}`;
                    });
                }

                if (name && period) {
                    const empleado = {
                        nombre: name,
                        periodo: period,
                        diasTrabajados: fechas,
                        horasDeLlegada: textoPlano.slice(i * 7, (i + 1) * 7),
                        horasDeSalida: textoSalida.slice(i * 7, (i + 1) * 7)
                    };

                    empleados.push(empleado);
                }
            });

            // Mostrar los datos de los empleados
            const resultadosDiv = document.getElementById('resultados');
            empleados.forEach(empleado => {
                let empleadoInfo = `
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 mb-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">${empleado.nombre}</h3>
                        <p class="text-lg text-gray-600 mb-4">Periodo: ${empleado.periodo}</p>
                        <ul class="space-y-4">`;

                empleado.diasTrabajados.forEach((dia, index) => {
                    const horaEntrada = empleado.horasDeLlegada[index] || "No registrado";
                    const horaSalida = empleado.horasDeSalida[index] || "No registrado";
                    empleadoInfo += `
                        <li class="flex justify-between bg-gray-50 rounded-lg p-4">
                            <span class="text-gray-800">${dia}</span>
                            <span class="text-gray-600">Hora de llegada: ${horaEntrada}</span>
                            <span class="text-gray-600">Hora de salida: ${horaSalida}</span>
                        </li>`;
                });

                empleadoInfo += `</ul></div>`;

                resultadosDiv.innerHTML += empleadoInfo;
            });
        }
    </script>

</body>

</html>