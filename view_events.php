<?php
include_once "config.php";

$return_arr = array();

$query = "select * from (SELECT * FROM tserver.vw_front_event order by date DESC LIMIT 50) sub
          ORDER BY date desc, time asc";

$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_array($result)) {

    $id = $row['event_id'];
    $event_name = $row['event_name'];
    $cluster_name = $row['cluster_name'];
    $date = $row['date'];
    $time = $row['time'];
    $mach_group = $row['machine_group'];
    $activate = $row['activate'];

    $return_arr[] = array("id" => $id,
                    "eventname" => $event_name,
                    "clustername" => $cluster_name,
                    "date" => $date,
                    "time" => $time,
                    "machinegroup" => $mach_group,
                    "activate" => $activate);
}

echo json_encode($return_arr);