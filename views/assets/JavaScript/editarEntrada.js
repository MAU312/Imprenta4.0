function editarEntrada() {
    // Obtener los valores del formulario de edición
    const idDetalleEntrada = document.getElementById('editarIdDetalleEntrada').value;
    const proveedor = document.getElementById('editarProveedor').value;
    const factura = document.getElementById('editarFactura').value;
    const cantidadResma = document.getElementById('editarCantidadResma').value;
    const pliegosResma = document.getElementById('editarPliegosResma').value;
    const cantidadPliegos = document.getElementById('editarCantidadPliegos').value;
    const precioPliego = document.getElementById('editarPrecioPliego').value;
    const descuento = document.getElementById('editarDescuento').value;
    const tipoCambio = document.getElementById('editarTipoCambio').value;

    // Validar que los campos obligatorios no estén vacíos
    if (!proveedor || !factura || !cantidadResma || !pliegosResma || !cantidadPliegos || !precioPliego) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Todos los campos obligatorios deben estar completos.',
        });
        return;
    }

    // Enviar solicitud AJAX para editar la entrada
    $.ajax({
        url: '../controllers/entradaMaterialController.php?op=editarEntrada', // Asegúrate de que la URL sea correcta
        type: 'POST',
        data: {
            idDetalleEntrada: idDetalleEntrada,
            proveedor: proveedor,
            factura: factura,
            cantidadResma: cantidadResma,
            pliegosResma: pliegosResma,
            cantidadPliegos: cantidadPliegos,
            precioPliego: precioPliego,
            descuento: descuento,
            tipoCambio: tipoCambio
        },
        success: function (response) {
            console.log("Respuesta del servidor:", response);
            let res = JSON.parse(response);
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'La entrada se editó correctamente.',
                }).then(() => {
                    cerrarPopupEditar(); // Cerrar el popup de edición
                    $('#tbllistado').DataTable().ajax.reload(null, false); // Recargar la tabla sin perder paginación
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.message || 'No se pudo editar la entrada.',
                });
            }
        },
        error: function (xhr, status, error) {
            console.error("Error AJAX:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al editar la entrada.',
            });
        }
    });
}