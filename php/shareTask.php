<?php

    session_start();

    // CONNECT TO DATABASE
    include "database.php";

    $conn = openConnection();

    $getName = "SELECT * FROM User;";
    $queryGetName = $conn->query($getName);
    $nameList = array();

    if ($queryGetName == TRUE) {
        while ($userRow = mysqli_fetch_assoc($queryGetName)) {
            $name = $userRow["username"];
            // APPEND TO ARRAY FOR USERNAMES
            array_push($nameList, $name);
        }
    }

    // Check if username input has a value
    if (isset($_POST["user"])) {
        $count = 0;
        $username = $_POST["user"];
        foreach ($nameList as $aname) {
            if (strpos($aname, $username) !== false) {
                if ($aname == $_SESSION["username"]) {
                    continue;
                }
                // Display usernames when the user types values
                echo '<p class="display-user" id="display-user-'.$count.'" onclick="assignUser(this.id)">'.$aname.'</p>';
                $count+=1;
            }
        }

    }


    closeConnection($conn);
    exit();


?>