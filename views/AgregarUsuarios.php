<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-800 text-white">

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-gray-700 p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Registrar Usuario</h1>

        <form id="formRegistro" method="POST"> <!-- Cambié el ID del formulario a "formRegistro" -->
            <div class="mb-4">
                <label for="nombreUsu" class="block mb-2 text-sm font-medium">Nombre de Usuario</label>
                <input type="text" id="nombreUsu" name="nombreUsu" class="w-full p-3 bg-gray-600 border border-gray-600 rounded focus:outline-none focus:border-blue-500" placeholder="Nombre de usuario" required>
            </div>

            <div class="mb-4">
                <label for="nombre" class="block mb-2 text-sm font-medium">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full p-3 bg-gray-600 border border-gray-600 rounded focus:outline-none focus:border-blue-500" placeholder="Nombre" required>
            </div>

            <div class="mb-4">
                <label for="apellido" class="block mb-2 text-sm font-medium">Primer Apellido</label>
                <input type="text" id="apellido" name="apellido" class="w-full p-3 bg-gray-600 border border-gray-600 rounded focus:outline-none focus:border-blue-500" placeholder="Primer apellido" required>
            </div>

            <div class="mb-4">
                <label for="apellido2" class="block mb-2 text-sm font-medium">Segundo Apellido</label>
                <input type="text" id="apellido2" name="apellido2" class="w-full p-3 bg-gray-600 border border-gray-600 rounded focus:outline-none focus:border-blue-500" placeholder="Segundo apellido" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="w-full p-3 bg-gray-600 border border-gray-600 rounded focus:outline-none focus:border-blue-500" placeholder="Correo electrónico" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-2 text-sm font-medium">Contraseña</label> <!-- Cambié el ID a "password" para coincidir con el JS -->
                <input type="password" id="password" name="clave" class="w-full p-3 bg-gray-600 border border-gray-600 rounded focus:outline-none focus:border-blue-500" placeholder="Contraseña" required>
            </div>

            <div class="mb-4">
                <label for="activo" class="block mb-2 text-sm font-medium">Activo</label>
                <select id="activo" name="activo" class="w-full p-3 bg-gray-600 border border-gray-600 rounded focus:outline-none focus:border-blue-500" required>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="idRol" class="block mb-2 text-sm font-medium">Rol</label> <!-- Cambié el ID a "idRol" para coincidir con el JS -->
                <select id="idRol" name="Rol" class="w-full p-3 bg-gray-600 border border-gray-600 rounded focus:outline-none focus:border-blue-500" required>
                    <option value="">Seleccionar rol</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                    <option value="3">Supervisor</option>
                </select>
            </div>

            <div class="flex justify-between items-center">
                <button id="btnRegistrar" name="btnRegistrar" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:ring-blue-300" type="submit">Registrar</button>
                
                <a href="./TablaUsuarios.php" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Volver</a>
            </div>
        </form>

        <div id="mensaje" class="mt-4"></div> <!-- Para mostrar mensajes -->
    </div>
</div>
<script src="./assets/JavaScript/agregarUsuario.js"></script>

</body>
</html>
