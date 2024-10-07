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
                        <a href="listar_materiales.html" class="block p-2 rounded hover:bg-gray-600">Agregar Material</a>
                    </li>
                </ul>
            </li>

            <!-- Dropdown para Reportes -->
            <li class="mb-2 relative">
                <a href="#" class="block p-2 rounded hover:bg-gray-700 flex justify-between items-center" id="reportesToggle">
                    Reportes
                    <span class="text-gray-400 ml-2 transition-transform duration-200">▼</span> <!-- Flecha -->
                </a>
                <ul id="reportesDropdown" class="hidden bg-gray-700 rounded-lg mt-2 p-2">
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Reporte 1</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block p-2 rounded hover:bg-gray-600">Reporte 2</a>
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

        document.getElementById('reportesToggle').addEventListener('click', function(e) {
            e.preventDefault(); // Evitar comportamiento predeterminado del enlace
            var dropdown = document.getElementById('reportesDropdown');
            dropdown.classList.toggle('hidden'); // Alternar visibilidad del dropdown

            // Rotar la flecha
            var arrow = this.querySelector('span');
            arrow.classList.toggle('rotate-180'); // Cambiar dirección de la flecha
        });
    </script>

    <div class="flex items-center justify-center h-16 border-t border-gray-700">
        <button class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700" id="btnCerrarSesion">Cerrar Sesión</button>
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