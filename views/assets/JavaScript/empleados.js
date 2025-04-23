$(document).ready(function () {
    var tabla = $('#tblEmpleados').DataTable({
        "processing": true,
        "serverSide": true,
        info: false,
        "ajax": {
            "url": '../controllers/EmpleadosController.php?op=listar',
            "type": 'POST',
            "dataType": 'json',
            "data": function (d) {
                // Puedes enviar parámetros adicionales si es necesario
                d.searchValue = d.search.value;
            },
            "error": function (xhr, status, error) {
                console.error("Error en la solicitud:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al cargar los empleados. Intenta de nuevo más tarde.'
                });
            }
        },
        "columns": [
            { "data": "identificacion", "className": "text-center" },
            { "data": "nombre", "className": "text-left" },
            { "data": "primer_apellido", "className": "text-left" },
            { "data": "telefono1", "className": "text-center" },
            {
                "data": null,
                "className": "text-center",
                "orderable": false,
                "render": function (data, type, row) {
                    return `
                        <div class="flex justify-center space-x-2">
                            <a href="detalleEmpleado.php?identificacion=${row.identificacion}" 
                               class="btnDetalles bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                Detalles
                            </a>
                            <a href="editarEmpleado.php?id=${row.identificacion}" 
                               class="btnEditar bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                Editar
                            </a>
                            <button onclick="eliminarEmpleado(event, ${row.identificacion})" 
                               class="btnEliminar bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
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
        "lengthMenu": [5, 10, 25, 50],
        "pageLength": 10,
        "dom": '<"top"lf>rt<"bottom"ip><"clear">',
        "initComplete": function () {
            // Personalización del campo de búsqueda
            $('.dataTables_filter label').contents().filter(function () {
                return this.nodeType === 3;
            }).remove();
            $('.dataTables_filter label').prepend('Buscar: ');
        }
    });

    // Función de eliminación actualizada
    window.eliminarEmpleado = function (event, identificacion) {
        event.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controllers/EmpleadosController.php?op=eliminar',
                    type: 'POST',
                    data: { identificacion: identificacion },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire(
                                '¡Eliminado!',
                                'El empleado ha sido eliminado.',
                                'success'
                            );
                            tabla.ajax.reload(); // Recargar la tabla manteniendo paginación
                        } else {
                            Swal.fire(
                                'Error',
                                'Error al eliminar: ' + response.message,
                                'error'
                            );
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error al eliminar empleado:", error);
                        Swal.fire(
                            'Error',
                            'Hubo un problema al eliminar el empleado.',
                            'error'
                        );
                    }
                });
            }
        });
    };

    // Botón Agregar
    $('#btnAgregar').on('click', function () {
        window.location.href = 'agregarEmpleado.php';
    });
});