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

        success: function (datos) {
            console.log("Respuesta del servidor:", datos);
            Swal.close(); // Cerrar el loading antes de mostrar el resultado
            switch (datos) {
                case 'admin':
                    Swal.fire({
                        title: '¡Bienvenido!',
                        text: 'Sesión Iniciada como Administrador',
                        icon: 'success',
                        confirmButtonText: 'Cerrar',
                        customClass: {
                            popup: 'bg-white rounded-lg p-4 shadow-lg',
                            confirmButton: 'bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700'
                        },
                        preConfirm: () => {
                            window.location.href = '../views/index.php';
                        }
                    });
                    break;
                case 'index':
                    Swal.fire({
                        title: '¡Bienvenido!',
                        text: 'Sesión Iniciada',
                        icon: 'success',
                        confirmButtonText: 'Cerrar',
                        preConfirm: () => {
                            window.location.href = '../views/index.php';
                        }
                    });
                    break;
                case 'mensajero':
                    Swal.fire({
                        title: '¡Bienvenido!',
                        text: 'Sesión Iniciada como Mensajero',
                        icon: 'success',
                        confirmButtonText: 'Cerrar',
                        preConfirm: () => {
                            window.location.href = '../views/mensajero.php';
                        }
                    });
                    break;
                case '4':
                    Swal.fire({
                        title: 'Error',
                        text: 'Credenciales incorrectas',
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                    });
                    break;
                default:
                    Swal.fire({
                        title: 'Error',
                        text: datos, // Cambiado aquí
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                    });
                    break;
            }
            $('#btnLogin').removeAttr('disabled'); // Asegúrate de que esto se ejecute siempre
        }
    });
});
