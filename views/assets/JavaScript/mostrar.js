$(document).ready(function () {
    // Inicializar la tabla DataTable
    var tabla;

    // Variable global para almacenar el ID del material que se está editando
    let materialIdActual = null;
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
                            <div class="flex justify-center space-x-2">
                                <button onclick="redirectToDetail(${row.idMateriales})" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 ease-in-out">
                                    Detalles
                                </button>
                                <button onclick="abrirPopupEditar(${row.idMateriales}, '${row.material}')" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-200 ease-in-out">
                                    Editar
                                </button>
                                <button onclick="eliminarMaterial(${row.idMateriales})" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200 ease-in-out">
                                    Eliminar
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

// Función para abrir el popup de edición
function abrirPopupEditar(idMaterial, nombreMaterial) {
    materialIdActual = idMaterial; // Guardar el ID del material
    document.getElementById('editarMaterialName').value = nombreMaterial; // Llenar el campo con el nombre actual
    document.getElementById('popupEditar').classList.remove('hidden'); // Mostrar el popup
}
// Función para cerrar el popup de edición
function cerrarPopupEditar() {
    document.getElementById('popupEditar').classList.add('hidden'); // Ocultar el popup
    materialIdActual = null; // Limpiar el ID del material
}
// Función para guardar la edición
function guardarEdicion() {
    const nuevoNombre = document.getElementById('editarMaterialName').value;
    if (!nuevoNombre) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'El nombre no puede estar vacío.',
        });
        return;
    }
    // Enviar datos al backend para actualizar el material
    $.ajax({
        url: '../controllers/TablaProductoController.php?op=editar',
        type: 'POST',
        data: { idMateriales: materialIdActual, material: nuevoNombre },
        success: function (response) {
            console.log("Respuesta del servidor:", response);
            let res = JSON.parse(response);
            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'El material se editó correctamente.',
                }).then(() => {
                    cerrarPopupEditar();
                    $('#tbllistado').DataTable().ajax.reload(null, false); // Recarga la tabla sin perder paginación
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.message || 'No se pudo editar el material.',
                });
            }
        },
        error: function (xhr, status, error) {
            console.error("Error AJAX:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al editar el material.',
            });
        }
    });
}