<?php
require_once '../config/global.php';  // Conexión a la base de datos

// Filtrar eventos por fecha del calendario
$where_sql = ''; 
if(!empty($_GET['start']) && !empty($_GET['end'])){ 
    $where_sql .= " WHERE start BETWEEN '".$_GET['start']."' AND '".$_GET['end']."' "; 
}

// Obtener eventos de la base de datos
$sql = "SELECT * FROM events $where_sql"; 
$result = $db->query($sql);  

$eventsArr = array(); 
if ($result->num_rows > 0) { 
    while ($row = $result->fetch_assoc()) { 
        // Convertir fechas a timestamp
        $event_start = strtotime($row['start']);
        $event_end = strtotime($row['end']);
        $current_date = strtotime(date('Y-m-d'));

        // Calcular la diferencia de días entre la fecha actual y la fecha de inicio
        $days_until_start = ($event_start - $current_date) / (60 * 60 * 24);

        // Determinar el color del evento
        if ($current_date > $event_end) {
            $event_color = 'green';  // Verde si el evento ya terminó
        } elseif ($days_until_start <= 5 && $days_until_start > 0) {
            $event_color = 'yellow'; // Amarillo si la fecha de inicio está a menos de 5 días
        } elseif ($current_date >= $event_start && $current_date <= $event_end) {
            $event_color = 'green';   // Azul si el evento está en progreso
        } else {
            $event_color = 'default'; // Color predeterminado si no se aplica ninguna condición
        }

        // Agregar color a los eventos
        $row['color'] = $event_color;
        array_push($eventsArr, $row); 
    } 
}


// Renderizar los eventos en formato JSON
echo json_encode($eventsArr);
?>
