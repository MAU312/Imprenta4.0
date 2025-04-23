<?php
require_once '../config/Conexion.php';

try {
    $db = Conexion::conectar();
} catch (PDOException $e) {
    echo json_encode(['error' => 'Conexión fallida: ' . $e->getMessage()]);
    exit;
}

$where_sql = '';
$params = [];

if (!empty($_GET['start']) && !empty($_GET['end'])) {
    $where_sql = " WHERE start BETWEEN ? AND ?";
    $params = [$_GET['start'], $_GET['end']];
}

$sql = "SELECT * FROM events $where_sql";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$eventsArr = [];
$current_date = new DateTime(); // Fecha actual

foreach ($results as $row) {
    $event_start = new DateTime($row['start']);
    $event_end = new DateTime($row['end']);
    
    // Calculamos la diferencia en días
    $interval = $current_date->diff($event_start);
    $days_difference = $interval->days;
    
    // Aplicamos las reglas de colores
    if ($current_date >= $event_end) {
        // Evento ya pasó (incluyendo si termina hoy)
        $row['color'] = 'green';
    } elseif ($current_date >= $event_start || $days_difference <= 5) {
        // Evento en los próximos 5 días o ya empezó pero no terminó
        $row['color'] = 'yellow';
    } else {
        // Evento a más de 5 días
        $row['color'] = 'blue';
    }
    
    $eventsArr[] = $row;
}

echo json_encode($eventsArr);
?>