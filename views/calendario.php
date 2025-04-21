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
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        contentHeight: 'auto',
        events: '../controllers/fetchEvents.php',
        locale: 'es',
        selectable: true,
        editable: true, // Habilita drag and drop y redimensionamiento

        // Evento cuando se mueve un evento
        eventDrop: function (info) {
          updateEventDate(info.event);
        },

        // Evento cuando se redimensiona un evento
        eventResize: function (info) {
          updateEventDate(info.event);
        },

        select: async function (start, end, allDay) {
          const { value: formValues } = await Swal.fire({
            title: 'Añadir evento de importación',
            confirmButtonText: 'Guardar',
            showCloseButton: true,
            showCancelButton: true,
            html:
              '<input id="swalEvtTitle" class="swal2-input" placeholder="Ingresar título">' +
              '<textarea id="swalEvtDesc" class="swal2-input" placeholder="Ingresar información"></textarea>' +
              '<input id="swalEvtURL" class="swal2-input" placeholder="Agregar URL de rastreo">',
            focusConfirm: false,
            preConfirm: () => {
              return [
                document.getElementById('swalEvtTitle').value,
                document.getElementById('swalEvtDesc').value,
                document.getElementById('swalEvtURL').value
              ]
            }
          });

          if (formValues) {
            // Add event
            fetch("../controllers/eventHandler.php", {
              method: "POST",
              headers: { "Content-Type": "application/json" },
              body: JSON.stringify({ request_type: 'addEvent', start: start.startStr, end: start.endStr, event_data: formValues }),
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

        eventRender: function (info) {
          var event = info.event;
          var startDate = event.start;
          var endDate = event.end;
          var today = new Date();

          // Reset all background colors
          info.el.style.backgroundColor = '';

          // Check if the event is within the first 2 days
          var firstDay = new Date(startDate);
          var secondDay = new Date(startDate);
          secondDay.setDate(firstDay.getDate() + 1);

          // Check if the event is the last day (arrival day)
          var arrivalDay = new Date(endDate);

          // Set colors based on event dates
          if (today <= secondDay) {
            // Blue for the first 2 days
            info.el.style.backgroundColor = 'blue';
          } else if (today >= secondDay && today <= arrivalDay) {
            // Yellow for the days in between
            info.el.style.backgroundColor = 'yellow';
          } else if (today === arrivalDay) {
            // Green for the arrival day
            info.el.style.backgroundColor = 'green';
          }
        },

        eventClick: function (info) {
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
          }).then((result) => {
            if (result.isConfirmed) {
              // Delete event
              fetch("../controllers/eventHandler.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ request_type: 'deleteEvent', event_id: info.event.id }),
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
                html:
                  '<input id="swalEvtTitle_edit" class="swal2-input" placeholder="Ingresar título" value="' + info.event.title + '">' +
                  '<textarea id="swalEvtDesc_edit" class="swal2-input" placeholder="Ingresar descripción">' + info.event.extendedProps.description + '</textarea>' +
                  '<input id="swalEvtURL_edit" class="swal2-input" placeholder="Ingresar URL" value="' + info.event.url + '">' +
                  '<input id="swalEvtStart_edit" type="datetime-local" class="swal2-input" value="' + formatDateForInput(info.event.start) + '">' +
                  '<input id="swalEvtEnd_edit" type="datetime-local" class="swal2-input" value="' + formatDateForInput(info.event.end) + '">' +
                  '<input id="swalEvtCausaCambio_edit" class="swal2-input" placeholder="Causa del cambio">', // Nuevo campo CausaCambio
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
                    headers: { "Content-Type": "application/json" },
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
        headers: { "Content-Type": "application/json" },
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
              title: 'Fecha actualizada correctamente!',
              text: 'La página se recargará para aplicar los cambios.',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              // Refrescar la página después de que el usuario haga clic en "OK"
              window.location.reload();
            });
          } else {
            Swal.fire(data.error, '', 'error');
            // Si hay un error, revertir el cambio en el calendario
            if (event.setDates) {
              // Usar setDates para revertir el cambio si el método está disponible
              event.setDates(event.start, event.end);
            } else {
              console.error('No se pudo revertir el evento: método revert no disponible');
            }
          }
        })
        .catch(error => {
          console.error(error);
          if (event.setDates) {
            // Usar setDates para revertir el cambio en caso de error
            event.setDates(event.start, event.end);
          } else {
            console.error('No se pudo revertir el evento: método revert no disponible');
          }
        });
    }
  </script>
</head>

<body class="bg-gray-100">
  <div class="flex h-screen">
    <!-- Sidebar -->
    <div id="sidebar" class="w-1/4 bg-gray-200 rounded-lg shadow-lg p-4 overflow-y-auto">
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          fetch('./assets/Fragments/sidebar.php')
            .then(response => {
              if (!response.ok) throw new Error('Error al cargar el sidebar: ' + response.status);
              return response.text();
            })
            .then(data => {
              document.getElementById('sidebar').innerHTML = data;
            })
            .catch(error => {
              console.error(error);
              document.getElementById('sidebar').innerHTML =
                '<p class="text-red-500 text-sm">Error al cargar el menú lateral. Intente más tarde.</p>';
            });
        });
      </script>
    </div>

    <!-- Contenido Principal -->
    <div class="w-3/4 p-4 overflow-y-auto">
      <!-- Título -->
      <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Calendario de Importaciones</h1>

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
      <div class="bg-white rounded-lg shadow-lg p-4 h-full">
        <div id="calendar" class="h-[500px] md:h-[650px] lg:h-[800px]"></div>
      </div>
    </div>
  </div>
</body>
</html>