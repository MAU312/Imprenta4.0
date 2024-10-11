function openPopup() {
    var urlParams = new URLSearchParams(window.location.search);
    var idMaterial = urlParams.get('idMaterial');
    document.getElementById('idMaterial').value = idMaterial; // Asigna el valor del idMaterial al campo oculto
    document.getElementById('popup').classList.remove('hidden');
}

function closePopup() {
    document.getElementById('popup').classList.add('hidden');
}

function addEntradaMaterial() {
    var idMaterial = document.getElementById('idMaterial').value; 
    if (!idMaterial) {
        alert("ID de material no encontrado");
        return;
    }

    // Obtiene los valores de los campos del formulario
    var proveedor = document.getElementById('proveedor').value.trim();
    var factura = document.getElementById('factura').value.trim();
    var cantidadResma = document.getElementById('cantidadResma').value.trim();
    var pliegosResma = document.getElementById('pliegosResma').value.trim();
    var cantidadPliegos = document.getElementById('cantidadPliegos').value.trim();
    var precioPliego = document.getElementById('precioPliego').value.trim();
    var descuento = document.getElementById('descuento').value.trim() || 0; 
    var tipoCambio = document.getElementById('tipoCambio').value.trim() || 1.00; 

    // Prepara los datos para enviar a través de FormData
    var formData = new FormData();
    formData.append('proveedor', proveedor);
    formData.append('factura', factura);
    formData.append('cantidadResma', cantidadResma);
    formData.append('pliegosResma', pliegosResma);
    formData.append('cantidadPliegos', cantidadPliegos);
    formData.append('precioPliego', precioPliego);
    formData.append('descuento', descuento);
    formData.append('tipoCambio', tipoCambio);

    // Realiza la solicitud AJAX para enviar los datos al servidor
    $.ajax({
        url: '../controllers/entradaMaterialController.php?op=agregarEntrada&idMaterial=' + idMaterial,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            switch (response) {
                case '1':
                    Swal.fire({
                        title: 'Éxito!',
                        text: 'Entrada de material agregada exitosamente.',
                        icon: 'success',
                    }).then(() => {
                        window.location.reload(); // Recarga la página para ver los cambios
                    });
                    break;
                case '2':
                    Swal.fire({
                        title: 'Error!',
                        text: 'El material ya tiene una entrada similar. Corrija e inténtelo nuevamente.',
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