$(document).ready(function () {
    // Inicializar la tabla DataTable
    var tabla;

    function listarRegistrosTodos() {
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
                "url": '../controllers/RegistroMarcadorController.php?op=listar',
                "type": 'GET',
                "dataType": 'json',
                "error": function (xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                    alert("Hubo un problema al cargar los registros. Intenta de nuevo más tarde.");
                }
            },
           
            "iDisplayLength": 5,
            "columns": [
                { "data": "idMarcador" },
                { "data": "colaborador" },
                { "data": "viernes_entrada" },
                { "data": "viernes_salida" },
                { "data": "lunes_entrada" },
                { "data": "lunes_salida" },
                { "data": "martes_entrada" },
                { "data": "martes_salida" },
                { "data": "miercoles_entrada" },
                { "data": "miercoles_salida" },
                { "data": "jueves_entrada" },
                { "data": "jueves_salida" },
                { "data": "sabado_entrada" },
                { "data": "sabado_salida" },
                { "data": "debe_horas" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return `
                            <div class="flex justify-center">
                                <button onclick="redirectToDetail(${row.idMarcador})" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out">
                                    Detalles
                                </button>
                            </div>
                        `;
                    }
                }
            ]
        });
    }

    // Llamar a la función para listar los registros al cargar el documento
    listarRegistrosTodos();
});

// Función de redirección a detalleRegistro.php
function redirectToDetail(idMarcador) {
    window.location.href = `detalleRegistro.php?idMarcador=${idMarcador}`;
}
