<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivo Excel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gradient-to-r from-blue-50 to-indigo-100">
    <div class="flex min-h-screen bg-gray-50">
        <?php include './assets/Fragments/sidebar.php'; ?>
        <div class="flex-1 p-6">
            <div class="bg-white shadow-lg rounded-lg p-8 space-y-8">
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Subir Archivo Excel</h1>
                    <p class="text-lg text-gray-600">Carga tu archivo Excel para ver las marcas de los empleados.</p>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-center">
                        <input type="file" id="excelFile" accept=".xlsx, .xls"
                            class="border-2 border-indigo-500 p-4 rounded-lg w-2/3 bg-gray-50 text-gray-700" />
                    </div>
                    <div class="flex justify-center">
                        <button id="uploadButton" class="w-1/3 py-3 bg-indigo-500 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed" disabled>Subir Datos</button>
                    </div>
                </div>
                <div id="resultados" class="mt-8 space-y-6"></div>
            </div>
        </div>
    </div>

    <script>
        let empleados = [];

        document.getElementById('excelFile').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (!file || !file.name.match(/\.(xlsx|xls)$/)) {
                alert("Por favor, sube un archivo Excel válido.");
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, { type: 'array' });
                    const sheetName = workbook.SheetNames[0];
                    const sheet = workbook.Sheets[sheetName];
                    const rows = XLSX.utils.sheet_to_json(sheet, { header: 1 });
                    leer(rows);
                    document.getElementById('uploadButton').disabled = false;
                } catch (error) {
                    console.error("Error al procesar el archivo:", error);
                }
            };
            reader.readAsArrayBuffer(file);
        });

        function leer(rows) {
            empleados = [];
            for (let i = 5; i < rows.length; i += 18) {
                const name = rows[i] ? rows[i][4] : undefined;
                const period = rows[i + 1] ? rows[i + 1][10] : undefined;
                if (name && period) {
                    let marcas = [];
                    for (let j = 10; j < rows.length; j += 18) {
                        let diaMarcas = [];
                        for (let k = 3; k <= 12; k++) {
                            if (rows[j + (k - 3)] && rows[j + (k - 3)][k]) {
                                diaMarcas.push(rows[j + (k - 3)][k]);
                            }
                        }
                        marcas.push(diaMarcas);
                    }
                    empleados.push({ nombre: name, periodo: period, marcas: marcas });
                }
            }
            mostrarResultados();
        }

        function mostrarResultados() {
            const resultadosDiv = document.getElementById('resultados');
            resultadosDiv.innerHTML = "";
            empleados.forEach(empleado => {
                let empleadoInfo = `
                    <div class="bg-white p-6 rounded-lg shadow-lg border border-gray-200 mb-4">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">${empleado.nombre}</h3>
                        <p class="text-lg text-gray-600 mb-4">Periodo: ${empleado.periodo}</p>
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2">Día</th>
                                    <th class="py-2">Marcas</th>
                                </tr>
                            </thead>
                            <tbody>`;
                empleado.marcas.forEach((marcas, index) => {
                    empleadoInfo += `
                        <tr class="bg-gray-50">
                            <td class="py-2 px-4">Día ${index + 1}</td>
                            <td class="py-2 px-4">${marcas.join(", ") || "No registrado"}</td>
                        </tr>`;
                });
                empleadoInfo += `</tbody></table></div>`;
                resultadosDiv.innerHTML += empleadoInfo;
            });
        }
    </script>
</body>
</html>
