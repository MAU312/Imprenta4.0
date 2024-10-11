function addMaterial() {
    var materialName = document.getElementById('materialName').value.trim(); // Obtiene el valor del input

    // Prepara los datos para enviar
    var formData = new FormData();
    formData.append('material', materialName); // Agrega el nombre del material

    // Realiza la solicitud AJAX
    $.ajax({
        url: '../controllers/TablaProductoController.php?op=agregar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            switch (response) {
                case '1':
                    Swal.fire({
                        title: 'Éxito!',
                        text: 'Material agregado exitosamente.',
                        icon: 'success',
                    }).then(() => {
                        window.location.reload(); // Recarga la página para ver los cambios
                    });
                    break;
                case '2':
                    Swal.fire({
                        title: 'Error!',
                        text: 'El material ya existe. Corrija e inténtelo nuevamente.',
                        icon: 'warning',
                    });
                    break;
                case '3':
                    Swal.fire({
                        title: 'Error!',
                        text: 'Hubo un error al tratar de ingresar los datos.',
                        icon: 'error',
                    });
                    break;
                default:
                    Swal.fire({
                        title: 'Error!',
                        text: response,
                        icon: 'error',
                    });
                    break;
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            Swal.fire({
                title: 'Error!',
                text: 'Error al registrar la información: ' + errorThrown,
                icon: 'error',
            });
        }
    });

    closePopup(); // Cierra el popup
}
