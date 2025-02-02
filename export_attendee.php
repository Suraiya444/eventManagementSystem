<?php
include('include/connection.php');

if(isset($_GET['event_id'])) {
    $result = $mysqli->common_select_query("SELECT attendee.name as attendee_name, event.name as event_name, attendee.email, attendee.contact 
                                            FROM event JOIN attendee ON attendee.event_id=event.id  WHERE event.id={$_GET['event_id']}");
                            if($result && isset($result['data'])) {  
                                header('Content-Type: text/csv');
                                header('Content-Disposition: attachment; filename="attendee_list.csv"');
                                $output = fopen('php://output', 'w');
                                fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
                                fputcsv($output, array('Name', 'Event', 'Email', 'Contact'));
                                foreach($result['data'] as $data) {
                                    fputcsv($output, array(
                                        $data->attendee_name,
                                        $data->event_name,
                                        $data->email,
                                        $data->contact
                                    ));
                                }
                                fclose($output);
                                exit();
                            }
                        }
header("Location: attendee_list.php");
exit();