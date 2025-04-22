<?php
session_start();

// Verifica si la sesión de 'user_nombre' está definida
$user_nombre = isset($_SESSION['user_nombre']) ? $_SESSION['user_nombre'] : 'Invitado';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="flex flex-col w-64 bg-gray-800 text-white sticky top-0 h-screen">
    <div class="flex items-center justify-center h-16 border-b border-gray-700">
        <h1 class="text-xl font-bold"><?php echo htmlspecialchars($user_nombre); ?></h1>
    </div>

    <nav class="flex-1 overflow-y-auto">
        <ul class="p-4">
            <li class="mb-2">
                <a href="../views/index.php" class="block p-2 rounded hover:bg-gray-700">
                    <i class="fas fa-home mr-2"></i> Inicio
                </a>
            </li>

            <li class="mb-2 relative">
                <a href="#" class="block p-2 rounded hover:bg-gray-700 flex justify-between items-center" id="materialesToggle">
                    <i class="fas fa-cogs mr-2"></i> Materiales
                    <span class="text-gray-400 ml-2 transition-transform duration-200">▼</span>
                </a>
                <ul id="materialesDropdown" class="hidden bg-gray-700 rounded-lg mt-2 p-2 relative left-0 w-full">
                    <li class="mb-2">
                        <a href="../views/tablaMateriales.php" class="block p-2 rounded hover:bg-gray-600">Lista Materiales</a>
                    </li>
                </ul>
            </li>

            <li class="mb-2 relative">
                <a href="#" class="block p-2 rounded hover:bg-gray-700 flex justify-between items-center" id="importacionesToggle">
                    <i class="fas fa-truck mr-2"></i> Importaciones
                    <span class="text-gray-400 ml-2 transition-transform duration-200">▼</span>
                </a>
                <ul id="importacionesDropdown" class="hidden bg-gray-700 rounded-lg mt-2 p-2 relative left-0 w-full">
                    <li class="mb-2">
                        <a href="../views/calendario.html" class="block p-2 rounded hover:bg-gray-600">Calendario</a>
                    </li>
                </ul>
            </li>

            <li class="mb-2 relative">
                <a href="#" class="block p-2 rounded hover:bg-gray-700 flex justify-between items-center" id="planillaToggle">
                    <i class="fas fa-users mr-2"></i> Planilla
                    <span class="text-gray-400 ml-2 transition-transform duration-200">▼</span>
                </a>
                <ul id="planillaDropdown" class="hidden bg-gray-700 rounded-lg mt-2 p-2 relative left-0 w-full">
                    <li class="mb-2">
                        <a href="../views/listaEmpleados.php" class="block p-2 rounded hover:bg-gray-600">Lista de Empleados</a>
                    </li>
                    <li class="mb-2">
                        <a href="../views/agregarHoras.php" class="block p-2 rounded hover:bg-gray-600">Horas Trabajadas</a>
                    </li>
                </ul>
            </li>

            <li class="mb-2">
                <a href="../views/login.php" class="block p-2 rounded hover:bg-gray-700">
                    <i class="fas fa-cogs mr-2"></i> Configuraciones
                </a>
            </li>
        </ul>
    </nav>

    <div class="flex items-center justify-center h-16 border-t border-gray-700">
        <button class="flex items-center px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition duration-200" id="btnCerrarSesion">
            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
        </button>
    </div>
</div>

<script>
    // Función para alternar visibilidad de los dropdowns
    const dropdowns = ['materiales', 'importaciones', 'planilla'];

    dropdowns.forEach(dropdown => {
        document.getElementById(`${dropdown}Toggle`).addEventListener('click', function(e) {
            e.preventDefault();
            const dropdownMenu = document.getElementById(`${dropdown}Dropdown`);
            dropdownMenu.classList.toggle('hidden');
            const arrow = this.querySelector('span');
            arrow.classList.toggle('rotate-180');
        });
    });

    // Cerrar sesión con confirmación
    document.getElementById('btnCerrarSesion').addEventListener('click', function() {
        Swal.fire({
            title: '¿Estás seguro de que quieres cerrar sesión?',
            showCancelButton: true,
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                cerrarSesion();
            }
        });
    });

    function cerrarSesion() {
        $.ajax({
            url: '../controllers/LoginController.php?op=CerrarSesion',
            type: 'GET',
            success: function(data) {
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