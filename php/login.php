<?php

    // connect to database
    include "database.php";

    $conn = openConnection();

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Login

    // check existing username
    $checkUsernameExists = "SELECT * FROM User WHERE username = '$username';";
    $sqlFindUsername = $conn->query($checkUsernameExists);
    $checkArray = $sqlFindUsername->fetch_assoc();
    
    if ($sqlFindUsername->num_rows === 1) {
        if (password_verify($password, $checkArray["password"])) {
            echo "Login successful";
            session_start();
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $checkArray["user_id"];
            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            echo "Unsuccessful login";
        }
    } else {
        echo "Unsuccessful login";
    }




    closeConnection($conn);
    exit();

    

?>