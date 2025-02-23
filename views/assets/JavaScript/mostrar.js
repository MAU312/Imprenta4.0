$(document).ready(function () {
    // Inicializar la tabla DataTable
    var tabla;

    function listarProductosTodos() {
        if ($.fn.dataTable.isDataTable('#tbllistado')) {
            $('#tbllistado').DataTable().destroy();
        }
    
        // Array para acumular materiales con inventario bajo
        let materialesBajoInventario = [];
    
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
                    console.error("Respuesta del servidor:", xhr.responseText);
                    alert("Hubo un problema al cargar los productos. Intenta de nuevo más tarde.");
                }
            },
            "destroy": true,
            "iDisplayLength": 5,
            "columns": [
                { "data": "idMateriales" },
                { "data": "material" },
                {
                    "data": "cantidad_inventario",
                    "render": function (data, type, row) {
                        // Acumular materiales con inventario bajo
                        if (row.cantidad_inventario < 1000) {
                            materialesBajoInventario.push(`${row.material} (${row.cantidad_inventario} unidades)`);
                        }
                        return row.cantidad_inventario;
                    }
                },
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
            ],
            "initComplete": function () {
                // Mostrar alerta después de cargar la tabla si hay materiales con inventario bajo
                if (materialesBajoInventario.length > 0) {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'warning',
                        title: 'Inventarios bajos',
                        html: `Los siguientes materiales tienen menos de 1000 unidades en inventario:<br><br>${materialesBajoInventario.join('<br>')}`,
                        showConfirmButton: false,
                        timer: 10000,
                        timerProgressBar: true
                    });
                }
            }
        });
    }    

    // Llamar a la función para listar productos al cargar el documento
    listarProductosTodos();
});

// Función de redirección a detalleMaterial.php
function redirectToDetail(idMaterial) {
    window.location.href = `detalleMaterial.php?idMaterial=${idMaterial}`;
}