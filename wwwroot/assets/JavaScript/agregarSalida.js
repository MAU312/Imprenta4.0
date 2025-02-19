function agregarSalida() {
    var urlParams = new URLSearchParams(window.location.search);
    var idMaterial = urlParams.get('idMaterial');
    console.log("ID de Material en Popup salida:", idMaterial);
    document.getElementById('idMaterial').value = idMaterial; // Asigna el valor del idMaterial al campo oculto
    document.getElementById('popupSalida').classList.remove('hidden'); // Asegúrate de que este es el popup correcto
}

function closePopupSalida() {
    document.getElementById('popupSalida').classList.add('hidden'); // Cierra el popup correcto
}

function addSalidaMaterial() {
    var idMaterialElement = document.getElementById('idMaterial');
    console.log(idMaterialElement); // Para depuración
    var idMaterial = idMaterialElement.value;

    if (!idMaterial) {
        alert("ID de material no encontrado");
        return;
    }

    // Obtiene los valores de los campos del formulario
    var cliente = document.getElementById('cliente').value.trim();
    var ordenCorte = document.getElementById('ordenCorte').value.trim();
    var ordenProduccion = document.getElementById('ordenProduccion').value.trim();
    var cantidadPliegos = document.getElementById('cantidadPliegosSalida').value.trim();
    var precioPliego = document.getElementById('precioPliegoSalida').value.trim();
    var tipoCambio = document.getElementById('tipoCambioSalida').value.trim() || 1.00;

    // Prepara los datos para enviar a través de FormData
    var formData = new FormData();
    formData.append('cliente', cliente);
    formData.append('corte', ordenCorte);
    formData.append('produccion', ordenProduccion);
    formData.append('cantidadPliegos', cantidadPliegos);
    formData.append('precioPliego', precioPliego);
    formData.append('tipoCambio', tipoCambio);

    // Realiza la solicitud AJAX para enviar los datos al servidor
    $.ajax({
        url: '../controllers/salidaMaterialController.php?op=agregarSalida&idMaterial=' + idMaterial,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            switch (response) {
                case '1':
                    Swal.fire({
                        title: 'Éxito!',
                        text: 'Salida de material agregada exitosamente.',
                        icon: 'success',
                    }).then(() => {
                        window.location.reload(); // Recarga la página para ver los cambios
                    });
                    break;
                case '2':
                    Swal.fire({
                        title: 'Error!',
                        text: 'El material ya tiene una salida similar. Corrija e inténtelo nuevamente.',
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

    closePopupSalida(); // Cierra el popup
}
