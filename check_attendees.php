<?php
// include('include/connection.php'); // Include your DB connection

// if (isset($_GET['event_id'])) {
//   $eventId = $_GET['event_id'];

//   // Query to count the number of attendees for the selected event
//   $query = "SELECT COUNT(*) as attendees_count FROM attendee WHERE event_id = ? AND deleted_at IS NULL";
//   $stmt = $mysqli->prepare($query);
//   $stmt->bind_param("i", $eventId);
//   $stmt->execute();
//   $stmt->bind_result($attendeesCount);
//   $stmt->fetch();

//   // Return the count as JSON
//   echo json_encode(['attendees_count' => $attendeesCount]);

//   $stmt->close();
// }



include('/includes/connection.php');

if (isset($_GET['event_id'])) {
    $eventId = $_GET['event_id'];

    // Get event capacity
    $sql = "SELECT capacity FROM events WHERE id = $eventId";
    $result = mysqli_query($conn, $sql);
    $event = mysqli_fetch_assoc($result);

    // Get the number of registered attendees
    $sql = "SELECT COUNT(*) AS count FROM attendees WHERE event_id = $eventId";
    $result = mysqli_query($conn, $sql);
    $attendee = mysqli_fetch_assoc($result);

    echo json_encode(["capacity" => $event['capacity'], "attendees" => $attendee['count']]);
}
?>

?>
