<?php
require_once '../config/Conexion.php';

try {
    $db = Conexion::conectar();
} catch (PDOException $e) {
    echo json_encode(['error' => 'Conexión fallida: ' . $e->getMessage()]);
    exit;
}

$jsonStr = file_get_contents('php://input');
$jsonObj = json_decode($jsonStr);

if ($jsonObj->request_type == 'addEvent') {
    $start = $jsonObj->start;
    $end = $jsonObj->end;

    $event_data = $jsonObj->event_data;
    $eventTitle = $event_data[0] ?? '';
    $eventDesc = $event_data[1] ?? '';
    $eventURL = $event_data[2] ?? '';

    if (!empty($eventTitle)) {
        $sql = "INSERT INTO events (title, description, url, start, end) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $insert = $stmt->execute([$eventTitle, $eventDesc, $eventURL, $start, $end]);

        echo json_encode($insert ? ['status' => 1] : ['error' => 'Event Add request failed!']);
    }

} elseif ($jsonObj->request_type == 'editEvent') {
    $start = $jsonObj->start;
    $end = $jsonObj->end;
    $event_id = $jsonObj->event_id;

    $event_data = $jsonObj->event_data;
    $eventTitle = $event_data[0] ?? '';
    $eventDesc = $event_data[1] ?? '';
    $eventURL = $event_data[2] ?? '';
    $causaCambio = $event_data[3] ?? '';

    if (!empty($eventTitle)) {
        $sql = "UPDATE events SET title=?, description=?, url=?, start=?, end=?, CausaCambio=? WHERE id=?";
        $stmt = $db->prepare($sql);
        $update = $stmt->execute([$eventTitle, $eventDesc, $eventURL, $start, $end, $causaCambio, $event_id]);

        echo json_encode($update ? ['status' => 1] : ['error' => 'Event Update request failed!']);
    }

} elseif ($jsonObj->request_type == 'deleteEvent') {
    $id = $jsonObj->event_id;

    $sql = "DELETE FROM events WHERE id=?";
    $stmt = $db->prepare($sql);
    $delete = $stmt->execute([$id]);

    echo json_encode($delete ? ['status' => 1] : ['error' => 'Event Delete request failed!']);

} elseif ($jsonObj->request_type == 'updateEventDate') {
    $event_id = $jsonObj->event_id;
    $start = $jsonObj->start;
    $end = $jsonObj->end;

    $sql = "UPDATE events SET start=?, end=? WHERE id=?";
    $stmt = $db->prepare($sql);
    $update = $stmt->execute([$start, $end, $event_id]);

    echo json_encode($update
        ? ['status' => 1, 'message' => 'Fecha actualizada correctamente']
        : ['status' => 0, 'error' => 'Error al actualizar la fecha del evento']
    );

} else {
    echo json_encode(['error' => 'Tipo de solicitud no válido']);
}
?>
