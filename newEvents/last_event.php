<?php
include_once "../database/config.php";

$return_arr = array();
// This function pushes the event name to the database to get the id
function new_event($conn) {
    $query = "CALL get_event_number();";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)) {

        $id = $row['MAX(event_id)'];
    }
    return $id;
}

$id = new_event($conn);
echo $id;
$query = "SELECT * FROM tserver.vw_display_view where event_id = " . $id . ";";

$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_array($result)) {

    $id = $row['event_id'];
    $event_name = $row['event_name'];
    $cluster_name = $row['cluster_name'];
    $mach_group = $row['machine_group'];
    $date = $row['date'];
    $time = $row['time'];
    $activate = $row['activate'];
    $offset - $row['time_offset'];

    $return_arr[] = array("id" => $id,
                    "eventname" => $event_name,
                    "clustername" => $cluster_name,
                    "machinegroup" => $mach_group,
                    "date" => $date,
                    "time" => $time,
                    "activate" => $activate,
                    "offset" => $offset);
}

echo json_encode($return_arr);