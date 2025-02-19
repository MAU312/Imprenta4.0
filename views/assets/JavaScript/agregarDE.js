// Manejar el evento de enviar el formulario
$('#formAgregarDetalleEntrada').off('submit').on('submit', function (event) {
    event.preventDefault();

    // Obtener los valores del formulario
    var factura = $('#factura').val();
    var proveedor = $('#proveedor').val();
    var cantidadResma = $('#cantidadResma').val();
    var pliegoResma = $('#pliegoResma').val();
    var cantidadPliego = $('#cantidadPliego').val();
    var precioPliego = $('#precioPliego').val();
    var descuento = $('#descuento').val();
    var tipoCambio = $('#tipoCambio').val();

    // Lógica para agregar 
    $.ajax({
        url: '../controllers/AgregarDEController.php?op=agregar',
        type: 'POST',
        data: {
            factura: factura,
            proveedor: proveedor,
            cantidadResma: cantidadResma,
            pliegoResma: pliegoResma,
            cantidadPliego: cantidadPliego,
            precioPliego: precioPliego,
            descuento: descuento,
            tipoCambio: tipoCambio
        },
        success: function (response) {

            try {
                response = JSON.parse(response);
            } catch (e) {
                console.error('Error al parsear la respuesta:', e);
            }

            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Guardado!',
                    text: 'Los datos del detalle de entrada fueron guardados correctamente.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Limpiar el formulario
                    $('#formAgregarDetalleEntrada')[0].reset();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Hubo un problema al guardar los datos.',
                    confirmButtonText: 'OK'
                });
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al agregar detalle de entrada:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo procesar la solicitud.',
                confirmButtonText: 'OK'
            });
        }
    });
});
