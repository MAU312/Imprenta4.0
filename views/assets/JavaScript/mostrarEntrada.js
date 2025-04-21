$(document).ready(function () {
    // Obtener el idMaterial de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const idMaterial = urlParams.get('idMaterial');

    // Verificar si hay un idMaterial
    if (idMaterial) {
        // Llamar a la función para listar los detalles del material
        listarDetallesMaterial(idMaterial);
    }

    // Función para listar los detalles de entrada
    function listarDetallesMaterial(idMaterial) {
        $.ajax({
            url: '../controllers/entradaMaterialController.php?op=listarDetalles&idMaterial=' + idMaterial,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    llenarTablaDetalles(data.data);
                } else {
                    alert(data.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud:", error);

            }
        });
    }

    // Función para llenar la tabla de detalles de entrada
    function llenarTablaDetalles(detalles) {
        let tbody = $('#materialTableBody');
        tbody.empty(); // Limpiar tabla antes de llenarla

        detalles.forEach(detalle => {
            tbody.append(`
                <tr>
                    <td class="px-6 py-4 border-b">${detalle.idDetalleEntrada}</td>
                    <td class="px-6 py-4 border-b">${detalle.fechaDetalle}</td>
                    <td class="px-6 py-4 border-b">${detalle.proveedor}</td>
                    <td class="px-6 py-4 border-b">${detalle.factura}</td>
                    <td class="px-6 py-4 border-b">${detalle.cantidadResma}</td>
                    <td class="px-6 py-4 border-b">${detalle.pliegosResma}</td>
                    <td class="px-6 py-4 border-b">${detalle.cantidadPliegos}</td>
                    <td class="px-6 py-4 border-b">${detalle.precioPliego}</td>
                    <td class="px-6 py-4 border-b">${detalle.subtotal}</td>
                    <td class="px-6 py-4 border-b">${detalle.descuento}</td>
                    <td class="px-6 py-4 border-b">${detalle.tipoCambio}</td>
                    <td class="px-6 py-4 border-b">${detalle.precioTotal}</td>
                    <td class="px-6 py-4 border-b">
                        <div class="flex justify-center space-x-2">
                            <button onclick="abrirPopupEditar(
                    '${detalle.idDetalleEntrada}',
                    '${detalle.proveedor}',
                    '${detalle.factura}',
                    '${detalle.cantidadResma}',
                    '${detalle.pliegosResma}',
                    '${detalle.cantidadPliegos}',
                    '${detalle.precioPliego}',
                    '${detalle.descuento}',
                    '${detalle.tipoCambio}'
                )" 
                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200 ease-in-out">Editar</button>
                        </div>
                    </td>
                </tr>
            `);
        });
    }
});

// Función para abrir el popup de edición y llenar los campos con los datos existentes
function abrirPopupEditar(idDetalleEntrada, proveedor, factura, cantidadResma, pliegosResma, cantidadPliegos, precioPliego, descuento, tipoCambio) {
    // Asignar los valores a los campos del popup de edición
    document.getElementById('idDetalleEntradaEditar').value = idDetalleEntrada;
    document.getElementById('proveedorEditar').value = proveedor;
    document.getElementById('facturaEditar').value = factura;
    document.getElementById('cantidadResmaEditar').value = cantidadResma;
    document.getElementById('pliegosResmaEditar').value = pliegosResma;
    document.getElementById('cantidadPliegosEditar').value = cantidadPliegos;
    document.getElementById('precioPliegoEditar').value = precioPliego;
    document.getElementById('descuentoEditar').value = descuento;
    document.getElementById('tipoCambioEditar').value = tipoCambio;

    // Mostrar el popup
    document.getElementById('popupEditar').classList.remove('hidden');
}



// Función para cerrar el popup de edición
function cerrarPopupEditar() {
    document.getElementById('popupEditar').classList.add('hidden'); // Ocultar el popup
}

// Función para guardar los cambios en la base de datos
document.getElementById('guardarEditar').addEventListener('click', function () {
    const idDetalleEntrada = document.getElementById('idDetalleEntradaEditar').value;
    const proveedor = document.getElementById('proveedorEditar').value;
    const factura = document.getElementById('facturaEditar').value;
    const cantidadResma = document.getElementById('cantidadResmaEditar').value;
    const pliegosResma = document.getElementById('pliegosResmaEditar').value;
    const cantidadPliegos = document.getElementById('cantidadPliegosEditar').value;
    const precioPliego = document.getElementById('precioPliegoEditar').value;
    const descuento = document.getElementById('descuentoEditar').value;
    const tipoCambio = document.getElementById('tipoCambioEditar').value;

    // Verificar si idMaterial está disponible
    if (!idMaterial) {
        console.error("idMaterial no está disponible.");
        return;
    }

    // Datos a enviar
    const datos = {
        idMaterialActual: idMaterial,
        idDetalleEntrada: idDetalleEntrada,
        proveedor: proveedor,
        factura: factura,
        cantidadResma: cantidadResma,
        pliegosResma: pliegosResma,
        cantidadPliegos: cantidadPliegos,
        precioPliego: precioPliego,
        descuento: descuento,
        tipoCambio: tipoCambio,
    };

    console.log("Datos enviados al backend:", datos); // 👈 Este log
    console.log("idMaterialActual:", idMaterial); // 👈 Este log


    // Validación de los campos (opcional)
    if (proveedor === "" || factura === "" || cantidadResma === "" || pliegosResma === "" || cantidadPliegos === "" || precioPliego === "" || descuento === "" || tipoCambio === "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, complete todos los campos.',
        });
        return;
    }

    // Llamada AJAX para actualizar la entrada en la base de datos
    fetch('../controllers/entradaMaterialController.php?op=editarEntrada', {  // Asegúrate de cambiar esta ruta
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
                    text: 'La entrada se editó correctamente.',
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
                    text: data.message || 'Hubo un problema al actualizar la entrada.',
                    confirmButtonText: 'Aceptar'
                });
            }
        })
        .catch(error => {
            console.error("Error al actualizar:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: `Hubo un problema al actualizar la entrada. Detalle del error: ${error.message}`,
                confirmButtonText: 'Aceptar'
            });
        });

});

function eliminarMaterialEntrada(idDetalleEntrada) {
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
                url: '../controllers/entradaMaterialController.php?op=eliminarEntrada',
                type: 'POST',
                data: { idDetalleEntrada: idDetalleEntrada },
                success: function (response) {
                    console.log("Respuesta del servidor:", response);
                    let res = JSON.parse(response);
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: 'La entrada se eliminó correctamente.',
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
