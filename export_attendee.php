<?php
include('include/connection.php');

if(isset($_GET['event_id'])) {
    // Query to get attendee data
    $result = $mysqli->common_select_query("SELECT 
        attendee.name as attendee_name,
        event.name as event_name,
        attendee.email,
        attendee.contact 
        FROM event 
        JOIN attendee ON attendee.event_id=event.id 
        WHERE event.id={$_GET['event_id']}");

    if($result && isset($result['data'])) {
        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="attendee_list.csv"');

        // Create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // Add UTF-8 BOM for proper Excel encoding
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

        // Add headers to CSV
        fputcsv($output, array('Name', 'Event', 'Email', 'Contact'));

        // Add data to CSV
        foreach($result['data'] as $data) {
            fputcsv($output, array(
                $data->attendee_name,
                $data->event_name,
                $data->email,
                $data->contact
            ));
        }

        // Close the file pointer
        fclose($output);
        exit();
    }
}

// Redirect back if something goes wrong
header("Location: attendee_list.php");
exit();