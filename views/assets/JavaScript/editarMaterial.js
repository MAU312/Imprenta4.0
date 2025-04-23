function editarMaterial(idMaterial, nombreActual) {
    const nuevoNombre = document.getElementById('editarMaterialName').value.trim();
    document.getElementById('popupEditar').classList.add('hidden');
    // Validación mejorada
    if (!nuevoNombre) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El nombre no puede estar vacío.',
            confirmButtonColor: '#3b82f6'
        });
        return;
    }

    // Verificar si hubo cambios reales
    if (nuevoNombre === nombreActual) {
        Swal.fire({
            icon: 'info',
            title: 'Sin cambios',
            text: 'No se realizaron modificaciones al nombre.',
            confirmButtonColor: '#3b82f6'
        });
        cerrarPopupEditar();
        return;
    }

    // Mostrar carga
    Swal.showLoading();

    // Configurar los datos a enviar
    const datos = {
        idMateriales: idMaterial,
        material: nuevoNombre
    };

    // Enviar como JSON
    fetch('../controllers/TablaProductoController.php?op=editar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: data.message || 'Material actualizado correctamente',
                confirmButtonColor: '#3b82f6'
            }).then(() => {
                $('#tbllistado').DataTable().ajax.reload(null, false);
            });
        } else {
            throw new Error(data.message || 'Error al actualizar');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.message || 'Hubo un problema al editar el material',
            confirmButtonColor: '#3b82f6'
        });
    })
    .finally(() => {
        Swal.hideLoading();
    });
}