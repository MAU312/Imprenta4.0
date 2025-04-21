$(document).ready(function () {
    // Obtener el idMaterial de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const idMaterial = urlParams.get('idMaterial');

    // Verificar si hay un idMaterial
    if (idMaterial) {
        // Llamar a la función para listar los detalles del material
        listarDetallesSalida(idMaterial);
    }

    // Función para cargar los detalles de salida
    function listarDetallesSalida(idMaterial) {
        $.ajax({
            url: '../controllers/salidaMaterialController.php?op=listarDetalles&idMaterial=' + idMaterial,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    llenarTablaSalidas(data.data);
                } else {
                    alert(data.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud:", error);

            }
        });
    }

    // Función para llenar la tabla de detalles de salida
    function llenarTablaSalidas(detalles) {
        let tbody = $('#salidaTableBody');
        tbody.empty(); // Limpiar tabla antes de llenarla

        detalles.forEach(detalle => {
            tbody.append(`
            <tr>
                <td class="px-6 py-4 border-b">${detalle.idDetalleSalida}</td>
                <td class="px-6 py-4 border-b">${detalle.fechaDetalle}</td>
                <td class="px-6 py-4 border-b">${detalle.cliente}</td>
                <td class="px-6 py-4 border-b">${detalle.corte}</td>
                <td class="px-6 py-4 border-b">${detalle.produccion}</td>
                <td class="px-6 py-4 border-b">${detalle.cantidadPliegos}</td>
                <td class="px-6 py-4 border-b">${detalle.precioPliego}</td>
                <td class="px-6 py-4 border-b">${detalle.tipoCambio}</td>
                <td class="px-6 py-4 border-b">${detalle.precioTotal}</td>
                <td class="px-6 py-4 border-b">
                        <div class="flex justify-center space-x-2">
                            <button onclick="abrirPopupEditarSalida(
                    '${detalle.idDetalleSalida}',
                    '${detalle.cliente}',
                    '${detalle.corte}',
                    '${detalle.produccion}',
                    '${detalle.cantidadPliegos}',
                    '${detalle.precioPliego}',
                    '${detalle.tipoCambio}'
                )" 
                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200 ease-in-out">
                    Editar
                </button>
                        </div>
                    </td>
            </tr>
        `);
        });
    }
});

// Función para abrir el popup de edición y llenar los campos con los datos existentes
function abrirPopupEditarSalida(idDetalleSalida, cliente, corte, produccion, cantidadPliegos, precioPliego, tipoCambio) {
    // Asignar los valores a los campos del popup de edición
    document.getElementById('idDetalleSalidaEditar').value = idDetalleSalida;
    document.getElementById('clienteEditar').value = cliente;
    document.getElementById('corteEditar').value = corte;
    document.getElementById('produccionEditar').value = produccion;
    document.getElementById('cantidadPliegosEditarSalida').value = cantidadPliegos;
    document.getElementById('precioPliegoEditarSalida').value = precioPliego;
    document.getElementById('tipoCambioEditarSalida').value = tipoCambio;

    // Mostrar el popup
    document.getElementById('popupEditarSalida').classList.remove('hidden');
}



// Función para cerrar el popup de edición
function cerrarPopupEditarSalida() {
    document.getElementById('popupEditarSalida').classList.add('hidden'); // Ocultar el popup
}

// Función para guardar los cambios en la base de datos
document.getElementById('guardarEditarSalida').addEventListener('click', function () {
    const idDetalleSalida = document.getElementById('idDetalleSalidaEditar').value;
    const cliente = document.getElementById('clienteEditar').value;
    const corte = document.getElementById('corteEditar').value;
    const produccion = document.getElementById('produccionEditar').value;
    const cantidadPliegos = document.getElementById('cantidadPliegosEditarSalida').value;
    const precioPliego = document.getElementById('precioPliegoEditarSalida').value;
    const tipoCambio = document.getElementById('tipoCambioEditarSalida').value;
    
    // Verificar si idMaterial está disponible
    if (!idMaterial) {
        console.error("idMaterial no está disponible.");
        return;
    }

    const datos = {
        idMaterialActual: idMaterial,
        idDetalleSalida: idDetalleSalida,
        cliente: cliente,
        corte: corte,
        produccion: produccion,
        cantidadPliegos: cantidadPliegos,
        precioPliego: precioPliego,
        tipoCambio: tipoCambio
    };

    console.log("Datos enviados al backend:", datos); // 👈 Este log
    console.log("idMaterialActual:", idMaterial); // 👈 Este log

    // Validación de los campos (opcional)
    if (cliente === "" || corte === "" || produccion === "" || cantidadPliegos === "" || precioPliego === "" || tipoCambio === "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, complete todos los campos.',
        });
        return;
    }

    // Llamada AJAX para actualizar la entrada en la base de datos
    fetch('../controllers/salidaMaterialController.php?op=editarSalida', {  // Asegúrate de cambiar esta ruta
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos)
    })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta del backend:", data); // <- Agrega esto
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'La salida se editó correctamente.',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    cerrarPopupEditar();
                    location.reload();
                });
            } else {
                // Error en la actualización con SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Hubo un problema al actualizar la salida.',
                    confirmButtonText: 'Aceptar'
                });
            }
        })
        .catch(error => {
            console.error("Error al actualizar:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `Hubo un problema al actualizar la salida. Detalle del error: ${error.message}`,
                confirmButtonText: 'Aceptar'
            });
        });
});

function eliminarMaterialEntrada(idDetalleSalida) {
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
                url: '../controllers/salidaMaterialController.php?op=eliminarSalida',
                type: 'POST',
                data: { idDetalleSalida: idDetalleSalida },
                success: function (response) {
                    console.log("Respuesta del servidor:", response);
                    let res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'La salida se eliminó correctamente.',
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.message || 'No se pudo eliminar la salida.',
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error AJAX:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema al eliminar la salida.',
                    });
                }
            });
        }
    });
}