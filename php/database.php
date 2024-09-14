<?php
// connect database

function openConnection() {
    /*
    Configure the following variables with your own cendentials you have in MySQL to create a connection:
    - $host = Hostname
    - $username = Username
    - $password = Password
    */

    $host = "";
    $database = "affective_task_manager";
    $username = "";
    $password = "";
    
    // create connection
    $conn = new mysqli($host, $username, $password, $database);
    
    // check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
    }

    return $conn;

}

function closeConnection($connection) {
    $connection->close();
}


?>