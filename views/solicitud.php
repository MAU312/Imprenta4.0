<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Solicitud de Cotización</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 p-6">
    <div class="flex h-full min-h-screen">
        <?php include './assets/Fragments/sidebar.php'; ?>

        <div class="w-full max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <div class="text-cyan-500 text-4xl font-bold">
                        AG
                        <div class="text-sm">Servicios Gráficos</div>
                    </div>
                    <div class="text-center">
                        <h1 class="text-3xl font-bold text-cyan-500">Solicitud de Cotizacion</h1>
                    </div>
                    <div class="border border-cyan-500 rounded p-2">
                        <div class="text-cyan-500">N°</div>
                        <input type="text" class="w-24 border-b border-gray-300 focus:border-cyan-500 outline-none">
                    </div>
                </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <!-- Información del cliente -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Cliente:</label>
                <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Agente:</label>
                <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Fecha:</label>
                <input type="date" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Teléfono:</label>
                <input type="tel" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Fax:</label>
                <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
            </div>
        </div>

        <!-- Detalles del producto -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Producto:</label>
            <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500 mb-4">
            
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700">Cliente aporta:</label>
                    <div class="flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Original</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Arte Digital</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Otro</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Tintas y papel a utilizar -->
        <div class="border border-cyan-500 rounded-lg p-4 mb-6">
            <h2 class="text-cyan-500 font-bold mb-4">TINTAS</h2>
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tiro</label>
                    <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Retiro</label>
                    <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Papel a Utilizar</label>
                    <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pliegos</label>
                    <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>
        </div>

        <!-- Sección de Preprensa -->
        <div class="border border-cyan-500 rounded-lg p-4 mb-6">
            <h2 class="text-cyan-500 font-bold mb-4">PREPRENSA</h2>
            <div class="grid grid-cols-4 gap-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-cyan-500">
                    <span class="ml-2">Artes (Horas)</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-cyan-500">
                    <span class="ml-2">Montajes 1</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="form-checkbox text-cyan-500">
                    <span class="ml-2">Montajes 2</span>
                </label>
                <!-- Añadir más checkboxes según sea necesario -->
            </div>
        </div>

        <!-- Sección de Máquina Prensa -->
        <div class="border border-cyan-500 rounded-lg p-4 mb-6">
            <h2 class="text-cyan-500 font-bold mb-4">MAQUINA PRENSA</h2>
            <div class="grid grid-cols-4 gap-4">
                <!-- Añadir más opciones de selección -->
            </div>
        </div>

        <!-- Sección de Acabado -->
        <div class="border border-cyan-500 rounded-lg p-4">
            <h2 class="text-cyan-500 font-bold mb-4">ACABADO</h2>
            <div class="grid grid-cols-4 gap-4">
                <!-- Añadir más checkboxes según sea necesario -->
            </div>
        </div>

        <!-- Subtotal y precio -->
        <div class="mt-4">
            <label class="block text-sm font-medium text-cyan-500">SUB-TOTAL:</label>
            <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
        </div>
    </div>
</body>
</html>
