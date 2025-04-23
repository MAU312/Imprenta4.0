<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario de Importaciones</title>
  <link href="./assets/css/style.css" rel="stylesheet" />
  <script src="./assets/JavaScript/sweetalert2.all.min.js"></script>
  <link href="./assets/JavaScript/fullcalendar/lib/main.css" rel="stylesheet" />
  <script src="./assets/JavaScript/fullcalendar/lib/main.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="./assets/JavaScript/fullcalendar/lib/locales/es.js"></script>
  <style>
    .fc-license-message {
      display: none !important;
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: '100%', // Se ajusta la altura al 100% del contenedor disponible
        contentHeight: 'auto',
        events: '../controllers/fetchEvents.php',
        locale: 'es',
        selectable: true,
        editable: true, // Habilita drag and drop y redimensionamiento
        // Evento cuando se mueve un evento
        eventDrop: function(info) {
          updateEventDate(info.event);
        },
        // Evento cuando se redimensiona un evento
        eventResize: function(info) {
          updateEventDate(info.event);
        },
        select: async function(start, end, allDay) {
          const {
            value: formValues
          } = await Swal.fire({
            title: 'Añadir evento de importación',
            confirmButtonText: 'Guardar',
            showCloseButton: true,
            showCancelButton: true,
            html: `
              <div class="space-y-3 text-left">
                <input id="swalEvtTitle" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Ingresar título">
                <textarea id="swalEvtDesc" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Ingresar información"></textarea>
                <input id="swalEvtURL" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Agregar URL de rastreo">
              </div>`,
            focusConfirm: false,
            preConfirm: () => {
              return [
                document.getElementById('swalEvtTitle').value,
                document.getElementById('swalEvtDesc').value,
                document.getElementById('swalEvtURL').value
              ]
            },
            customClass: {
              confirmButton: 'bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded ml-2',
              cancelButton: 'bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded ml-2',
            },
            buttonsStyling: false
          });

          if (formValues) {
            // Add event
            fetch("../controllers/eventHandler.php", {
                method: "POST",
                headers: {
                  "Content-Type": "application/json"
                },
                body: JSON.stringify({
                  request_type: 'addEvent',
                  start: start.startStr,
                  end: start.endStr,
                  event_data: formValues
                }),
              })
              .then(response => response.json())
              .then(data => {
                if (data.status == 1) {
                  Swal.fire('Evento añadido correctamente!', '', 'success');
                } else {
                  Swal.fire(data.error, '', 'error');
                }

                // Refetch events from all sources and rerender
                calendar.refetchEvents();
              })
              .catch(console.error);
          }
        },

        eventRender: function(info) {
          // Usamos el color que viene del backend
          if (info.event.extendedProps.color) {
            info.el.style.backgroundColor = info.event.extendedProps.color;
          }
        },

        eventClick: function(info) {
          info.jsEvent.preventDefault();

          // Change the border color
          info.el.style.borderColor = 'red';

          Swal.fire({
            title: info.event.title,
            icon: 'info',
            html: '<p>' + info.event.extendedProps.description + '</p><a href="' + info.event.url + '">Visitar página del evento</a>',
            showCloseButton: true,
            showCancelButton: true,
            showDenyButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Eliminar',
            denyButtonText: 'Editar',
            customClass: {
              confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded ml-2',
              denyButton: 'bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded ml-2',
              cancelButton: 'bg-gray-300 hover:bg-gray-400 text-black px-4 py-2 rounded ml-2'
            },
            buttonsStyling: false
          }).then((result) => {
            if (result.isConfirmed) {
              // Delete event
              fetch("../controllers/eventHandler.php", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/json"
                  },
                  body: JSON.stringify({
                    request_type: 'deleteEvent',
                    event_id: info.event.id
                  }),
                })
                .then(response => response.json())
                .then(data => {
                  if (data.status == 1) {
                    Swal.fire('Evento borrado correctamente!', '', 'success');
                  } else {
                    Swal.fire(data.error, '', 'error');
                  }

                  // Refetch events from all sources and rerender
                  calendar.refetchEvents();
                })
                .catch(console.error);
            } else if (result.isDenied) {
              // Edit event
              Swal.fire({
                title: 'Editar Evento',
                html: `
                  <input id="swalEvtTitle_edit" class="swal2-input" placeholder="Ingresar título" value="${info.event.title}">
                <textarea id="swalEvtDesc_edit" class="swal2-textarea" placeholder="Ingresar descripción">${info.event.extendedProps.description}</textarea>
                <input id="swalEvtURL_edit" class="swal2-input" placeholder="Ingresar URL" value="${info.event.url}">
                <input id="swalEvtStart_edit" type="datetime-local" class="swal2-input" value="${formatDateForInput(info.event.start)}">
                <input id="swalEvtEnd_edit" type="datetime-local" class="swal2-input" value="${formatDateForInput(info.event.end)}">
                <input id="swalEvtCausaCambio_edit" class="swal2-input" placeholder="Causa del cambio">`,
                focusConfirm: false,
                confirmButtonText: 'Guardar',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                  return [
                    document.getElementById('swalEvtTitle_edit').value,
                    document.getElementById('swalEvtDesc_edit').value,
                    document.getElementById('swalEvtURL_edit').value,
                    document.getElementById('swalEvtStart_edit').value,
                    document.getElementById('swalEvtEnd_edit').value,
                    document.getElementById('swalEvtCausaCambio_edit').value // Nuevo campo CausaCambio
                  ];
                }
              }).then((result) => {
                if (result.value) {
                  // Edit event
                  const [title, description, url, start, end, causaCambio] = result.value;

                  fetch("../controllers/eventHandler.php", {
                      method: "POST",
                      headers: {
                        "Content-Type": "application/json"
                      },
                      body: JSON.stringify({
                        request_type: 'editEvent',
                        event_id: info.event.id,
                        event_data: [title, description, url, causaCambio], // Incluir CausaCambio
                        start: start,
                        end: end
                      }),
                    })
                    .then(response => response.json())
                    .then(data => {
                      if (data.status == 1) {
                        Swal.fire('Evento actualizado correctamente!', '', 'success');
                      } else {
                        Swal.fire(data.error, '', 'error');
                      }

                      // Refetch events from all sources and rerender
                      calendar.refetchEvents();
                    })
                    .catch(console.error);
                }
              });
            }
          });
        }
      });

      calendar.render();
    });

    // Función para formatear fechas
    function formatDateForInput(date) {
      if (!date) return '';
      const d = new Date(date);
      const pad = (num) => num.toString().padStart(2, '0');
      return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
    }

    // Función para actualizar la fecha del evento en el servidor
    function updateEventDate(event) {
      fetch("../controllers/eventHandler.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json"
          },
          body: JSON.stringify({
            request_type: 'updateEventDate',
            event_id: event.id,
            start: event.startStr,
            end: event.end ? event.endStr : null, // Si el evento no tiene fin, se envía null
          }),
        })
        .then(response => response.json())
        .then(data => {
          if (data.status == 1) {
            Swal.fire({
              icon: 'success',
              title: 'Fecha actualizada correctamente',
              showConfirmButton: false,
              timer: 1500
            });
          } else {
            Swal.fire(data.error, '', 'error');
          }
        })
        .catch(console.error);
    }
  </script>
</head>

<body class="bg-gray-100 m-0 p-0 overflow-hidden">
  <div class="flex h-screen w-screen">

    <!-- Sidebar -->
    <?php include './assets/Fragments/sidebar.php'; ?>

    <div>
      <!-- Contenedor principal del calendario + leyenda -->
      <div class="flex-1 overflow-hidden p-4 flex flex-col">

        <!-- Leyenda -->
        <div class="flex justify-around mb-4">
          <div class="flex items-center">
            <div class="w-4 h-4 bg-blue-500 rounded-full mr-2"></div>
            <span class="text-sm text-gray-700">Firmada</span>
          </div>
          <div class="flex items-center">
            <div class="w-4 h-4 bg-yellow-500 rounded-full mr-2"></div>
            <span class="text-sm text-gray-700">En transición</span>
          </div>
          <div class="flex items-center">
            <div class="w-4 h-4 bg-green-500 rounded-full mr-2"></div>
            <span class="text-sm text-gray-700">Llegada</span>
          </div>
        </div>

        <!-- Calendario -->
        <div class="bg-white rounded-xl shadow-md p-4 h-full w-full overflow-auto">
          <div id="calendar" class="h-full w-full"></div>
        </div>

      </div>
    </div>

  </div>
</body>


</html>