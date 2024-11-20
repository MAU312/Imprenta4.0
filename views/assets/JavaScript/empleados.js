$(document).ready(function () {
    // Inicializar la tabla DataTable
    var tabla;

    function listarEmpleados() {
        if ($.fn.dataTable.isDataTable('#tblEmpleados')) {
            $('#tblEmpleados').DataTable().clear().destroy();
        }

        tabla = $('#tblEmpleados').DataTable({
            "processing": true,
            "serverSide": true,
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
                { "data": "numero_asegurado" },
                { "data": "nombre" },
                { "data": "primer_apellido" },
                { "data": "segundo_apellido" },
                { "data": "fecha_nacimiento" },
                { "data": "edad" },
                { "data": "telefono1" },
                { "data": "correo" },
                { "data": "sexo" },
                { "data": "estado_civil" },
                { "data": "lugar_nacimiento" },
                { "data": "nacionalidad" },
                { "data": "direccion_domicilio" },
                { "data": "telefono2" },
                { "data": "nombre_contacto1" },
                { "data": "parentesco_contacto1" },
                { "data": "telefono_contacto1" },
                { "data": "direccion_contacto1" },
                { "data": "nombre_contacto2" },
                { "data": "parentesco_contacto2" },
                { "data": "telefono_contacto2" },
                { "data": "direccion_contacto2" },
                { "data": "tipo_sangre" },
                { "data": "padecimientos" },
                { "data": "discapacidades" },
                { "data": "intervenciones" },
                { "data": "uso_aparatos" },
                { "data": "medicamentos" },
                { "data": "dosificacion" },
                { "data": "frecuencia" },
                { "data": "proposito" },
                { "data": "fecha_ingreso" },
                { "data": "jefe_supervisor" },
                { "data": "puesto_actual" },
                { "data": "ultimo_grado_estudio" },
            ]
        });
    }

    // Llamar a la función para listar empleados
    listarEmpleados();

    // Botón Agregar
    $('#btnAgregar').on('click', function () {
        window.location.href = 'agregarEmpleado.php';
    });

    // Botón Editar en la tabla
    $('#btnEditar').on('click', function () {
        const identificacion = $('#identificacionEmpleado').val().trim();
    
        if (!identificacion) {
            alert("Por favor, ingresa una identificación.");
            return;
        }
    
        // Llamar al controlador para verificar la existencia del empleado
        $.ajax({
            url: '../controllers/EmpleadosController.php?op=verificar',
            type: 'POST',
            data: { identificacion: identificacion },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    window.location.href = `editarEmpleado.php?id=${identificacion}`;
                } else {
                    alert(response.message || "El empleado no existe.");
                }
            },
            error: function () {
                alert("Ocurrió un error al verificar la identificación. Intenta nuevamente.");
            }
        });
    });
});
