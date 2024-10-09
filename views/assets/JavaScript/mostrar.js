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
                { "data": "idMaterial" },
                { "data": "nombreMaterial" },
                { "data": "cantidadDisponible" },
                { "data": "valorInventario" }
            ]
        });
    }

    // Llamar a la función para listar productos al cargar el documento
    listarProductosTodos();
});
