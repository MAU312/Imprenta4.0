<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo Excel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-to-r from-blue-50 to-indigo-100">

    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <?php include './assets/Fragments/sidebar.php'; ?>

        <div class="flex-1 p-6">
            <div class="bg-white shadow-lg rounded-lg p-8 space-y-8">

                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Revision de Horas</h1>
                    <p class="text-lg text-gray-600">Carga tu archivo Excel y verás la información de las horas de llegada y salida de los empleados.</p>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-center">
                        <input type="file" id="excelFile" accept=".xlsx, .xls"
                            class="border-2 border-indigo-500 p-4 rounded-lg w-2/3 bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300" />
                    </div>

                    <div class="flex justify-center">
                        <button id="printButton"
                            class="w-1/3 py-3 bg-indigo-500 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300"
                            disabled>Subir Datos</button>
                    </div>
                </div>

                <div id="resultados" class="mt-8 space-y-6">
                    <!-- Aquí se mostrarán los resultados -->
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let empleados = [];

        document.getElementById('excelFile').addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (!file || !file.name.match(/\.(xlsx|xls)$/)) {
                alert("Por favor, sube un archivo Excel válido.");
                return;
            }

            const reader = new FileReader();
            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = "<p>Procesando archivo, por favor espera...</p>";

            reader.onload = function(e) {
                try {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, { type: 'array' });
                    const sheet = workbook.Sheets[workbook.SheetNames[0]];
                    const rows = XLSX.utils.sheet_to_json(sheet, { header: 1 });

                    resultadosDiv.innerHTML = "";
                    leer(rows);

                    document.getElementById('printButton').disabled = false;
                } catch (error) {
                    console.error("Error:", error);
                    resultadosDiv.innerHTML = "<p class='text-red-500'>Error al procesar el archivo.</p>";
                }
            };

            reader.readAsArrayBuffer(file);
        });

        function excelDateToJSDate(excelDate) {
            const date = new Date((excelDate - 25569) * 86400 * 1000);
            const offset = date.getTimezoneOffset();
            return new Date(date.getTime() + offset * 60 * 1000);
        }

        function extraerHoras(rows, columna) {
            const horas = [];
            for (let i = 10; i <= rows.length; i += 18) {
                for (let j = 0; j < 7; j++) {
                    const valor = rows[i + j - 1] ? rows[i + j - 1][columna] : null;
                    if (valor) {
                        if (typeof valor === 'number') {
                            const fecha = excelDateToJSDate(valor);
                            horas.push(fecha.toLocaleString());
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
            const periodRows = [];

            for (let i = 5; i <= rows.length; i += 18) nameRows.push(i);
            for (let i = 6; i <= rows.length; i += 18) periodRows.push(i);

            const marcas = [];
            for (let col = 3; col <= 12; col++) {
                marcas.push(extraerHoras(rows, col));
            }

            empleados = [];

            nameRows.forEach((rowIndex, i) => {
                const name = rows[rowIndex - 1]?.[4];
                const period = rows[periodRows[i] - 1]?.[10];

                let fechas = [];
                if (period) {
                    const [fechaInicio] = period.split(" - ");
                    const [dia, mes, anio] = fechaInicio.split("/").map(Number);
                    const fechaActual = new Date(anio, mes - 1, dia);
                    const dias = ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"];
                    fechas = dias.map((d, index) => {
                        const fecha = new Date(fechaActual);
                        fecha.setDate(fecha.getDate() + index);
                        return `${d} - ${fecha.toLocaleDateString("es-ES")}`;
                    });
                }

                if (name && period) {
                    const empleado = {
                        nombre: name,
                        periodo: period,
                        diasTrabajados: fechas
                    };

                    marcas.forEach((marca, idx) => {
                        empleado[`horaMarca${idx + 1}`] = marca.slice(i * 7, (i + 1) * 7);
                    });

                    empleados.push(empleado);
                }
            });

            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = "";

            empleados.forEach((empleado, i) => {
                let tabla = `
                <div class="bg-white p-6 rounded-lg shadow-lg border mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">${empleado.nombre}</h3>
                    <p class="text-gray-600 mb-4">Periodo: ${empleado.periodo}</p>
                    <div class="overflow-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-indigo-100">
                                <th class="p-2 border">Día</th>
                                ${[...Array(10)].map((_, j) => `<th class="p-2 border">Marca ${j + 1}</th>`).join('')}
                            </tr>
                        </thead>
                        <tbody>`;

                empleado.diasTrabajados.forEach((dia, diaIndex) => {
                    tabla += `<tr>
                        <td class="p-2 border font-semibold">${dia}</td>`;
                    for (let marcaIndex = 1; marcaIndex <= 10; marcaIndex++) {
                        const key = `horaMarca${marcaIndex}`;
                        const hora = empleado[key][diaIndex] || "No registrado";
                        tabla += `
                        <td class="p-2 border">
                            <div contenteditable="true"
                                 class="editable"
                                 data-empleado-index="${i}"
                                 data-dia-index="${diaIndex}"
                                 data-marca-index="${marcaIndex}">
                                ${hora}
                            </div>
                        </td>`;
                    }
                    tabla += `</tr>`;
                });

                tabla += `</tbody></table></div></div>`;
                resultadosDiv.innerHTML += tabla;
            });

            document.querySelectorAll('.editable').forEach(cell => {
                cell.addEventListener('input', function(event) {
                    const value = event.target.innerText.trim();
                    const eIndex = parseInt(event.target.dataset.empleadoIndex);
                    const dIndex = parseInt(event.target.dataset.diaIndex);
                    const mIndex = parseInt(event.target.dataset.marcaIndex);
                    const key = `horaMarca${mIndex}`;
                    if (empleados[eIndex] && empleados[eIndex][key]) {
                        empleados[eIndex][key][dIndex] = value;
                    }
                });
            });
        }

        document.getElementById('printButton').addEventListener('click', () => {
            // Acá iría tu lógica para enviar los datos al servidor con AJAX
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
