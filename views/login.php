<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-to-r from-blue-500 to-blue-800 min-h-screen flex items-center justify-center">

    <!-- Notificación personalizada -->
    <div id="notification" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg hidden">
        Sesión Iniciada Correctamente
    </div>

    <div class="bg-white bg-opacity-90 p-8 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Iniciar Sesión</h2>

        <!-- Formulario de Login -->
        <form id="Form_Login" action="#" method="POST">
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">Correo Electrónico</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ingresa tu correo"
                    required>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ingresa tu contraseña"
                    required>
            </div>

            <!-- Botón de Login -->
            <button id="btnLogin" type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                Iniciar Sesión
            </button>
        </form>
    </div>

    <!-- Archivo JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/JavaScript/login.js"></script>
</body>

</html>