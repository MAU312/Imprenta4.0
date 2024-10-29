$(document).ready(function () {
    $('#formRegistro').submit(function (e) {
        e.preventDefault(); // Previene el comportamiento predeterminado del formulario

        // Serializar los datos del formulario
        var formData = $(this).serialize();

        // Realizar la solicitud AJAX
        $.ajax({
            url: '../controllers/RegistroController.php?op=insertar', // URL del controlador y la operación a realizar
            type: 'POST',
            data: formData, // Los datos del formulario serializados
            dataType: 'json',
            success: function (response) {
                // Manejar la respuesta del servidor
                if (response.status === 'success') {
                    // Si la respuesta es exitosa, mostrar un mensaje de éxito
                    alert(response.message);
                } else if (response.status === 'error') {
                    // Si hay un error, mostrar un mensaje de error
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Manejo de errores en la solicitud AJAX
                console.error("Error en la solicitud AJAX:", error);
                alert('Ocurrió un error. Intenta nuevamente.');
            }
        });
    });
});
