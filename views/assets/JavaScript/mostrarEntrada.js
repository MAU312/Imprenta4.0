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
                            <button onclick="editarDetalle(${detalle.idDetalleEntrada})" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200 ease-in-out">
                                Editar
                            </button>
                            <button onclick="eliminarDetalle(${detalle.idDetalleEntrada})" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200 ease-in-out">
                                Eliminar
                            </button>
                        </div>
                    </td>
                </tr>
            `);
        });
    }
});
