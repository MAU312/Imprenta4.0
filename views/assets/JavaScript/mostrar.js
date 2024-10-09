$(document).ready(function () {
    // Inicializar la tabla DataTable
    var tabla;

    function listarProductosTodos() {
        // Si la tabla ya existe, destruirla antes de volver a inicializar
        if ($.fn.dataTable.isDataTable('#tbllistado')) {
            $('#tbllistado').DataTable().destroy();
        }

        tabla = $('#tbllistado').DataTable({
            "processing": true,
            "serverSide": true,
            "paging": false,
            "searching": false,
            "info": false,
            "ajax": {
                "url": '../controllers/TablaProductoController.php?op=listar',
                "type": 'GET',
                "dataType": 'json',
                "error": function (xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                    alert("Hubo un problema al cargar los productos. Intenta de nuevo más tarde.");
                }
            },
            "destroy": true,
            "iDisplayLength": 5,
            "columns": [
                { "data": "idMateriales" },
                { "data": "material" },
                { "data": "cantidad_inventario" },
                { "data": "valor_inventario" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return `
                            <div class="flex justify-center">
                                <button onclick="redirectToDetail(${row.idMateriales})" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out">
                                    Detalles
                                </button>
                            </div>
                        `;
                    }
                }
            ]
        });
    }

    // Llamar a la función para listar productos al cargar el documento
    listarProductosTodos();
});

// Función de redirección a detalleMaterial.php
function redirectToDetail(idMaterial) {
    window.location.href = `detalleMaterial.php?idMaterial=${idMaterial}`;
}

