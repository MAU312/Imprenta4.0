$(document).ready(function () {
    // Inicializar la tabla DataTable
    var tabla;

    function listarDetallesEntrada() {
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
                "url": '../controllers/TablaDetalleEntradaController.php?op=listar',
                "type": 'GET',
                "dataType": 'json',
                "error": function (xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                    alert("Hubo un problema al cargar los detalles de entrada. Intenta de nuevo más tarde.");
                }
            },
            "destroy": true,
            "iDisplayLength": 5,
            "columns": [
                { "data": "idDetalleEntrada" }, 
                { "data": "idMaterial" }, 
                { "data": "fechaDetalle" },
                { "data": "proveedor" }, 
                { "data": "factura" }, 
                { "data": "cantidadResma" }, 
                { "data": "pliegosResma" }, 
                { "data": "cantidadPliegos" },
                { "data": "precioPliego" }, 
                { "data": "subtotal" }, 
                { "data": "descuento" }, 
                { "data": "tipoCambio" }, 
                { "data": "precioTotal" } 
            ]
        });
    }

    // Llamar a la función para listar detalles de entrada al cargar el documento
    listarDetallesEntrada();
});
