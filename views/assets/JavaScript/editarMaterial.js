
function editarMaterial() {
    const nuevoNombre = document.getElementById('editarMaterialName').value;

    if (!nuevoNombre) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El nombre no puede estar vacío.',
        });
        return;
    }

    $.ajax({
        url: '../controllers/TablaProductoController.php?op=editar',
        type: 'POST',
        data: { idMateriales: materialIdActual, material: nuevoNombre },
        success: function (response) {
            console.log("Respuesta del servidor:", response);
            let res = JSON.parse(response);
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'El material se editó correctamente.',
                }).then(() => {
                    cerrarPopupEditar();
                    $('#tbllistado').DataTable().ajax.reload(null, false);
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.message || 'No se pudo editar el material.',
                });
            }
        },
        error: function (xhr, status, error) {
            console.error("Error AJAX:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al editar el material.',
            });
        }
    });
}