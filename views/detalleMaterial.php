<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Materiales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Efecto de hover en las filas de la tabla */
        #tbllistado tbody tr:hover {
            background-color: #f0f4f8;
            /* Color de fondo suave al pasar el mouse */
        }

        #popup {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            /* Fondo oscuro */
            z-index: 1000;
            /* Asegúrate de que el popup esté encima de otros elementos */
        }

        /* Estilo para el interruptor */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }
    </style>
</head>

<body class="flex bg-gray-100">
    <!-- Incluir el sidebar -->
    <?php include './assets/Fragments/sidebar.php'; ?>

    <div class="flex-1 p-6">
        <div class="flex items-center mb-6">

        <button onclick="window.history.back()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-200 ease-in-out mr-4">
        ← Atrás
        </button>

            <h1 class="text-3xl font-bold text-blue-700 flex-1" style="margin-left: 5%;">Gestión de Materiales</h1>

            <button id="btnEntradas" onclick="toggleTab('entradas')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out mr-2">Ver Entradas</button>
            <button id="btnSalidas" onclick="toggleTab('salidas')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out mr-2">VerSalidas</button>


            <button id="btnAgregarEntrada" onclick="agregarEntrada()" class="flex items-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out mr-2" style="margin-left: 5%;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Agregar Entrada
            </button>

            <!-- Oculta el botón de Agregar Salida inicialmente -->
            <button id="btnAgregarSalida" onclick="agregarSalida()" class="flex items-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out mr-2 hidden" style="margin-left: 5%;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Agregar Salida
            </button>
        </div>
        <!-- Popup -->
        <div id="popup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 w-full max-w-4xl">
                <h2 class="text-lg font-bold mb-4 text-center">Agregar Entrada de Material</h2>

                <!-- Campo oculto para el ID del material -->
                <input type="hidden" id="idMaterial" />

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="proveedor" class="block text-gray-700">Proveedor</label>
                        <input type="text" id="proveedor" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa el proveedor">

                        <label for="factura" class="block text-gray-700">Factura</label>
                        <input type="number" id="factura" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa la factura">

                        <label for="cantidadResma" class="block text-gray-700">Cantidad Resma</label>
                        <input type="number" id="cantidadResma" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa la cantidad de resmas">

                        <label for="pliegosResma" class="block text-gray-700">Pliegos por Resma</label>
                        <input type="number" id="pliegosResma" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa los pliegos por resma">
                    </div>

                    <div>
                        <label for="cantidadPliegos" class="block text-gray-700">Cantidad de Pliegos</label>
                        <input type="number" id="cantidadPliegos" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa la cantidad de pliegos">

                        <label for="precioPliego" class="block text-gray-700">Precio por Pliego</label>
                        <input type="number" id="precioPliego" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa el precio por pliego">

                        <label for="descuento" class="block text-gray-700">Descuento</label>
                        <input type="number" id="descuento" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" value="0">

                        <label for="tipoCambio" class="block text-gray-700">Tipo de Cambio</label>
                        <input type="number" id="tipoCambio" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" value="1.00">
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end mt-6">
                    <button onclick="addEntradaMaterial()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Agregar</button>
                    <button onclick="closePopup()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2">Cancelar</button>
                </div>
            </div>
        </div>

        

        <!-- Popup para agregar salida -->
        <div id="popupSalida" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 w-full max-w-4xl">
                <h2 class="text-lg font-bold mb-4 text-center">Agregar Salida de Material</h2>

                <input type="hidden" id="idMaterial"  value=""/>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="cliente" class="block text-gray-700">Cliente</label>
                        <input type="text" id="cliente" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa el cliente">

                        <label for="ordenCorte" class="block text-gray-700">Orden de Corte</label>
                        <input type="text" id="ordenCorte" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa la orden de corte">

                        <label for="ordenProduccion" class="block text-gray-700">Orden de Producción</label>
                        <input type="text" id="ordenProduccion" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa la orden de producción">

                        <label for="cantidadPliegosSalida" class="block text-gray-700">Cantidad de Pliegos</label>
                        <input type="number" id="cantidadPliegosSalida" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa la cantidad de pliegos">

                    </div>

                    <div>
                        <label for="precioPliegoSalida" class="block text-gray-700">Precio por Pliego</label>
                        <input type="number" id="precioPliegoSalida" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" placeholder="Ingresa el precio por pliego">

                        <label for="tipoCambioSalida" class="block text-gray-700">Tipo de Cambio</label>
                        <input type="number" id="tipoCambioSalida" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" value="1.00">
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end mt-6">
                    <button onclick="addSalidaMaterial()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Agregar</button>
                    <button onclick="closePopupSalida()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2">Cancelar</button>
                </div>
            </div>
        </div>

        <!-- Popup para editar detalle de entrada -->
        <div id="popupEditarEntrada" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg p-6 w-full max-w-4xl">
                <h2 class="text-lg font-bold mb-4 text-center">Editar Entrada de Material</h2>

                <!-- Campo oculto para el ID de la entrada -->
                <input type="hidden" id="idEntradaMaterial" />

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="editarProveedor" class="block text-gray-700">Proveedor</label>
                        <input type="text" id="editarProveedor" class="border border-gray-300 rounded px-3 py-2 w-full mb-4">

                        <label for="editarFactura" class="block text-gray-700">Factura</label>
                        <input type="number" id="editarFactura" class="border border-gray-300 rounded px-3 py-2 w-full mb-4">

                        <label for="editarCantidadResma" class="block text-gray-700">Cantidad Resma</label>
                        <input type="number" id="editarCantidadResma" class="border border-gray-300 rounded px-3 py-2 w-full mb-4">

                        <label for="editarPliegosResma" class="block text-gray-700">Pliegos por Resma</label>
                        <input type="number" id="editarPliegosResma" class="border border-gray-300 rounded px-3 py-2 w-full mb-4">
                    </div>

                    <div>
                        <label for="editarCantidadPliegos" class="block text-gray-700">Cantidad de Pliegos</label>
                        <input type="number" id="editarCantidadPliegos" class="border border-gray-300 rounded px-3 py-2 w-full mb-4">

                        <label for="editarPrecioPliego" class="block text-gray-700">Precio por Pliego</label>
                        <input type="number" id="editarPrecioPliego" class="border border-gray-300 rounded px-3 py-2 w-full mb-4">

                        <label for="editarDescuento" class="block text-gray-700">Descuento</label>
                        <input type="number" id="editarDescuento" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" value="0">

                        <label for="editarTipoCambio" class="block text-gray-700">Tipo de Cambio</label>
                        <input type="number" id="editarTipoCambio" class="border border-gray-300 rounded px-3 py-2 w-full mb-4" value="1.00">
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end mt-6">
                    <button onclick="guardarEdicionEntrada()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Guardar Cambios</button>
                    <button onclick="cerrarPopupEditarEntrada()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded ml-2">Cancelar</button>
                </div>
            </div>
        </div>

        <!-- Tabla de materiales -->
        <div id="diventradas" class="w-full bg-white rounded-lg shadow-lg border border-gray-300 mb-6 overflow-x-auto">
            <table id="tbllistado" class="min-w-full bg-white rounded-lg border-collapse">
                <thead class="bg-gray-200">
                    <tr class="border-b">
                        <th class="px-6 py-4 text-left text-gray-700">ID Detalle</th>
                        <th class="px-6 py-4 text-left text-gray-700">Fecha</th>
                        <th class="px-6 py-4 text-left text-gray-700">Proveedor</th>
                        <th class="px-6 py-4 text-left text-gray-700">Factura</th>
                        <th class="px-6 py-4 text-left text-gray-700">Cantidad Resma</th>
                        <th class="px-6 py-4 text-left text-gray-700">Pliegos Resma</th>
                        <th class="px-6 py-4 text-left text-gray-700">Cantidad Pliegos</th>
                        <th class="px-6 py-4 text-left text-gray-700">Precio por Pliego</th>
                        <th class="px-6 py-4 text-left text-gray-700">Subtotal</th>
                        <th class="px-6 py-4 text-left text-gray-700">Descuento</th>
                        <th class="px-6 py-4 text-left text-gray-700">Tipo de Cambio</th>
                        <th class="px-6 py-4 text-left text-gray-700">Precio Total</th>
                        <th class="px-6 py-4 text-left text-gray-700">Acciones</th>

                    </tr>
                </thead>
                <tbody id="materialTableBody" class="text-gray-700">
                    <!-- Aquí se insertarán los registros de la tabla -->
                </tbody>
            </table>
        </div>
        <!-- Tabla de salidas -->
        <div id="tablaSalidas" class="hidden w-full bg-white rounded-lg shadow-lg border border-gray-300 mb-6 overflow-x-auto">
            <table id="tblSalidas" class="min-w-full bg-white rounded-lg border-collapse">
                <thead class="bg-gray-200">
                    <tr class="border-b">
                        <th class="px-6 py-4 text-left text-gray-700">ID Detalle</th>
                        <th class="px-6 py-4 text-left text-gray-700">Fecha</th>
                        <th class="px-6 py-4 text-left text-gray-700">Cliente</th>
                        <th class="px-6 py-4 text-left text-gray-700">Corte</th>
                        <th class="px-6 py-4 text-left text-gray-700">Producción</th>
                        <th class="px-6 py-4 text-left text-gray-700">Cantidad Pliegos</th>
                        <th class="px-6 py-4 text-left text-gray-700">Precio por Pliego</th>
                        <th class="px-6 py-4 text-left text-gray-700">Tipo de Cambio</th>
                        <th class="px-6 py-4 text-left text-gray-700">Precio Total</th>
                        <th class="px-6 py-4 text-left text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody id="salidaTableBody" class="text-gray-700">
                    <!-- Aquí se insertarán los registros de la tabla de salidas -->
                </tbody>
            </table>
        </div>

    </div>
    <!-- JavaScript para manejar el CRUD -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="./assets/JavaScript/agregarEntrada.js"></script>
    <script src="./assets/JavaScript/mostrarEntrada.js"></script>
    <script src="./assets/JavaScript/editarEntrada.js"></script>
    <script src="./assets/JavaScript/agregarSalida.js"></script>
    <script src="./assets/JavaScript/mostrarSalida.js"></script>
    <script>
        // Función para mostrar u ocultar las secciones de Entradas y Salidas
