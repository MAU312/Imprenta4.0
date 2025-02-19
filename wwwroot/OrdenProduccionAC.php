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

                <div class="border border-cyan-500 p-4 rounded-md mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
                        <div class="col-span-2">
                            <label for="cliente" class="block text-sm font-medium text-gray-700">Cliente:</label>
                            <input type="text" id="cliente" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="contacto" class="block text-sm font-medium text-gray-700">Contacto:</label>
                            <input type="text" id="contacto" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="agente" class="block text-sm font-medium text-gray-700">Agente:</label>
                            <input type="text" id="agente" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                        <div>
                            <label for="referencia" class="block text-sm font-medium text-gray-700">Referencia:</label>
                            <input type="text" id="referencia" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad:</label>
                            <input type="text" id="cantidad" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="tamano-abierto" class="block text-sm font-medium text-gray-700">Tamaño Abierto:</label>
                            <input type="text" id="tamano-abierto" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="fecha-entrada" class="block text-sm font-medium text-gray-700">Fecha de Entrada:</label>
                            <input type="date" id="fecha-entrada" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="fecha-entrega" class="block text-sm font-medium text-gray-700">Fecha Entrega:</label>
                            <input type="date" id="fecha-entrega" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label for="tamano-cerrado" class="block text-sm font-medium text-gray-700">Tamaño Cerrado:</label>
                            <input type="text" id="tamano-cerrado" class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
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
                                    <span class="ml-2">Imp. Litográfica</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Imp. Digital</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Vía:</label>
                            <div class="flex items-center space-x-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Correo</span>
                                </label>
                                <input type="text" placeholder="Email" class="flex-grow border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div class="flex items-center space-x-2 mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Whatsapp</span>
                                </label>
                                <input type="text" placeholder="Número" class="flex-grow border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                        </div>
                        <div>
                            <label class="ml-4 text-sm font-medium text-gray-700">Domicilio</label>
                            <input type="checkbox" class="form-checkbox text-cyan-500">
                            <label class="ml-4 text-sm font-medium text-gray-700">AC</label>
                            <input type="checkbox" class="form-checkbox text-cyan-500 ml-2">
                        </div>
                    </div>
                </div>


                <!-- Sección Pre-prensa -->
                <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative">
                    <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                        Pre-prensa
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Contenedor de OP# y opciones de Pre-prensa en columna -->
                        <div class="space-y-4">
                            <div>
                                <label for="op-num" class="block text-sm font-medium text-gray-700">OP#</label>
                                <input type="text" id="op-num" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Pre-prensa</label>
                                <div class="flex flex-col space-y-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Cisé</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Troquel</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Sarel</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Matriz UV</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Columna de opciones de Máquina en columna -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Máquina</label>
                            <div class="flex flex-col space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">G.T.O.</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">KORD</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Speed Master</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Digital</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Tipografía</span>
                                </label>
                            </div>
                        </div>

                        <!-- Columna de Espacio para Montaje y Observaciones -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Espacio para Montaje</label>
                            <div class="space-y-2">
                                <input type="text" placeholder="1." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                <input type="text" placeholder="2." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                <input type="text" placeholder="3." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                                <input type="text" placeholder="4." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            </div>
                            <label for="observaciones" class="block text-sm font-medium text-gray-700 mt-4">Observaciones:</label>
                            <input type="text" id="observaciones" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>
                </div>

                <!-- Sección Guillotina Inicial -->
                <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative">
                    <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                        Guillotina Inicial
                    </div>
                    <div class="grid grid-cols-5 gap-2 text-center">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Material</label>
                            <input type="text" placeholder="1." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="2." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="3." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="4." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Corte</label>
                            <input type="text" placeholder="1." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="2." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="3." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="4." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Aumento</label>
                            <input type="text" placeholder="1." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="2." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="3." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="4." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pliegos a Prensa</label>
                            <input type="text" placeholder="1." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="2." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="3." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="4." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pliegos Final Prensa</label>
                            <input type="text" placeholder="1." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="2." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="3." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="4." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>
                </div>

                <!-- Sección Impresión Offset -->
                <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative">
                    <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                        Impresión Offset
                    </div>
                    <div class="grid grid-cols-5 gap-4 text-center">

                        <!-- Contenedor de Descripción del Producto -->
                        <div class="border border-cyan-500 rounded-lg p-2">
                            <label class="block text-sm font-medium text-gray-700">Descrip. del Producto</label>
                            <input type="text" placeholder="1." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="2." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="3." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                            <input type="text" placeholder="4." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                        </div>

                        <!-- Contenedor de Impresión con Tiro y Retiro -->
                        <div class="col-span-2 border border-cyan-500 rounded-lg p-2">
                            <label class="block text-sm font-medium text-gray-700">Impresión</label>
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <!-- Columna Tiro -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tiro</label>
                                    <input type="text" placeholder="1." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                    <input type="text" placeholder="2." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                    <input type="text" placeholder="3." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                    <input type="text" placeholder="4." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>

                                <!-- Columna Retiro -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Retiro</label>
                                    <input type="text" placeholder="1." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                    <input type="text" placeholder="2." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                    <input type="text" placeholder="3." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                    <input type="text" placeholder="4." class="mt-1 block w-full border-gray-300 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>
                            </div>
                        </div>

                        <!-- Contenedor de V.B. Máquina -->
                        <div class="col-span-2 border border-cyan-500 rounded-lg p-2 relative">
                            <div class="flex justify-between items-center">
                                <label class="block text-sm font-medium text-gray-700">V.B. Máquina</label>
                            </div>
                            <div class="grid grid-cols-8 gap-2 text-center mt-2">
                                <!-- Etiquetas de opciones de barniz -->
                                <span class="text-sm font-medium text-gray-700">Barniz</span>
                                <span class="text-sm font-medium text-gray-700">UV</span>
                                <span class="text-sm font-medium text-gray-700">Gra</span>
                                <span class="text-sm font-medium text-gray-700">T</span>
                                <span class="text-sm font-medium text-gray-700">R</span>
                                <span class="text-sm font-medium text-gray-700">Br</span>
                                <span class="text-sm font-medium text-gray-700">Mat</span>
                                <span class="text-sm font-medium text-gray-700">Zon</span>

                                <!-- Filas de opciones de barniz con checkboxes -->
                                <span class="text-sm font-medium text-gray-700">1.</span>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>

                                <span class="text-sm font-medium text-gray-700">2.</span>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>

                                <span class="text-sm font-medium text-gray-700">3.</span>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>

                                <span class="text-sm font-medium text-gray-700">4.</span>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                                <div><input type="checkbox" class="form-checkbox text-cyan-500"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Acabados -->
                <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative">
                    <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                        Encuadernación
                    </div>
                    <div class="grid grid-cols-3 gap-4">

                        <!-- Encuadernación -->
                        <div class="border border-cyan-500 rounded-lg p-4">
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Sueltas</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Grapado</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Pegado</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Resorte</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Huecos</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Ojete</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Cordón</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Cartoné</span>
                                    </label>
                                </div>
                            </div>
                            <!-- Título de Doblado y sus opciones alineadas -->
                            <div class="text-cyan-500 font-bold text-sm mt-4 mb-2">Doblado</div>
                            <div class="grid grid-cols-3 gap-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Díptico</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Según Muestra</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox text-cyan-500">
                                    <span class="ml-2">Tríptico</span>
                                </label>
                            </div>
                        </div>

                        <!-- Columna Intermedia - Encolado y Plástico -->
                        <div class="border border-cyan-500 rounded-lg p-4">
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <div class="text-cyan-500 font-bold text-sm mb-2">Encolado:</div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Cabeza</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Abajo</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Izquierda</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Derecha</span>
                                    </label>
                                </div>
                                <div>
                                    <div class="text-cyan-500 font-bold text-sm mb-2">Plástico:</div>
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
                            </div>
                        </div>

                        <!-- Tipografía -->
                        <div class="border border-cyan-500 rounded-lg p-4 relative">
                            <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                                Tipografía
                            </div>
                            <div class="grid grid-cols-2" style="column-gap: 25px;">
                                <div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Troquelado:</span>
                                    </label>
                                    <input type="text" placeholder="Troquel #" class="mt-2 block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Quebrado</span>
                                    </label>
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Medio Corte</span>
                                    </label>
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Embazado Ciego</span>
                                    </label>
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Estampado</span>
                                    </label>
                                    <input type="text" placeholder="Estampado" class="mt-2 block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500">
                                </div>

                                <!-- Columna 2: Numeración y Perforado -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Numeración:</label>
                                    <input type="text" class="block w-full border border-cyan-500 rounded-md focus:ring-cyan-500 focus:border-cyan-500 mb-4">

                                    <div class="text-cyan-500 font-bold text-sm mb-2">Perforado:</div>
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Cabeza</span>
                                    </label>
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Abajo</span>
                                    </label>
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Izquierdo</span>
                                    </label>
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Derecho</span>
                                    </label>
                                    <label class="inline-flex items-center mt-2">
                                        <input type="checkbox" class="form-checkbox text-cyan-500">
                                        <span class="ml-2">Centro</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Empaque -->
                <div class="mt-8 border border-cyan-500 rounded-lg p-4 relative">
                    <div class="absolute -top-3 left-4 bg-cyan-500 text-white font-bold px-2 py-1 text-sm rounded">
                        Empaque
                    </div>
                    <div class="grid grid-cols-4 gap-4 items-center">
                        <!-- Primera columna de entradas -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Bolsas de</label>
                            <input type="text" class="block w-full border border-cyan-500 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            <label class="block text-sm font-medium text-gray-700">Paquetes de</label>
                            <input type="text" class="block w-full border border-cyan-500 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                        </div>

                        <!-- Segunda columna de entradas -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Fajillas de</label>
                            <input type="text" class="block w-full border border-cyan-500 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                            <label class="block text-sm font-medium text-gray-700">Cajas de</label>
                            <input type="text" class="block w-full border border-cyan-500 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                        </div>

                        <!-- Cantidad Final Total -->
                        <div class="space-y-2">
                            <div class="bg-cyan-500 text-white text-center font-bold px-2 py-1 rounded">Cantidad Final Total</div>
                            <input type="text" class="block w-full border border-cyan-500 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                        </div>

                        <!-- Factura Nº -->
                        <div class="space-y-2">
                            <div class="bg-cyan-500 text-white text-center font-bold px-2 py-1 rounded">Factura Nº</div>
                            <input type="text" class="block w-full border border-cyan-500 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
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