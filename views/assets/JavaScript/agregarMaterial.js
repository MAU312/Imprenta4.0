$(document).ready(function () {
    $('#tablaMateriales').DataTable();
});

// Función para abrir el modal
function openModal() {
    $('#modalAgregar').removeClass('hidden');
}

// Función para cerrar el modal
function closeModal() {
    $('#modalAgregar').addClass('hidden');
    $('#formAgregar')[0].reset(); // Limpiar el formulario
}

// Manejar el evento de enviar el formulario
$('#formAgregar').on('submit', function (event) {
    event.preventDefault();
    // Obtener los datos del formulario
    const nombreMaterial = $('#nombre').val();
    const cantidadDisponible = $('#cantidad').val();
    const valorInventario = $('#valor').val();

    // Lógica para agregar el material
    // Esta parte debe realizar una llamada AJAX a tu servidor para guardar los datos
    $.ajax({
        url: 'ruta/a/tu/servidor/para/agregarMaterial.php', // Cambia esta ruta
        type: 'POST',
        data: {
            nombreMaterial: nombreMaterial,
            cantidadDisponible: cantidadDisponible,
            valorInventario: valorInventario
        },
        success: function(response) {
            // Aquí puedes agregar lógica para manejar la respuesta
            console.log(response);
            closeModal();
            // Opcional: Recargar la tabla o agregar el nuevo material a la tabla
        },
        error: function(xhr, status, error) {
            console.error('Error al agregar material:', error);
        }
    });
});