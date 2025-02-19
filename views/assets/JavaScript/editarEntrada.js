function editarEntrada() {
    const idDetalleEntrada = document.getElementById('editarEntradaIdDetalle').value;
    const idMateriales = document.getElementById('editarEntradaIdMaterial').value;
    const proveedor = document.getElementById('editarEntradaProveedor').value;
    const factura = document.getElementById('editarEntradaFactura').value;
    const cantidadResma = document.getElementById('editarEntradaCantidadResma').value;
    const pliegosResma = document.getElementById('editarEntradaPliegosResma').value;
    const cantidadPliegos = document.getElementById('editarEntradaCantidadPliegos').value;
    const precioPliego = document.getElementById('editarEntradaPrecioPliego').value;
    const descuento = document.getElementById('editarEntradaDescuento').value;
    const tipoCambio = document.getElementById('editarEntradaTipoCambio').value;

    // Verificar que todos los campos requeridos no estén vacíos
    if (!idDetalleEntrada || !idMateriales || !proveedor || !factura || !cantidadResma || !pliegosResma || !cantidadPliegos || !precioPliego || !descuento || !tipoCambio) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Todos los campos deben ser llenados.',
        });
        return;
    }

    // Crear un objeto con los datos para enviar al servidor
    const data = {
        idDetalleEntrada: idDetalleEntrada,
        idMateriales: idMateriales,
        proveedor: proveedor,
        factura: factura,
        cantidadResma: cantidadResma,
        pliegosResma: pliegosResma,
        cantidadPliegos: cantidadPliegos,
        precioPliego: precioPliego,
        descuento: descuento,
        tipoCambio: tipoCambio
    };

    $.ajax({
        url: '../controllers/TablaProductoController.php?op=editar', // URL del controlador
        type: 'POST', // Método de la solicitud
        data: data, // Enviar los datos al servidor
        success: function (response) {
            console.log("Respuesta del servidor:", response);
            let res = JSON.parse(response);
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'La entrada se editó correctamente.',
                }).then(() => {
                    cerrarPopupEditar(); // Función que cierra el popup de edición
                    $('#tbllistado').DataTable().ajax.reload(null, false); // Recargar la tabla con los nuevos datos
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
