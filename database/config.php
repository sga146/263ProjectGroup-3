<?php

/**
 *  Defining constants for database access.
 */

const hostname = "127.0.0.1";
const username = "root";
const password = "mysql";
const database = "tserver";


$conn = mysqli_connect(hostname, username, password, database);

// Check Connection

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}