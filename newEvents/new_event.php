<?php

/** Server Connection */
require_once "../database/config.php";

//  Getting Data from Form
if (isset($_POST['event_name'],
    $_POST['machine_group'], $_POST['clusters'],
    $_POST['date'], $_POST['start_time'],
    $_POST['time_offset'])) {

    // Setting responses to variables
    $event_name = $_POST['event_name'];
    $machine_group = $_POST['machine_group'];
    $clusters = $_POST['clusters'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $offset_time = $_POST['time_offset'];

    // Changing date input into day, week, year
    $ddate = new DateTime($date);
    $week = $ddate->format("W");
    $year = $ddate->format("Y");
    $day =  $ddate->format("d");

    // Pushing data through appropriate functions
    $id = new_event($conn, $event_name);
    front_weekly($conn, $id, $date);
    front_daily($conn, $id, $machine_group, $date, $start_time);

}
/*  Old function grabbed the next id through taking the max value and adding one.

    function next_event($conn) {
    $query = "SELECT MAX(event_id)+1 AS eventid FROM tserver.front_event";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    return $row['eventid'];
    }
 */

// This function pushes the event name to the database to get the id
function new_event($conn, $event_name) {
    $query = "CALL add_event('" . $event_name . "');";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result)) {

        $id = $row['last_insert_id()'];
    }
    echo "Check ID: " . print_r($id, true);
    return $id;
}

// Inserts event into front weekly
function front_weekly($conn, $id, $date) {

    $query = "CALL add_event_week('" . $id . "', '" . $week . "', '" . $year . "');";
    $result = $conn->query($query);
    echo "Check Weekly: " . $result;
    return $result;
}

function front_daily($conn, $id, $group, $day, $time) {
    $query = "CALL add_daily('" . $id . "', '" . $group . "', '" . $day . "', '" . $time . "');";
    $result = $conn->query($query);
    echo "Check Weekly: " . $result;
    return $result;
}

function front_action() {

}


// Insert into front_event - event name and status
// Insert into front weekly - event id, week, year

// Insert into front_daily - event id, group, day, start time
// One statement for each group

// Insert into front_action - event id, time offset, cluster id, activate
// Four statements, turning off/on clusters before and after tests

