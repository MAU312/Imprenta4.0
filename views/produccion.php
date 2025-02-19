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

                <div class="border border-cyan-500 p-4 rounded-md mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                        <div>
                            <label for="agente" class="block text-sm font-medium text-gray-700">Agente:</label>
                            <input type="text" id="agente" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div class="col-span-2">
                            <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente:</label>
                            <input type="text" id="cliente" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono:</label>
                            <input type="text" id="telefono" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="fax" class="block text-sm font-medium text-gray-700">Fax:</label>
                            <input type="text" id="fax" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                            <input type="text" id="email" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cliente Aporta:</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Original</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Arte Digital</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <label for="tamano-abierto" class="block text-sm font-medium">Otro:</label>
                                    <input type="text" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="productos" class="block text-sm font-medium text-gray-700">Productos:</label>
                            <input type="text" id="productos" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="tamano-abierto" class="block text-sm font-medium text-gray-700">Medida Abierto:</label>
                            <input type="text" id="tamano-abierto" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="tamano-cerrado" class="block text-sm font-medium text-gray-700">Medida Cerrado:</label>
                            <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>
                </div>

                <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative w-1/2">
                    <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                        Pre-prensa
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Pre-prensa</label>
                            <div class="space-y-4">
                                <!-- Artes (Horas) -->
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <label for="tamano-cerrado" class="block text-sm font-medium">Artes (Horas):</label>
                                    <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>
                                <!-- Montajes 1 -->
                                <div class="flex items-center space-x-2">
                                    <label for="tamano-cerrado" class="block text-sm font-medium">Montajes 1:</label>
                                    <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>
                                <!-- Montajes 2 -->
                                <div class="flex items-center space-x-2">
                                    <label for="tamano-cerrado" class="block text-sm font-medium">Montajes 2:</label>
                                    <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>
                                <div class="flex items-center space-x-2">
                                    <label for="tamano-cerrado" class="block text-sm font-medium">Planchas Alum. 1:</label>
                                    <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>
                                <div class="flex items-center space-x-2">
                                    <label for="tamano-cerrado" class="block text-sm font-medium">Planchas Alum. 2:</label>
                                    <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>
                                <!-- Clisés (cms2) -->
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <label for="tamano-cerrado" class="block text-sm font-medium">Clisés (cms2):</label>
                                    <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>
                                <!-- Troquel (pulgada lineal) -->
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <label for="tamano-cerrado" class="block text-sm font-medium">Troquel (pulgada lineal):</label>
                                    <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative w-1/2">
                    <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                        Maquina (Prensa)
                    </div>
                    <!-- Vertical -->
                    <div class="grid grid-cols-5 gap-2 text-center">
                        <!-- Vertical -->
                        <div class="flex items-center space-x-2">
                            <label for="tamano-cerrado" class="block text-sm font-medium">Tiraje Offset 1:</label>
                            <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <!-- Vertical -->
                        <div class="flex items-center space-x-2">
                            <label for="tamano-cerrado" class="block text-sm font-medium">Tiraje Offset 2:</label>
                            <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <!-- Vertical -->
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <label for="tamano-cerrado" class="block text-sm font-medium">Numeracion:</label>
                            <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <!-- Horizontal -->
                        <div class="flex flex-wrap gap-4 col-span-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Troquelado</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Quebrado</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Medio Corte</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Plecado</span>
                            </label>
                        </div>
                        <!-- Horizontal -->
                        <div class="flex items-center space-x-2 col-span-2">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <label for="tamano-cerrado" class="block text-sm font-medium">Embozado</label>
                            <label for="tamano-cerrado" class="block text-sm font-medium">Tamaño:</label>
                            <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>
                </div>





                <div class="mt-6 grid grid-cols-2 gap-4">
                    <!-- Columna de precios alineados a la izquierda -->
                    <div class="space-y-4">
                        <div>
                            <label for="precio-cliente" class="block text-sm font-medium text-cyan-500">PRECIO AL CLIENTE:</label>
                            <input type="text" id="precio-cliente" class="mt-1 block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="precio-ac" class="block text-sm font-medium text-cyan-500">PRECIO AC:</label>
                            <input type="text" id="precio-ac" class="mt-1 block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="sobreprecio" class="block text-sm font-medium text-cyan-500">SOBREPRECIO:</label>
                            <input type="text" id="sobreprecio" class="mt-1 block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>

                    <!-- Columna derecha con Factura N°, O.P. N°, y botones de firma -->
                    <div class="space-y-4">
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <label for="factura-no" class="block text-sm font-medium text-cyan-500">Factura N°:</label>
                                <input type="text" id="factura-no" class="mt-1 block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div class="flex-1">
                                <label for="op-no" class="block text-sm font-medium text-cyan-500">O.P. N°:</label>
                                <input type="text" id="op-no" class="mt-1 block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <div class="flex-1 border border-cyan-500 rounded p-2 text-center">
                                <button class="bg-cyan-500 text-white w-full font-bold py-2 rounded-md">FIRMA AGENTE</button>
                            </div>
                            <div class="flex-1 border border-cyan-500 rounded p-2 text-center">
                                <button class="bg-cyan-500 text-white w-full font-bold py-2 rounded-md">VISTO BUENO</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</body>

</html>