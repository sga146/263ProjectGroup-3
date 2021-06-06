<?php
session_start();
require_once("database/config.php");
$event_name ="";
$machine_group = "";
$clusters = "";
$date = "";
$start_time = "";
$test_time = "";
$time_offset = "";

if (isset($_GET['delete_event'])) {
    $event_id = $_GET['delete_event'];
    $conn->query("delete from vw_front_event where event_id = $event_id") or die($conn->error);
    $_SESSION['message'] = "front_action has been  deleted";
    $_SESSION['mes_type'] = "Danger";
    header("location: edit.php");
}

if (isset($_GET['edit'])){
    $event_id = $_GET['edit'];
    $result = $conn->query("SELECT from * vw_front_event where event_id=$event_id" )or die($conn->error);
    if (count($result)==1){
        $row = $result->fetch_array();
        $event_name = $row['event_name'];
        $machine_group = $row['machine_group'];
        $clusters = $row['clusters'];
        $date = $row['date'];
        $start_time = $row['start_time'];
        $test_time = $row['test_time'];
        $time_offset = $row['time_offset'];


    }
}
if (isset($_POST['update'])) {
    $event_name = $_POST['event_name'];
    $machine_group = $_POST['machine_group'];
    $clusters = $_POST['clusters'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $test_time = $_POST['test_time'];
    $time_offset = $_POST['time_offset'];

    $conn->query("UPDATE vw_front_event SET event_name='$event_name', machine_group='$machine_group', clusters='$clusters', date='$date'', start_time='$start_time'', test_time='$test_time', time_offset='$time_offset'");

    $_SESSION['message'] = "Updated";
    $_SESSION['mes_type'] = "warning";

    header("location: edit.php");
}
?>