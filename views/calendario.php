<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendario de Importaciones | Sistema de Logística</title>
  <link href="./assets/css/style.css" rel="stylesheet" />
  <script src="./assets/JavaScript/sweetalert2.all.min.js"></script>
  <link href="./assets/JavaScript/fullcalendar/lib/main.css" rel="stylesheet" />
  <script src="./assets/JavaScript/fullcalendar/lib/main.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="./assets/JavaScript/fullcalendar/lib/locales/es.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --color-primary: #3b82f6;
      --color-primary-dark: #2563eb;
      --color-secondary: #10b981;
      --color-warning: #f59e0b;
    }
    
    .fc-license-message {
      display: none !important;
    }
    
    /* Estilos personalizados adicionales */
    .header-gradient {
      background: linear-gradient(135deg,rgb(245, 246, 248) 0%,rgb(253, 253, 253) 100%);
    }
    
    .card-shadow {
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .fc-event-firmada {
      background-color: var(--color-primary) !important;
      border-left: 4px solid #1d4ed8 !important;
    }
    
    .fc-event-transicion {
      background-color: var(--color-warning) !important;
      border-left: 4px solid #d97706 !important;
    }
    
    .fc-event-llegada {
      background-color: var(--color-secondary) !important;
      border-left: 4px solid #059669 !important;
    }
  </style>
</head>

<body class="bg-gray-50 font-['Inter']">
  <div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <?php include './assets/Fragments/sidebar.php'; ?>

    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Encabezado ejecutivo -->
      <header class="header-gradient text-blue-700">
        <div class="px-6 py-4 flex items-center justify-between">
          <div>
            <h1 class="text-2xl font-bold">Calendario de Importaciones</h1>
            <p class="text-blue-700">Gestión y seguimiento de Importaciones </p>
          </div>
          <div class="flex items-center space-x-4">
            <div class="text-right">
              <p class="text-sm text-blue-700">Fecha actual</p>
              <p class="font-medium" id="current-date"></p>
            </div>
            <div class="bg-white/10 p-2 rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
          </div>
        </div>
      </header>

      <!-- Contenido principal -->
      <main class="flex-1 overflow-auto p-6 bg-gray-50">
        <!-- Panel de resumen -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
          <div class="bg-white rounded-lg card-shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Total Importaciones</h3>
            <p class="text-2xl font-bold" id="total-imports">0</p>
          </div>
          <div class="bg-white rounded-lg card-shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">En Tránsito</h3>
            <p class="text-2xl font-bold text-yellow-600" id="in-transit">0</p>
          </div>
          <div class="bg-white rounded-lg card-shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Completadas</h3>
            <p class="text-2xl font-bold text-green-600" id="completed">0</p>
          </div>
          <div class="bg-white rounded-lg card-shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Próximas</h3>
            <p class="text-2xl font-bold text-blue-600" id="upcoming">0</p>
          </div>
        </div>

        <!-- Contenedor del calendario -->
        <div class="bg-white rounded-xl card-shadow overflow-hidden">
          <!-- Leyenda mejorada -->
          <div class="flex flex-wrap justify-center gap-4 p-4 border-b">
            <div class="flex items-center">
              <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
              <span class="text-sm text-gray-700">Firmada</span>
            </div>
            <div class="flex items-center">
              <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
              <span class="text-sm text-gray-700">En transición</span>
            </div>
            <div class="flex items-center">
              <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
              <span class="text-sm text-gray-700">Llegada</span>
            </div>
          </div>

          <!-- Calendario -->
          <div class="p-4">
            <div id="calendar" class="h-[600px]"></div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Mostrar fecha actual
      const now = new Date();
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      document.getElementById('current-date').textContent = now.toLocaleDateString('es-ES', options);
      
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: '100%',
        contentHeight: 'auto',
        events: '../controllers/fetchEvents.php',
        locale: 'es',
        selectable: true,
        editable: false,
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
          today: 'Hoy',
          month: 'Mes',
          week: 'Semana',
          day: 'Día'
        },
        
        eventClassNames: function(arg) {
          // Aplicamos clases CSS según el color del evento
          if(arg.event.extendedProps.color === 'blue') return ['fc-event-firmada'];
          if(arg.event.extendedProps.color === 'yellow') return ['fc-event-transicion'];
          if(arg.event.extendedProps.color === 'green') return ['fc-event-llegada'];
          return [];
        },
        
        eventDrop: function(info) {
          updateEventDate(info.event);
        },
        eventResize: function(info) {
          updateEventDate(info.event);
        },
        select: async function(start, end, allDay) {
          const { value: formValues } = await Swal.fire({
            title: 'Nuevo Evento de Importación',
            confirmButtonText: 'Guardar',
            showCloseButton: true,
            showCancelButton: true,
            html: `
              <div class="space-y-4 text-left">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                  <input id="swalEvtTitle" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Titulo Pedido">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                  <textarea id="swalEvtDesc" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Detalles del Pedido"></textarea>
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">URL de Rastreo</label>
                  <input id="swalEvtURL" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="https://ejemplo.com">
                </div>
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
              confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md ml-2',
              cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md ml-2',
            },
            buttonsStyling: false
          });

          if (formValues) {
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
                  Swal.fire({
                    title: '¡Evento creado!',
                    text: 'La importación ha sido registrada',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                  });
                  updateStats();
                } else {
                  Swal.fire('Error', data.error, 'error');
                }
                calendar.refetchEvents();
              })
              .catch(console.error);
          }
        },
        eventClick: function(info) {
          info.jsEvent.preventDefault();
          
          Swal.fire({
            title: info.event.title,
            width: '600px',
            html: `
              <div class="text-left space-y-3">
                <div>
                  <h4 class="font-medium text-gray-700">Descripción</h4>
                  <p class="mt-1">${info.event.extendedProps.description || 'Sin descripción'}</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <h4 class="font-medium text-gray-700">Fecha Inicio</h4>
                    <p class="mt-1">${info.event.start.toLocaleString()}</p>
                  </div>
                  <div>
                    <h4 class="font-medium text-gray-700">Fecha Fin</h4>
                    <p class="mt-1">${info.event.end ? info.event.end.toLocaleString() : 'Mismo día'}</p>
                  </div>
                </div>
                ${info.event.url ? `
                <div>
                  <h4 class="font-medium text-gray-700">Enlace de Rastreo</h4>
                  <a href="${info.event.url}" target="_blank" class="text-blue-600 hover:underline">${info.event.url}</a>
                </div>` : ''}
              </div>`,
            showCloseButton: true,
            showCancelButton: true,
            showDenyButton: true,
            cancelButtonText: 'Cerrar',
            confirmButtonText: 'Eliminar',
            denyButtonText: 'Editar',
            customClass: {
              confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md',
              denyButton: 'bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md',
              cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md'
            },
            buttonsStyling: false
          }).then((result) => {
            if (result.isConfirmed) {
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
                    Swal.fire('Eliminado', 'El evento ha sido borrado', 'success');
                    updateStats();
                  } else {
                    Swal.fire('Error', data.error, 'error');
                  }
                  calendar.refetchEvents();
                })
                .catch(console.error);
            } else if (result.isDenied) {
              Swal.fire({
                title: 'Editar Importación',
                width: '700px',
                html: `
                  <div class="grid grid-cols-1 gap-4 text-left">
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                      <input id="swalEvtTitle_edit" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="${info.event.title}">
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                      <textarea id="swalEvtDesc_edit" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-md">${info.event.extendedProps.description || ''}</textarea>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">URL de Rastreo</label>
                      <input id="swalEvtURL_edit" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="${info.event.url || ''}">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha Inicio</label>
                        <input id="swalEvtStart_edit" type="datetime-local" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="${formatDateForInput(info.event.start)}">
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha Fin</label>
                        <input id="swalEvtEnd_edit" type="datetime-local" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="${formatDateForInput(info.event.end)}">
                      </div>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-1">Causa del Cambio</label>
                      <input id="swalEvtCausaCambio_edit" class="w-full px-4 py-2 border border-gray-300 rounded-md" placeholder="Motivo de la modificación">
                    </div>
                  </div>`,
                focusConfirm: false,
                confirmButtonText: 'Guardar Cambios',
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
                      headers: {
                        "Content-Type": "application/json"
                      },
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
                        Swal.fire('Actualizado', 'Los cambios se guardaron', 'success');
                        updateStats();
                      } else {
                        Swal.fire('Error', data.error, 'error');
                      }
                      calendar.refetchEvents();
                      // En la parte donde editas el evento, después de calendar.refetchEvents();
                    calendar.refetchEvents().then(() => {
                      // Forzar la actualización de estilos
                      calendar.getEvents().forEach(event => {
                        event.setProp('color', event.extendedProps.color);
                      });
                    });
                    })
                    .catch(console.error);
                }
              });
            }
          });
        },
        eventDidMount: function(info) {
          // Actualizar estadísticas cuando se cargan eventos
          updateStats();
        }
      });

      calendar.render();
      
      // Función para actualizar el panel de estadísticas
      function updateStats() {
        fetch("../controllers/fetchEvents.php")
          .then(response => response.json())
          .then(events => {
            const now = new Date();
            let total = 0, inTransit = 0, completed = 0, upcoming = 0;
            
            events.forEach(event => {
              total++;
              const startDate = new Date(event.start);
              const endDate = event.end ? new Date(event.end) : startDate;
              
              if (now > endDate) {
                completed++;
              } else if (now >= startDate || (startDate - now) <= 5 * 24 * 60 * 60 * 1000) {
                inTransit++;
              } else {
                upcoming++;
              }
            });
            
            document.getElementById('total-imports').textContent = total;
            document.getElementById('in-transit').textContent = inTransit;
            document.getElementById('completed').textContent = completed;
            document.getElementById('upcoming').textContent = upcoming;
          });
      }
      
      // Actualizar estadísticas al cargar
      updateStats();
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
          headers: {
            "Content-Type": "application/json"
          },
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
              icon: 'success',
              title: 'Fecha actualizada',
              showConfirmButton: false,
              timer: 1500
            });
          } else {
            Swal.fire('Error', data.error, 'error');
          }
        })
        .catch(console.error);
    }
    
  </script>
</body>
</html>