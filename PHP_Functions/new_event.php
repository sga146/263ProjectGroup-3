<?php

/** Server Connection */
include_once "../Database/config.php";

//  Getting Data from Form
if (!empty(($_POST))) {

    // Setting responses to variables
    $event_name = mysqli_real_escape_string($conn, $_POST["event_name"]);
    $machine_group = mysqli_real_escape_string($conn, $_POST["machine_group"]);
    $clusters = mysqli_real_escape_string($conn, $_POST["clusters"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $start_time = mysqli_real_escape_string($conn, $_POST["start_time"]);
    $test_time = mysqli_real_escape_string($conn, $_POST["time_length"]);
    $time_offset = mysqli_real_escape_string($conn, "-00:05:00");

    // Changing date input into day, week, year
    $ddate = new DateTime($date);
    $week = $ddate->format("W");
    $year = $ddate->format("Y");
    $day =  $ddate->format("N");

    $day = intval($day);
    $week = intval($week);
    $year = intval($year);
    // Pushing data through appropriate functions
    $id = new_event($conn, $event_name);
    front_weekly($conn, $id, $week, $year);
    front_daily($conn, $id, $machine_group, $day, $start_time);
    front_action($conn, $id, $clusters, $time_offset, $test_time);


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
function new_event($conn, $event_name)
{
    $query = "CALL add_event('$event_name')";
    $result = $conn->query($query);
    while($row = mysqli_fetch_array($result)) {
        $id = $row['last_insert_id()'];
    }
    $result->close();
    $conn->next_result();
    return intval($id);
}

function front_weekly($conn, $id, $week, $year)
{
    $stmt = $conn->prepare("CALL add_event_week(?, ?, ?)");
    $stmt->bind_param('iii', $id, $week, $year);
    $stmt->execute();
    $stmt->close();
    $conn->next_result();
}

function front_daily($conn, $id, $group, $day, $time)
{
    $stmt = $conn->prepare("CALL add_daily(?, ?, ?, ?)");
    $stmt->bind_param('isis', $id, $group, $day, $time);
    $stmt->execute();
    $stmt->close();
    $conn->next_result();
}

function front_action($conn, $id, $cluster, $offset, $length)
{
    $stmt = $conn->prepare("CALL add_action(?, ?, ?, ?)");
    $stmt->bind_param('iiss', $id, $cluster, $offset, $length);
    $stmt->execute();
    $stmt->close();
    $conn->next_result();
}

