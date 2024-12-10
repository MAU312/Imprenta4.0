<?php
// Asegúrate de iniciar la sesión al comienzo del archivo
session_start();

// Verifica si la sesión de 'user_nombre' está definida
if (isset($_SESSION['user_nombre'])) {
    $user_nombre = $_SESSION['user_nombre'];
} else {
    $user_nombre = 'Invitado'; // Valor por defecto si no hay sesión
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- sidebar.php -->
<div class="flex flex-col w-64 h-screen bg-gray-800 text-white">
    <div class="flex items-center justify-center h-16 border-b border-gray-700">
        <h1 class="text-xl font-bold"><?php echo htmlspecialchars($user_nombre); ?></h1>
    </div>
    <nav class="flex-1 overflow-y-auto">
        <ul class="p-4">
            <li class="mb-2">
                <a href="../views/index.php" class="block p-2 rounded hover:bg-gray-700">Inicio</a>
            </li>

            <!-- Dropdown para Materiales -->
            <li class="mb-2 relative">
                <a href="#" class="block p-2 rounded hover:bg-gray-700 flex justify-between items-center" id="materialesToggle">
                    Materiales
                    <span class="text-gray-400 ml-2 transition-transform duration-200">▼</span> <!-- Flecha -->
                </a>
                <ul id="materialesDropdown" class="hidden bg-gray-700 rounded-lg mt-2 p-2">
                    <li class="mb-2">
                        <a href="../views/tablaMateriales.php" class="block p-2 rounded hover:bg-gray-600">Lista Materiales</a>
                    </li>
                    <li class="mb-2">
                        <a href="listar_materiales.html" class="block p-2 rounded hover:bg-gray-600">Entrada Material</a>
                    </li>
                    <li class="mb-2">
                        <a href="listar_materiales.html" class="block p-2 rounded hover:bg-gray-600">Salida Material</a>
                    </li>
                </ul>
            </li>

            <!-- Dropdown para Importaciones -->
            <li class="mb-2 relative">
                <a href="#" class="block p-2 rounded hover:bg-gray-700 flex justify-between items-center" id="importacionesToggle">
                    Importaciones
                    <span class="text-gray-400 ml-2 transition-transform duration-200">▼</span> <!-- Flecha -->
                </a>
                <ul id="importacionesDropdown" class="hidden bg-gray-700 rounded-lg mt-2 p-2">
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Calendario</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Reporte 2</a>
                    </li>
                </ul>
            </li>

            <!-- Dropdown para Planilla -->
            <li class="mb-2 relative">
                <a href="#" class="block p-2 rounded hover:bg-gray-700 flex justify-between items-center" id="planillaToggle">
                    Planilla
                    <span class="text-gray-400 ml-2 transition-transform duration-200">▼</span> <!-- Flecha -->
                </a>
                <ul id="planillaDropdown" class="hidden bg-gray-700 rounded-lg mt-2 p-2">
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Lista de Empleados</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Reporte 2</a>
                    </li>
                </ul>
            </li>

            <!-- Dropdown para Produccion -->
            <li class="mb-2 relative">
                <a href="#" class="block p-2 rounded hover:bg-gray-700 flex justify-between items-center" id="produccionToggle">
                    Produccion
                    <span class="text-gray-400 ml-2 transition-transform duration-200">▼</span> <!-- Flecha -->
                </a>
                <ul id="produccionDropdown" class="hidden bg-gray-700 rounded-lg mt-2 p-2">
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Orden de Produccion AC</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Gran Formato</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Digital</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Solicitud de Cotización</a>
                    </li>
                </ul>
            </li>

            <li class="mb-2">
                <a href="#" class="block p-2 rounded hover:bg-gray-700">Configuraciones</a>
            </li>
        </ul>
    </nav>

    <script>
        // Función para alternar visibilidad del dropdown
        document.getElementById('materialesToggle').addEventListener('click', function(e) {
            e.preventDefault(); // Evitar comportamiento predeterminado del enlace
            var dropdown = document.getElementById('materialesDropdown');
            dropdown.classList.toggle('hidden'); // Alternar visibilidad del dropdown

            // Rotar la flecha
            var arrow = this.querySelector('span');
            arrow.classList.toggle('rotate-180'); // Cambiar dirección de la flecha
        });

        document.getElementById('importacionesToggle').addEventListener('click', function(e) {
            e.preventDefault(); // Evitar comportamiento predeterminado del enlace
            var dropdown = document.getElementById('importacionesDropdown');
            dropdown.classList.toggle('hidden'); // Alternar visibilidad del dropdown

            // Rotar la flecha
            var arrow = this.querySelector('span');
            arrow.classList.toggle('rotate-180'); // Cambiar dirección de la flecha
        });

        document.getElementById('planillaToggle').addEventListener('click', function(e) {
            e.preventDefault(); // Evitar comportamiento predeterminado del enlace
            var dropdown = document.getElementById('planillaDropdown');
            dropdown.classList.toggle('hidden'); // Alternar visibilidad del dropdown

            // Rotar la flecha
            var arrow = this.querySelector('span');
            arrow.classList.toggle('rotate-180'); // Cambiar dirección de la flecha
        });

        document.getElementById('produccionToggle').addEventListener('click', function(e) {
            e.preventDefault(); // Evitar comportamiento predeterminado del enlace
            var dropdown = document.getElementById('produccionDropdown');
            dropdown.classList.toggle('hidden'); // Alternar visibilidad del dropdown

            // Rotar la flecha
            var arrow = this.querySelector('span');
            arrow.classList.toggle('rotate-180'); // Cambiar dirección de la flecha
        });
    </script>

    <div class="flex items-center justify-center h-16 border-t border-gray-700">
        <button class="flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition duration-200" id="btnCerrarSesion">
            <i class="fas fa-sign-out-alt mr-2"></i> <!-- Icono de cerrar sesión -->
            Cerrar Sesión
        </button>
    </div>

</div>

<script>
    document.getElementById('btnCerrarSesion').addEventListener('click', function() {
        cerrarSesion();
    });

    function cerrarSesion() {
        $.ajax({
            url: '../controllers/LoginController.php?op=CerrarSesion', // Ajusta la ruta según tu estructura
            type: 'GET',
            success: function(data) {
                // Redirigir a la página de inicio de sesión después de cerrar la sesión
                window.location.href = '../views/login.php';
                console.log('Sesión cerrada con éxito');
            },
            error: function(e) {
                alert('Hubo un error al intentar cerrar la sesión. Intenta de nuevo.');
                console.log(e.responseText);
            }
        });
    }
</script>