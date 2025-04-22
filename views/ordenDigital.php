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
                    <h1 class="text-3xl font-bold text-cyan-500">DIGITAL</h1>
                    <div class="text-xl font-semibold text-cyan-500">ORDEN DE PRODUCCION</div>
                </div>
                <div class="border border-cyan-500 rounded p-2">
                    <div class="text-cyan-500">N°</div>
                    <input type="text" class="w-24 border-b border-gray-300 focus:border-cyan-500 outline-none">
                </div>
            </div>

            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente:</label>
                        <input type="text" id="cliente" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>
                    <div>
                        <label for="contacto" class="block text-sm font-medium text-gray-700">Contacto:</label>
                        <input type="text" id="contacto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia:</label>
                        <input type="text" id="referencia" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>
                    <div>
                        <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad:</label>
                        <input type="text" id="cantidad" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>
                    <div>
                        <label for="tamano-abierto" class="block text-sm font-medium text-gray-700">Tamaño Abierto:</label>
                        <input type="text" id="tamano-abierto" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="fecha-entrada" class="block text-sm font-medium text-gray-700">Fecha de Entrada:</label>
                        <input type="date" id="fecha-entrada" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>
                    <div>
                        <label for="fecha-entrega" class="block text-sm font-medium text-gray-700">Fecha Entrega:</label>
                        <input type="date" id="fecha-entrega" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>
                    <div>
                        <label for="tamano-cerrado" class="block text-sm font-medium text-gray-700">Tamaño Cerrado:</label>
                        <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente Aporta:</label>
                        <div class="flex flex-wrap gap-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Original</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Arte Final</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Muestra Anterior</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Realizar Arte</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Realizar Modificaciones</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente Requiere Aprobación de:</label>
                        <div class="flex flex-wrap gap-4">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Arte</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Dummie</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Imp. Digital</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vía:</label>
                        <div class="flex items-center space-x-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Correo</span>
                            </label>
                            <input type="text" placeholder="Email" class="flex-grow border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2 mt-5">
                            <label class="inline-flex items-center">
                                <input type="checkbox" class="form-checkbox text-cyan-500">
                                <span class="ml-2">Whatsapp</span>
                            </label>
                            <input type="text" class="w-24 border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative">
                <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                    Impresión
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Full Color</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Negro</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">T/R</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Solo Tiro</span>
                        </label>
                    </div>
                    <div class="col-span-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="tiempo-arte" class="block text-sm font-medium text-gray-700">Tiempo Arte:</label>
                                <div class="flex items-center">
                                    <input type="text" id="tiempo-arte" class="flex-grow border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                    <span class="ml-2">mins.</span>
                                </div>
                            </div>
                            <div>
                                <label for="cantidad-pliegos" class="block text-sm font-medium text-gray-700">Cantidad de Pliegos:</label>
                                <input type="text" id="cantidad-pliegos" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tamaño:</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">8.5x11"</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">8.5x13"</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Cuarto Pliego</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="mini-banner" class="block text-sm font-medium text-gray-700">Mini Banner:</label>
                                <div class="flex items-center space-x-2">
                                    <input type="text" id="mini-banner-x" class="w-20 border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                    <span>x</span>
                                    <input type="text" id="mini-banner-y" class="w-20 border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                    <span>pulg.</span>
                                </div>
                            </div>
                            <div>
                                <label for="otro" class="block text-sm font-medium text-gray-700">Otro:</label>
                                <input type="text" id="otro" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="observaciones" class="block text-sm font-medium text-gray-700">Observaciones:</label>
                            <input type="text" id="observaciones" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative">
                <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                    Papel
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Bond 24</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            
                            <span class="ml-2">Ledger 28</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Ledger 32</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Bristol</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Opalina</span>
                        </label>
                    </div>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Adh. Brillante</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Adh. Mate</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Couché 150 Brillo</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Couché 200 Brillo</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Couché 250 Brillo</span>
                        </label>
                    </div>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Mate</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Mate</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Mate</span>
                        </label>
                    </div>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Lino</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">C-12</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">C-12/2</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">C-14</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">C-14/2</span>
                        </label>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="otro-papel" class="block text-sm font-medium text-gray-700">Otro:</label>
                    <input type="text" id="otro-papel" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>

            <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative">
                <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                    Acabados
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Doblado</span>
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Díptico</span>
                        </label>
                        <label class="inline-flex items-center ml-4">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Tríptico</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Según Muestra</span>
                        </label>
                    </div>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Plástico</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Mate</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Brillante</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Un lado</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Dos lados</span>
                        </label>
                    </div>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Encapsulado</span>
                        </label>
                        <div class="flex items-center">
                            <input type="text" id="encapsulado-micras" class="w-20 border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            <span class="ml-2">micras</span>
                        </div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">Scodix</span>
                        </label>
                    </div>
                    <div class="space-y-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">GUILLOTINA</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <span class="ml-2">CAMEO:</span>
                        </label>
                        <div class="flex items-center">
                            <label for="tiempo-acabados" class="mr-2">Tiempo:</label>
                            <input type="text" id="tiempo-acabados" class="w-20 border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-xs italic">
                POR FAVOR LEER CUIDADOSAMENTE LAS ESPECIFICACIONES DE ESTA ORDEN.
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="precio-cliente" class="block text-sm font-medium text-gray-700">PRECIO AL CLIENTE:</label>
                    <input type="text" id="precio-cliente" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                </div>
                <div>
                    <label for="precio-ac" class="block text-sm font-medium text-gray-700">PRECIO AC:</label>
                    <input type="text" id="precio-ac" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                </div>
                <div>
                    <label for="sobreprecio" class="block text-sm font-medium text-gray-700">SOBREPRECIO:</label>
                    <input type="text" id="sobreprecio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="factura-no" class="block text-sm font-medium text-gray-700">Factura N°:</label>
                    <input type="text" id="factura-no" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                </div>
                <div class="border border-cyan-500 rounded p-2">
                    <div class="text-center font-bold">FIRMA AGENTE</div>
                </div>
                <div class="border border-cyan-500 rounded p-2">
                    <div class="text-center font-bold">VISTO BUENO</div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>