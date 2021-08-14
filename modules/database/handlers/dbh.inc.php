<?php

$server_name = "localhost";
$database_username = "root";
$database_password = "";
$database_name = "studymate";

// MySQLi (improved) connection
$connection =  mysqli_connect($server_name, $database_username, $database_password, $database_name);

if (!$connection) {
    die();
    echo "Connection failed: ". mysqli_connect_error();
}