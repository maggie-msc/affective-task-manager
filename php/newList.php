<?php

    session_start();

    // CONNECT TO DATABASE
    include "database.php";

    // OPEN CONNECTION
    $conn = openConnection();

    // GET NEW LIST DATA FROM FORM
    $listName = $_POST["new-list-name"];

    // FIND USERNAME ID
    $username = $_SESSION["username"];
    $username_id = $_SESSION["user_id"];
    
    if(isset($_POST["new-list-button"])) {
        
        // INSERT NEW LIST NAME INTO TABLE TaskList
        $insertNewList = "INSERT INTO TaskList (list_name) VALUES ('$listName');";
        $queryNewList = $conn->query($insertNewList);

        if ($queryNewList==true) {
            header("Location: ../pages/taskList.php");
        }
    }

    closeConnection($conn);
    exit();


?>