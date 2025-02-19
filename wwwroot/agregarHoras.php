<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo Excel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                    <!-- Botón de subir datos -->
                    <div class="flex justify-center">
                        <button id="printButton" class="w-1/3 py-3 bg-indigo-500 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300"
                            disabled>Subir Datos</button>
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
        let empleados = []; // Variable global para almacenar los datos de los empleados

        document.getElementById('excelFile').addEventListener('change', function(event) {
            const file = event.target.files[0];

            // Validar que el archivo sea un Excel
            if (!file || !file.name.match(/\.(xlsx|xls)$/)) {
                alert("Por favor, sube un archivo Excel válido.");
                return;
            }

            const reader = new FileReader();

            // Mostrar mensaje de carga
            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = "<p>Procesando archivo, por favor espera...</p>";

            reader.onload = function(e) {
                try {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });

                    const sheetName = workbook.SheetNames[0]; // Asumimos que estamos trabajando con la primera hoja
                    const sheet = workbook.Sheets[sheetName];

                    const rows = XLSX.utils.sheet_to_json(sheet, {
                        header: 1
                    });

                    // Limpiar resultados anteriores
                    resultadosDiv.innerHTML = "";

                    // Llamamos a la función para procesar los datos
                    leer(rows);

                    // Habilitar el botón de subir datos
                    document.getElementById('printButton').disabled = false;
                } catch (error) {
                    console.error("Error al procesar el archivo:", error);
                    resultadosDiv.innerHTML = "<p class='text-red-500'>Hubo un error al procesar el archivo. Por favor, inténtalo de nuevo.</p>";
                }
            };

            reader.onerror = function(e) {
                console.error("Error al leer el archivo:", e.target.error);
                resultadosDiv.innerHTML = "<p class='text-red-500'>Hubo un error al leer el archivo. Por favor, inténtalo de nuevo.</p>";
            };

            reader.readAsArrayBuffer(file);
        });

        function excelDateToJSDate(excelDate) {
            const date = new Date((excelDate - 25569) * 86400 * 1000); // Convierte la fecha
            const offset = date.getTimezoneOffset(); // Ajustar la zona horaria
            return new Date(date.getTime() + offset * 60 * 1000);
        }

        function extraerHoras(rows, columna) {
            const horas = [];
            for (let i = 10; i <= rows.length; i += 18) {
                for (let j = 0; j < 7; j++) {
                    const valor = rows[i + j - 1] ? rows[i + j - 1][columna] : null;
                    if (valor) {
                        if (typeof valor === 'number') {
                            const fechaConvertida = excelDateToJSDate(valor);
                            horas.push(fechaConvertida.toLocaleString());
                        } else {
                            horas.push(String(valor).trim());
                        }
                    } else {
                        horas.push("");
                    }
                }
            }
            return horas;
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

            const textoPlano = extraerHoras(rows, 3); // Columna D
            const textoSalida = extraerHoras(rows, 4); // Columna E

            // Creamos un objeto para almacenar los resultados de manera estructurada
            empleados = []; // Reiniciar la variable global

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
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2">Día</th>
                                    <th class="py-2">Hora de Llegada</th>
                                    <th class="py-2">Hora de Salida</th>
                                </tr>
                            </thead>
                            <tbody>`;

                empleado.diasTrabajados.forEach((dia, index) => {
                    const horaEntrada = empleado.horasDeLlegada[index] || "No registrado";
                    const horaSalida = empleado.horasDeSalida[index] || "No registrado";
                    empleadoInfo += `
                        <tr class="bg-gray-50">
                            <td class="py-2 px-4">${dia}</td>
                            <td class="py-2 px-4">${horaEntrada}</td>
                            <td class="py-2 px-4">${horaSalida}</td>
                        </tr>`;
                });

                empleadoInfo += `</tbody></table></div>`;

                resultadosDiv.innerHTML += empleadoInfo;
            });
        }

        // Habilitar la funcionalidad de subir datos
        document.getElementById('printButton').addEventListener('click', function() {
            // Verificar si hay datos para enviar
            if (empleados.length === 0) {
                Swal.fire({
                    title: 'Error!',
                    text: 'No hay datos para subir. Por favor, carga un archivo Excel primero.',
                    icon: 'error',
                });
                return;
            }

            // Mostrar un mensaje de carga
            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = "<p>Subiendo datos, por favor espera...</p>";

            // Enviar los datos al controlador usando fetch
            fetch('../controllers/HorariosEmpleadosController.php?op=agregar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(empleados)
                })
                .then(response => response.json()) // Parsear la respuesta como JSON
                .then(data => {
                    // Manejar la respuesta del servidor
                    if (data.success) {
                        Swal.fire({
                            title: 'Éxito!',
                            text: data.message, // Mostrar el mensaje del servidor
                            icon: 'success',
                        }).then(() => {
                            window.location.reload(); // Recarga la página para ver los cambios
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message, // Mostrar el mensaje de error del servidor
                            icon: 'error',
                        });
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Hubo un error al enviar los datos.',
                        icon: 'error',
                    });
                })
                .finally(() => {
                    // Limpiar el mensaje de carga
                    resultadosDiv.innerHTML = "";
                });
        });
    </script>
</body>

</html>