function eliminarEntrada(idDetalleEntrada) {
    // Confirmar antes de eliminar
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar solicitud AJAX para eliminar la entrada
            $.ajax({
                url: '../controllers/entradaMaterialController.php?op=eliminarEntrada', // Cambia la URL para llamar a la operación correcta
                type: 'POST',
                data: { idDetalleEntrada: idDetalleEntrada }, // Envía el ID de la entrada
                success: function (response) {
                    console.log("Respuesta del servidor:", response);
                    let res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'La entrada se eliminó correctamente.', // Mensaje actualizado
                        }).then(() => {
                            $('#tbllistado').DataTable().ajax.reload(null, false); // Recargar la tabla sin perder paginación
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message || 'No se pudo eliminar la entrada.', // Mensaje actualizado
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error AJAX:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al eliminar la entrada.', // Mensaje actualizado
                    });
                }
            });
        }
    });
}