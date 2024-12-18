<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>index</title>
  <link href="./assets/css/style.css" rel="stylesheet" />
  <script src="./assets/JavaScript/sweetalert2.all.min.js"></script>
  <link href="./assets/JavaScript/fullcalendar/lib/main.css" rel="stylesheet" />
  <script src="./assets/JavaScript/fullcalendar/lib/main.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 650,
        events: '../controllers/fetchEvents.php',

        selectable: true,
        select: async function(start, end, allDay) {
          const {
            value: formValues
          } = await Swal.fire({
            title: 'Add Event',
            confirmButtonText: 'Submit',
            showCloseButton: true,
            showCancelButton: true,
            html: '<input id="swalEvtTitle" class="swal2-input" placeholder="Enter title">' +
              '<textarea id="swalEvtDesc" class="swal2-input" placeholder="Enter description"></textarea>' +
              '<input id="swalEvtURL" class="swal2-input" placeholder="Enter URL">',
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
                  Swal.fire('Event added successfully!', '', 'success');
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

        eventClick: function(info) {
          info.jsEvent.preventDefault();

          // change the border color
          info.el.style.borderColor = 'red';

          Swal.fire({
            title: info.event.title,
            icon: 'info',
            html: '<p>' + info.event.extendedProps.description + '</p><a href="' + info.event.url + '">Visit event page</a>',
            showCloseButton: true,
            showCancelButton: true,
            showDenyButton: true,
            cancelButtonText: 'Close',
            confirmButtonText: 'Delete',
            denyButtonText: 'Edit',
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
                    Swal.fire('Event deleted successfully!', '', 'success');
                  } else {
                    Swal.fire(data.error, '', 'error');
                  }

                  // Refetch events from all sources and rerender
                  calendar.refetchEvents();
                })
                .catch(console.error);
            } else if (result.isDenied) {
              // Edit and update event
              Swal.fire({
                title: 'Edit Event',
                html: '<input id="swalEvtTitle_edit" class="swal2-input" placeholder="Enter title" value="' + info.event.title + '">' +
                  '<textarea id="swalEvtDesc_edit" class="swal2-input" placeholder="Enter description">' + info.event.extendedProps.description + '</textarea>' +
                  '<input id="swalEvtURL_edit" class="swal2-input" placeholder="Enter URL" value="' + info.event.url + '">',
                focusConfirm: false,
                confirmButtonText: 'Submit',
                preConfirm: () => {
                  return [
                    document.getElementById('swalEvtTitle_edit').value,
                    document.getElementById('swalEvtDesc_edit').value,
                    document.getElementById('swalEvtURL_edit').value
                  ]
                }
              }).then((result) => {
                if (result.value) {
                  // Edit event
                  fetch("../controllers/eventHandler.php", {
                      method: "POST",
                      headers: {
                        "Content-Type": "application/json"
                      },
                      body: JSON.stringify({
                        request_type: 'editEvent',
                        start: info.event.startStr,
                        end: info.event.endStr,
                        event_id: info.event.id,
                        event_data: result.value
                      })
                    })
                    .then(response => response.json())
                    .then(data => {
                      if (data.status == 1) {
                        Swal.fire('Event updated successfully!', '', 'success');
                      } else {
                        Swal.fire(data.error, '', 'error');
                      }

                      // Refetch events from all sources and rerender
                      calendar.refetchEvents();
                    })
                    .catch(console.error);
                }
              });
            } else {
              Swal.close();
            }
          });
        }
      });

      calendar.render();
    });
  </script>

</head>

<body class="flex bg-gray-100">
  <!-- Incluir el sidebar -->
  <?php include './assets/Fragments/sidebar.php'; ?>

  <!-- Contenido Principal -->
  <div class="flex-1 p-6">
    <!-- Título -->
    <h1 class="text-3xl font-bold mb-6 text-center text-blue-700">Calendario de Importaciones</h1>

    <!-- Leyenda -->
    <div class="bg-white rounded-lg shadow-md border border-gray-300 mb-6 p-4">
      <h2 class="text-xl font-semibold mb-4 text-center">Leyenda</h2>
      <div class="flex justify-around">
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
    </div>

    <!-- Calendario -->
    <div class="bg-white rounded-lg shadow-md border border-gray-300 p-6">
      <h2 class="text-xl font-semibold mb-4 text-center">Calendario</h2>
      <div id="calendar" class="w-full h-[500px] bg-gray-50 rounded-lg"></div>
    </div>
  </div>
</body>




</html>