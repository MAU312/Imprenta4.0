$(document).ready(function () {
    // Obtener el idMaterial de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const idMaterial = urlParams.get('idMaterial');

    // Verificar si hay un idMaterial
    if (idMaterial) {
        // Llamar a la función para listar los detalles del material
        listarDetallesMaterial(idMaterial);
    }

    function listarDetallesMaterial(idMaterial) {
        $.ajax({
            url: '../controllers/entradaMaterialController.php?op=listarDetalles&idMaterial=' + idMaterial,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.success) { // Cambiado a data.success
                    // Aquí asumo que 'data.data' es un array de objetos con los detalles
                    llenarTablaDetalles(data.data); // Cambiado a data.data
                } else {
                    alert(data.message); // Mostrar mensaje si no hay detalles
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud:", error);
                alert("Hubo un problema al cargar los detalles del material. Intenta de nuevo más tarde.");
            }
        });
    }

    function llenarTablaDetalles(detalles) {
        let tbody = $('#materialTableBody');
        tbody.empty(); // Limpiar tabla antes de llenarla

        detalles.forEach(detalle => {
            // Asumiendo que 'detalle' tiene las propiedades que necesitas
            tbody.append(`
                <tr>
                    <td class="px-6 py-4 border-b">${detalle.idDetalleEntrada}</td>
                    <td class="px-6 py-4 border-b">${detalle.idMateriales}</td>
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
                </tr>
            `);
        });
    }
});
