<?php
include_once "../Database/config.php";

$return_arr = array();

$query = "select * from vw_front_event order by event_id desc";
$result = mysqli_query($conn, $query);
$results = array();
$events = array();

while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    //make an array for current event state with all details
    $each = array();
    $each['event_id'] = $row['event_id'];
    $each['event_name'] = $row['event_name'];
    $each['cluster_name'] = $row['cluster_name'];
    $each['date'] = $row['date'];
    $each['time'] = $row['time'];
    $each['machine_group'] = $row['machine_group'];
    $each['activate'] = $row['activate'];

    $id = (string)$row["event_id"];

    //if event_id already exists, add to existing entry of results -- uncomment the below lines and remove the array_push line above to group the events by event_id

    if (array_key_exists($row['event_id'], $results)) {
        $before = $results[$row['event_id']];
        array_push($before, $each);
        $results[$id] = $before;
    } else { //if event_id doesn't exist, add to results
        $results[$id] = [$each];
    }
}


echo json_encode($results);