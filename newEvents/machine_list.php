<?php
// Designed to get list of current groups

// Database Connection

require_once "../database/config.php";

/*  Pull Group list from database.
    To achieve this in a more simple manner a new view was created in the database.

    CREATE OR REPLACE VIEW vw_machine_list AS
    SELECT
        group_id, machine_group
    FROM
        front_group;
*/

$return_arr = array();

$query = "SELECT * FROM tserver.vw_machine_list";

$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_array($result)) {

    $id = $row['group_id'];
    $group_name = $row['machine_group'];

    $return_arr[] = array("id" => $id, "group" => $group_name);
}

echo json_encode($return_arr);
