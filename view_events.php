<?php
$hostname = "127.0.0.1";
$database = "tserver";
$username = "root";
$password = "mysql";

//new connection to database
$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error)
{
    fatalError($conn->connect_error);
    return;
}

function viewEvent($conn) {
    //SQL statement to get all event details from database
    $query = "select * from vw_front_event order by time, cluster_id, group_id";
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

        array_push($results, $each);
        // if event_id already exists, add to existing entry of results -- uncomment the below lines and remove the array_push line above to group the events by event_id

        // if (array_key_exists($row['event_id'], $results)) { 
        //     $before = $results[$row['event_id']];
        //     array_push($before, $each);
        //     $results[$id] = $before;
        // } else { //if event_id doesn't exist, add to results
        //     $results[$id] = [$each];
        // }
    }
    return $results;
}

//view_events.js will pick this up
echo print_r(viewEvent($conn), true); 
?>
