<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo Excel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>

<body>
    <h1>Subir Archivo Excel</h1>
    <input type="file" id="excelFile" accept=".xlsx, .xls" />
    <button id="printButton" disabled>Imprimir Nombres y Periodos</button>

    <!-- Contenedor donde se mostrarán los resultados -->
    <div id="resultados"></div>

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
            const horaSalida = []; // Nuevo array para las horas de salida

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
                        textoPlano.push(fechaConvertida.toLocaleString()); // Fecha legible
                    } else {
                        textoPlano.push(String(valor).trim()); // Si no es número, texto directo
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
                        textoSalida.push(fechaConvertida.toLocaleString()); // Fecha legible
                    } else {
                        textoSalida.push(String(valor).trim()); // Si no es número, texto directo
                    }
                } else {
                    textoSalida.push(""); // Si no hay valor, lo dejamos vacío
                }
            });

            // Creamos un objeto para almacenar los resultados de manera estructurada
            const empleados = [];

            // Recorremos las filas para extraer los nombres y los periodos
            nameRows.forEach((rowIndex, i) => {
                const name = rows[rowIndex - 1] ? rows[rowIndex - 1][4] : undefined; // Columna E
                const period = rows[periodRows[i] - 1] ? rows[periodRows[i] - 1][10] : undefined; // Columna K

                // Obtener fecha inicial del periodo
                let fechas = [];
                if (period) {
                    const [fechaInicio] = period.split(" - "); // Tomamos solo la fecha inicial
                    const [dia, mes, anio] = fechaInicio.split("/").map(Number); // Convertir a números
                    const fechaActual = new Date(anio, mes - 1, dia); // Crear fecha inicial

                    // Generar las 7 fechas consecutivas
                    const diasSemana = ["Fri", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu"];
                    fechas = diasSemana.map((diaNombre, index) => {
                        const fecha = new Date(fechaActual); // Copia de la fecha actual
                        fecha.setDate(fecha.getDate() + index); // Sumamos días
                        return `${diaNombre} - ${fecha.toLocaleDateString("es-ES")}`; // Formato de fecha
                    });
                }

                // Ahora almacenamos los datos en el objeto 'empleados' de manera estructurada
                if (name && period) {
                    const empleado = {
                        nombre: name,
                        periodo: period,
                        diasTrabajados: fechas,
                        horasDeLlegada: textoPlano.slice(i * 7, (i + 1) * 7), // Tomamos las horas correspondientes a este periodo
                        horasDeSalida: textoSalida.slice(i * 7, (i + 1) * 7) // Tomamos las horas de salida correspondientes
                    };

                    empleados.push(empleado);
                } else {
                    console.log(`Datos incompletos en la fila ${rowIndex}`);
                }
            });

            // Mostrar los datos de los empleados de manera estructurada en la página
            const resultadosDiv = document.getElementById('resultados');
            empleados.forEach(empleado => {
                let empleadoInfo = `<h2>Empleado: ${empleado.nombre}</h2>`;
                empleadoInfo += `<p><strong>Periodo: ${empleado.periodo}</strong></p>`;
                empleadoInfo += `<p><strong>Días trabajados y fechas:</strong></p><ul>`;
                
                empleado.diasTrabajados.forEach((dia, index) => {
                    const horaEntrada = empleado.horasDeLlegada[index] || "No registrado"; // Si no hay hora, mostramos "No registrado"
                    const horaSalida = empleado.horasDeSalida[index] || "No registrado"; // Lo mismo para la hora de salida
                    empleadoInfo += `<li>${dia}: Hora de llegada: ${horaEntrada}, Hora de salida: ${horaSalida}</li>`;
                });

                empleadoInfo += `</ul><hr>`;
                resultadosDiv.innerHTML += empleadoInfo;
            });
        }
    </script>
</body>

</html>
