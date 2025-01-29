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
            </tr>
        `);
        });
    }
});