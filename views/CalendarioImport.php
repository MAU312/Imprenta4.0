<?php
require_once '../config/Conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CalendarioImport</title>
  
   
    

    <link href="../assets/css/style.css" rel="stylesheet" />

    <script src="../assets/JavaScript/sweetalert2.all.min.js"></script>


    <link href="../assets/JavaScript/fullcalendar/lib/main.css" rel="stylesheet" />
    <script src="../assets/JavaScript/fullcalendar/lib/main.js"></script>
    
 

   

    
    <script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    height: 650,
    //cuidado aqui¡ si es con un link 
   // events:'./models/Calendario.php'
   events: [
  {
    "id": "1",
    "title": "Entrada de Mercancía - Producto A",
    "description": "Recepción de 100 unidades del Producto A para el inventario.",
    "url": "http://miempresa.com/mercancia/entrada/1",
    "start": "2024-12-10",
    "end": "2024-12-10"
  },
  {
    "id": "2",
    "title": "Entrada de Mercancía - Producto B",
    "description": "Recepción de 200 unidades del Producto B para el inventario.",
    "url": "http://miempresa.com/mercancia/entrada/2",
    "start": "2024-12-11",
    "end": "2024-12-11"
  },
  {
    "id": "3",
    "title": "Entrada de Mercancía - Producto C",
    "description": "Recepción de 50 unidades del Producto C para el inventario.",
    "url": "http://miempresa.com/mercancia/entrada/3",
    "start": "2024-12-12",
    "end": "2024-12-12"
  },
  {
    "id": "4",
    "title": "Evento1",
    "description": "Recepción ",
    "url": "http://www.lipsum.com/",
    "start": "2024-12-10",
    "end": "2024-12-10"
  }
],  
selectable: true,
    select: async function (start, end, allDay) {
      const { value: formValues } = await Swal.fire({
        title: 'Add Event',
        confirmButtonText: 'Submit',
        showCloseButton: true,
		    showCancelButton: true,
        html:
          '<input id="swalEvtTitle" class="swal2-input" placeholder="Enter title">' +
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
        fetch("./models/CalendarioAgrega.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ request_type:'addEvent', start:start.startStr, end:start.endStr, event_data: formValues}),
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
//------------------------------------------------------------------
    eventClick: function(info) {
        info.jsEvent.preventDefault();
        
        // change the border color
        info.el.style.borderColor = 'red';
        
        Swal.fire({
            title: info.event.title,
            icon: 'info',
            html:'<p>'+info.event.extendedProps.description+'</p><a href="'+info.event.url+'">Visit event page</a>',
        });
    }
});

  calendar.render();
});


</script>
      

</head>
<body>
<div class="container">
    <div class="wrapper">
    <div id="calendar"></div>
        
    </div>
</div>

</body>
</html>