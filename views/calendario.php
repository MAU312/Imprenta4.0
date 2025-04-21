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
        editable: true,

        eventDrop: function (info) {
          updateEventDate(info.event);
        },

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

          info.el.style.backgroundColor = '';

          var firstDay = new Date(startDate);
          var secondDay = new Date(startDate);
          secondDay.setDate(firstDay.getDate() + 1);

          var arrivalDay = new Date(endDate);

          if (today <= secondDay) {
            info.el.style.backgroundColor = 'blue';
          } else if (today >= secondDay && today <= arrivalDay) {
            info.el.style.backgroundColor = 'yellow';
          } else if (today === arrivalDay) {
            info.el.style.backgroundColor = 'green';
          }
        },

        eventClick: function (info) {
          info.jsEvent.preventDefault();
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
                  calendar.refetchEvents();
                })
                .catch(console.error);
            } else if (result.isDenied) {
              Swal.fire({
                title: 'Editar Evento',
                html:
                  '<input id="swalEvtTitle_edit" class="swal2-input" placeholder="Ingresar título" value="' + info.event.title + '">' +
                  '<textarea id="swalEvtDesc_edit" class="swal2-input" placeholder="Ingresar descripción">' + info.event.extendedProps.description + '</textarea>' +
                  '<input id="swalEvtURL_edit" class="swal2-input" placeholder="Ingresar URL" value="' + info.event.url + '">' +
                  '<input id="swalEvtStart_edit" type="datetime-local" class="swal2-input" value="' + formatDateForInput(info.event.start) + '">' +
                  '<input id="swalEvtEnd_edit" type="datetime-local" class="swal2-input" value="' + formatDateForInput(info.event.end) + '">' +
                  '<input id="swalEvtCausaCambio_edit" class="swal2-input" placeholder="Causa del cambio">',
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
                    document.getElementById('swalEvtCausaCambio_edit').value
                  ];
                }
              }).then((result) => {
                if (result.value) {
                  const [title, description, url, start, end, causaCambio] = result.value;

                  fetch("../controllers/eventHandler.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                      request_type: 'editEvent',
                      event_id: info.event.id,
                      event_data: [title, description, url, causaCambio],
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

    function formatDateForInput(date) {
      if (!date) return '';
      const d = new Date(date);
      const pad = (num) => num.toString().padStart(2, '0');
      return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
    }

    function updateEventDate(event) {
      fetch("../controllers/eventHandler.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          request_type: 'updateEventDate',
          event_id: event.id,
          start: event.startStr,
          end: event.end ? event.endStr : null,
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
              window.location.reload();
            });
          } else {
            Swal.fire(data.error, '', 'error');
            if (event.setDates) {
              event.setDates(event.start, event.end);
            }
          }
        })
        .catch(error => {
          console.error(error);
          if (event.setDates) {
            event.setDates(event.start, event.end);
          }
        });
    }
  </script>
</head>

<body class="bg-gray-100">
  <?php include './assets/Fragments/sidebar.php'; ?>
  <div class="flex h-screen">
    <div id="calendar" class="flex-1 p-4"></div>
  </div>
</body>

</html>
