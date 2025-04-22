$('#Form_Login').on('submit', function (event) {
    event.preventDefault();
    $('#btnLogin').prop('disabled', true);
    var formData = new FormData($('#Form_Login')[0]);

    $.ajax({
        url: '../controllers/LoginController.php?op=Login',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json', // Indica que la respuesta es JSON

        success: function (response) {
            console.log("Respuesta del servidor:", response);
            Swal.close(); // Cerrar el loading antes de mostrar el resultado

            if (response.success) {
                let destino = '';
                switch (response.success) {
                    case 'admin':
                        destino = '../views/index.php';
                        Swal.fire({
                            title: '¡Bienvenido!',
                            text: 'Sesión Iniciada como Administrador',
                            icon: 'success',
                            confirmButtonText: 'Cerrar',
                            preConfirm: () => {
                                window.location.href = destino;
                            }
                        });
                        break;
                    case 'index':
                        destino = '../views/index.php';
                        Swal.fire({
                            title: '¡Bienvenido!',
                            text: 'Sesión Iniciada',
                            icon: 'success',
                            confirmButtonText: 'Cerrar',
                            preConfirm: () => {
                                window.location.href = destino;
                            }
                        });
                        break;
                    case 'mensajero':
                        destino = '../views/mensajero.php';
                        Swal.fire({
                            title: '¡Bienvenido!',
                            text: 'Sesión Iniciada como Mensajero',
                            icon: 'success',
                            confirmButtonText: 'Cerrar',
                            preConfirm: () => {
                                window.location.href = destino;
                            }
                        });
                        break;
                    default:
                        Swal.fire({
                            title: 'Error',
                            text: 'Rol desconocido',
                            icon: 'error',
                            confirmButtonText: 'Cerrar'
                        });
                        break;
                }
            } else if (response.error) {
                Swal.fire({
                    title: 'Error',
                    text: response.error,
                    icon: 'error',
                    confirmButtonText: 'Cerrar'
                });
            }

            $('#btnLogin').removeAttr('disabled'); // Habilitar el botón
        },
        error: function (xhr, status, error) {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema con la solicitud.',
                icon: 'error',
                confirmButtonText: 'Cerrar'
            });
            console.error('Error en la petición:', xhr.responseText);
            $('#btnLogin').removeAttr('disabled'); // Habilitar el botón incluso en error
        }
    });
});
