$(document).ready(function() {
    $('#tbllistado').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "../controllers/TablaProductoController.php?op=listar",
            "type": "GET",
            "data": function(d) {
                d.searchValue = d.search.value;
            },
            "dataSrc": function(json) {
                return json.data || [];
            }
        },
        "columns": [
            { "data": "idMateriales" },
            { "data": "material" },
            { "data": "cantidad_inventario" },
            { "data": "valor_inventario" },
            {
                "data": null,
                "render": function(data, type, row) {
                    return `
                        <div class="flex justify-center space-x-2">
                            <button onclick="redirectToDetail(${row.idMateriales})" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Detalles
                            </button>
                            <button onclick="abrirPopupEditar(${row.idMateriales}, '${row.material.replace(/'/g, "\\'")}')" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                Editar
                            </button>
                            <button onclick="eliminarMaterial(${row.idMateriales})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Eliminar
                            </button>
                        </div>
                    `;
                },
                "orderable": false
            }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
        },
        "lengthMenu": [5, 10, 25, 50, 100],
        "pageLength": 10,
        "dom": '<"top"lf>rt<"bottom"p><"clear">',
        "info": false, // Esto elimina el mensaje "Showing X of Y entries"
        "initComplete": function() {
            // Personalización adicional del campo de búsqueda
            $('.dataTables_filter input')
                .attr('placeholder', 'Buscar...')
                .addClass('border border-gray-300 rounded px-3 py-1 ml-2');
            
            // Personalizar el texto del dropdown de lengthMenu
            $('.dataTables_length label').contents().filter(function() {
                return this.nodeType === 3; // Nodos de texto
            }).remove();
            $('.dataTables_length label').prepend('Mostrar ');
            $('.dataTables_length label').append(' registros');
        }
    });
});

// Función para redirección
function redirectToDetail(idMaterial) {
    window.location.href = `detalleMaterial.php?idMaterial=${idMaterial}`;
}