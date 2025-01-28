function eliminarEmpleado(event, identificacion) {
    event.preventDefault();
    if (confirm("¿Estás seguro de que deseas eliminar a este empleado?")) {
        $.ajax({
            url: '../controllers/EmpleadosController.php?op=eliminar',
            type: 'POST',
            data: { identificacion: identificacion },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert("Empleado eliminado correctamente.");
                    $('#tblEmpleados').DataTable().row($(`button[data-id="${identificacion}"]`).parents('tr')).remove().draw();
                } else {
                    alert("Error al eliminar el empleado: " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error al eliminar empleado:", error);
                alert("Hubo un problema al eliminar el empleado. Intenta de nuevo más tarde.");
            }
        });
    }
}

$(document).ready(function () {

    var tabla;

    function listarEmpleados() {
        if ($.fn.dataTable.isDataTable('#tblEmpleados')) {
            $('#tblEmpleados').DataTable().clear().destroy();
        }

        tabla = $('#tblEmpleados').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthChange": false,
            "searching": false,
            "paging": false,
            "ajax": {
                "url": '../controllers/EmpleadosController.php?op=listar',
                "type": 'POST',
                "dataType": 'json',
                "error": function (xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                    alert("Hubo un problema al cargar los datos de los empleados. Intenta de nuevo más tarde.");
                }
            },
            "columns": [
                { "data": "identificacion" },
                { "data": "nombre" },
                { "data": "primer_apellido" },
                { "data": "telefono1" },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return `
                            <a href="detalleEmpleado.php?identificacion=${row.identificacion}" class="btnDetalles bg-blue-500 text-white px-5 py-0 rounded-lg hover:bg-blue-600">
                                Detalles
                            </a>
                            <a href="editarEmpleado.php?id=${row.identificacion}" class="btnEditar bg-yellow-500 text-white px-5 py-0 rounded-lg hover:bg-yellow-600 ml-2">
                                Editar
                            </a>
                            <a href="javascript:void(0);" class="btnEliminar bg-red-500 text-white px-5 py-0 rounded-lg hover:bg-red-600 ml-2" 
                               onclick="eliminarEmpleado(event, ${row.identificacion})">
                                Eliminar
                            </a>
                        `;
                    }
                }
            ]
        });
    }

    // Llamar a la función para listar empleados
    listarEmpleados();

    // Botón Agregar
    $('#btnAgregar').on('click', function () {
        window.location.href = 'agregarEmpleado.php';
    });
});
;
