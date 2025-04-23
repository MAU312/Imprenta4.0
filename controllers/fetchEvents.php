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

if ($results) {
    foreach ($results as $row) {
        $event_start = strtotime($row['start']);
        $event_end = strtotime($row['end']);
        $current_date = strtotime(date('Y-m-d'));

        $days_until_start = ($event_start - $current_date) / (60 * 60 * 24);

        if ($current_date > $event_end) {
            $event_color = 'green';
        } elseif ($days_until_start <= 5 && $days_until_start > 0) {
            $event_color = 'yellow';
        } elseif ($current_date >= $event_start && $current_date <= $event_end) {
            $event_color = 'green';
        } else {
            $event_color = 'default';
        }

        $row['color'] = $event_color;
        $eventsArr[] = $row;
    }
}

echo json_encode($eventsArr);
?>