function toggleTab(tab) {
    if (tab === 'entradas') {
        document.getElementById('diventradas').classList.remove('hidden');
        document.getElementById('tablaSalidas').classList.add('hidden');
        document.getElementById('btnEntradas').classList.add('bg-blue-600');
        document.getElementById('btnEntradas').classList.remove('bg-blue-500');
        document.getElementById('btnSalidas').classList.add('bg-blue-500');
        document.getElementById('btnSalidas').classList.remove('bg-blue-600');
        document.getElementById('btnAgregarEntrada').classList.remove('hidden');
        document.getElementById('btnAgregarSalida').classList.add('hidden');
        // Mostrar solo el botón de ver Salidas
        document.getElementById('btnSalidas').classList.remove('hidden');
        document.getElementById('btnEntradas').classList.add('hidden');
    } else {
        document.getElementById('diventradas').classList.add('hidden');
        document.getElementById('tablaSalidas').classList.remove('hidden');
        document.getElementById('btnSalidas').classList.add('bg-blue-600');
        document.getElementById('btnSalidas').classList.remove('bg-blue-500');
        document.getElementById('btnEntradas').classList.add('bg-blue-500');
        document.getElementById('btnEntradas').classList.remove('bg-blue-600');
        document.getElementById('btnAgregarEntrada').classList.add('hidden');
        document.getElementById('btnAgregarSalida').classList.remove('hidden');
        // Mostrar solo el botón de ver Entradas
        document.getElementById('btnEntradas').classList.remove('hidden');
        document.getElementById('btnSalidas').classList.add('hidden');
    }
}




        // Asocia el evento click al botón con id 'btnAgregarEntrada'
        document.getElementById('btnAgregarEntrada').addEventListener('click', function() {
            document.getElementById('popup').classList.remove('hidden'); // Muestra el popup
        });


        function closePopup() {
            document.getElementById('popup').classList.add('hidden');
        }

        document.getElementById('btnAgregarSalida').addEventListener('click', function() {
            document.getElementById('popupSalida').classList.remove('hidden'); // Muestra el popup
        });


        function closePopupSalida() {
            document.getElementById('popupSalida').classList.add('hidden');
        }

        function agregarEntrada() {
            let popup = document.getElementById("popup");
            popup.classList.remove("hidden"); // Mostrar el popup
        }

        function closePopup() {
            let popup = document.getElementById("popup");
            popup.classList.add("hidden"); // Ocultar el popup
        }

    </script>

</body>

</html>