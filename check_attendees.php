<?php
include('include/connection.php');
error_reporting(0);
header('Content-Type: application/json');
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $result = $mysqli->common_select("attendee", "COUNT(*) as attendees_count", "event_id = '$event_id'");
    $count = 0;
    if ($result['data']) {
        $count = intval($result['data'][0]->attendees_count);
    }
    
    echo json_encode(['attendees_count' => $count]);
    exit;
} else {
    echo json_encode(['error' => 'Event ID not provided']);
    exit;
}
?>