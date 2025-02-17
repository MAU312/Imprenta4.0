function eliminarMaterial(idMaterial) {
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
            // Enviar solicitud AJAX para eliminar el material
            $.ajax({
                url: '../controllers/TablaProductoController.php?op=eliminar',
                type: 'POST',
                data: { idMateriales: idMaterial },
                success: function (response) {
                    console.log("Respuesta del servidor:", response);
                    let res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'El material se eliminó correctamente.',
                        }).then(() => {
                            $('#tbllistado').DataTable().ajax.reload(null, false); // Recargar la tabla sin perder paginación
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message || 'No se pudo eliminar el material.',
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error AJAX:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al eliminar el material.',
                    });
                }
            });
        }
    });
}