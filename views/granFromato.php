<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Producción Gran Formato</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        body {
            font-family: 'Roboto', sans-serif;
        }
        .form-container {
            background-color: white;
            border: 2px solid #00a0e3;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #00a0e3;
        }
        .title {
            font-size: 36px;
            font-weight: bold;
            color: #00a0e3;
        }
        .section-title {
            background-color: #00a0e3;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .input-underline {
            border-bottom: 1px solid #00a0e3;
        }
        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .observations {
            border: 1px solid #00a0e3;
            border-radius: 5px;
        }
    </style>
</head>
<body class="bg-gray-100 p-4">
    <div class="form-container max-w-4xl mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <div class="logo">AG Servicios Gráficos</div>
            <div class="title">GRAN FORMATO</div>
            <div class="text-right">
                <div class="font-bold text-blue-500">ORDEN DE PRODUCCION</div>
                <div class="font-bold text-blue-500">N° <input type="text" class="w-16 input-underline"></div>
            </div>
        </div>

        <div class="border border-blue-500 rounded p-4 mb-4">
            <div class="grid grid-cols-3 gap-4 mb-4">
                <div>Cliente: <input type="text" class="w-full input-underline"></div>
                <div>Contacto: <input type="text" class="w-full input-underline"></div>
                <div>Ag.: <input type="text" class="w-full input-underline"></div>
                <div>Referencia: <input type="text" class="w-full input-underline"></div>
                <div>Cantidad: <input type="text" class="w-full input-underline"></div>
                <div>Tamaño Abierto: <input type="text" class="w-full input-underline"></div>
                <div>Fecha de Entrada: <input type="text" class="w-full input-underline"></div>
                <div>Fecha Entrega: <input type="text" class="w-full input-underline"></div>
                <div>Tamaño Cerrado: <input type="text" class="w-full input-underline"></div>
            </div>

            <div class="mb-4">
                <div class="font-bold text-blue-500 mb-2">Cliente Aporta:</div>
                <div class="grid grid-cols-5 gap-2">
                    <label class="checkbox-label"><input type="checkbox"> Original</label>
                    <label class="checkbox-label"><input type="checkbox"> Arte Final</label>
                    <label class="checkbox-label"><input type="checkbox"> Muestra Anterior</label>
                    <label class="checkbox-label"><input type="checkbox"> Realizar Arte</label>
                    <label class="checkbox-label"><input type="checkbox"> Realizar Modificaciones</label>
                </div>
            </div>

            <div class="mb-4">
                <div class="font-bold text-blue-500 mb-2">Cliente Requiere Aprobación de:</div>
                <div class="grid grid-cols-5 gap-2">
                    <label class="checkbox-label"><input type="checkbox"> Arte</label>
                    <label class="checkbox-label"><input type="checkbox"> Dummie</label>
                    <label class="checkbox-label"><input type="checkbox"> Imp. Digital</label>
                </div>
            </div>

            <div class="flex items-center space-x-2 mb-4">
                <div>Vía:</div>
                <label class="checkbox-label"><input type="checkbox"> Correo</label>
                <input type="text" class="w-32 input-underline">
                <label class="checkbox-label"><input type="checkbox"> Whatsapp</label>
                <input type="text" class="w-32 input-underline">
                <label class="checkbox-label"><input type="checkbox"> Domicilio</label>
                <label class="checkbox-label"><input type="checkbox"> AC</label>
            </div>

            <div class="mb-4">
                <div class="section-title mb-2">Material</div>
                <div class="grid grid-cols-4 gap-2">
                    <label class="checkbox-label"><input type="checkbox"> Vinil Promocional</label>
                    <label class="checkbox-label"><input type="checkbox"> Lona Brillante</label>
                    <label class="checkbox-label"><input type="checkbox"> Microperforado</label>
                    <label class="checkbox-label"><input type="checkbox"> Gráfica de Piso</label>
                    <label class="checkbox-label"><input type="checkbox"> Vinil Vehicular</label>
                    <label class="checkbox-label"><input type="checkbox"> Lona Mate</label>
                    <label class="checkbox-label"><input type="checkbox"> Sanblasting</label>
                    <label class="checkbox-label"><input type="text" class="w-full input-underline"></label>
                    <label class="checkbox-label"><input type="checkbox"> Vinil Respaldo Negro</label>
                    <label class="checkbox-label"><input type="checkbox"> Lona Backout</label>
                    <label class="checkbox-label"><input type="checkbox"> PVC</label>
                    <label class="checkbox-label"><input type="text" class="w-full input-underline"></label>
                    <label class="checkbox-label"><input type="checkbox"> Vinil Mate</label>
                    <label class="checkbox-label"><input type="checkbox"> Lona Traslúcida</label>
                    <label class="checkbox-label"><input type="checkbox"> Coroplast</label>
                    <label class="checkbox-label"><input type="text" class="w-full input-underline"></label>
                </div>
            </div>

            <div class="mb-4">
                <div class="section-title mb-2">Acabados</div>
                <div class="grid grid-cols-4 gap-2">
                    <label class="checkbox-label"><input type="checkbox"> Laminado</label>
                    <label class="checkbox-label"><input type="checkbox"> Corte Manual</label>
                    <label class="checkbox-label"><input type="checkbox"> Ruedos</label>
                    <label class="checkbox-label"><input type="checkbox"> Remaches</label>
                    <label class="checkbox-label"><input type="checkbox"> Brillante</label>
                    <label class="checkbox-label"><input type="checkbox"> Corte Plotter</label>
                    <label class="checkbox-label"><input type="checkbox"> Ojetes</label>
                    <label class="checkbox-label"><input type="checkbox"> Doblado</label>
                    <label class="checkbox-label"><input type="checkbox"> Mate</label>
                    <label class="checkbox-label"><input type="checkbox"> Pegado sobre <input type="text" class="w-24 input-underline"></label>
                    <label class="checkbox-label"><input type="checkbox"> Huecos</label>
                    <label class="checkbox-label"><input type="checkbox"> Vulcanizado</label>
                    <label class="checkbox-label"></label>
                    <label class="checkbox-label"></label>
                    <label class="checkbox-label"><input type="checkbox"> Roller UP</label>
                    <label class="checkbox-label"><input type="checkbox"> Araña</label>
                    <label class="checkbox-label"></label>
                    <label class="checkbox-label"></label>
                    <label class="checkbox-label"><input type="checkbox"> Instalación</label>
                </div>
            </div>

            <div>
                <div class="section-title mb-2">Observaciones</div>
                <textarea class="w-full h-24 observations p-2"></textarea>
            </div>
        </div>

        <div class="text-xs text-blue-500 mb-4">
            POR FAVOR LEER CUIDADOSAMENTE LAS ESPECIFICACIONES DE ESTA ORDEN.
        </div>

        <div class="flex justify-between items-end">
            <div>
                <div>PRECIO AL CLIENTE: <input type="text" class="w-32 input-underline"></div>
                <div>PRECIO AC: <input type="text" class="w-32 input-underline"></div>
                <div>SOBREPRECIO: <input type="text" class="w-32 input-underline"></div>
            </div>
            <div class="border border-blue-500 rounded px-4 py-1">
                Factura N°
            </div>
            <div class="text-right">
    <div>Factura N°: <input type="text" class="w-20 input-underline border-b border-blue-500"></div>
    <div>O.P. N°: <input type="text" class="w-20 input-underline border-b border-blue-500"></div>
    
    <div class="flex justify-between mt-2">
        <!-- Larger box with top-aligned label for "FIRMA AGENTE" -->
        <div class="border border-blue-500 rounded px-4 py-1 mr-2 h-24 text-top">
            <span class="block text-sm font-bold">FIRMA AGENTE</span>
        </div>
        
        <!-- Larger box with top-aligned label for "VISTO BUENO" -->
        <div class="border border-blue-500 rounded px-4 py-1 h-24 text-top">
            <span class="block text-sm font-bold">VISTO BUENO</span>
        </div>
    </div>
</div>
        </div>
    </div>
</body>
</html>