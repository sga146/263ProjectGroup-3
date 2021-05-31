<?php
// Designed to get list of current clusters

// Database Connection

require_once "config.php";

/*
    Pull Cluster list from database.
    To achieve this in a more simple manner a new view was created in the database.

    CREATE OR REPLACE VIEW vw_cluster_list AS
    SELECT
        cluster_id, cluster_name
    FROM
        front_cluster;

*/

$return_arr = array();

$query = "SELECT * FROM tserver.vw_cluster_list";

$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_array($result)) {

    $id = $row['cluster_id'];
    $cluster_name = $row['cluster_name'];

    $return_arr[] = array("id" => $id, "cluster_name" => $cluster_name);
}

echo json_encode($return_arr);
