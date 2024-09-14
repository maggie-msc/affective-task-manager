<?php

    // connect to database
    include "database.php";

    $conn = openConnection();

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];


    // Registration server validation

    // check name
    if(empty($name)) {
        die("You must enter your name");
    } else if(preg_match("/[0-9]/", $name)) {
        die("Name must not include a number");
    }
    
    // check email
    if(empty($email)) {
        die("You must enter your email");
    } else if(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die ("Valid email is required");
    }

    // check username
    if(empty($username)) {
        die("You must create a username");
    }

    // check password
    if(empty($password)) {
        die("You must enter a password");
    } else if (strlen($password) < 8) {
        die("Your password must be 8 or more characters");
    } else if (! preg_match("/[a-z]/i", $password)) {
        die("Your password must include a letter");
    } else if (! preg_match("/[0-9]/", $password)) {
        die("Your password must include a number");
    }

    // check confirmed password
    if (empty($confirmPassword)) {
        die("You must confirm your password again");
    } else if ($confirmPassword !== $password) {
        die("Your password must match");
    }

    // hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // create user data
    $insertData = "INSERT INTO User (name, email, username, password) VALUES (
        '$name', '$email', '$username', '$passwordHash');";

    // check existing email
    $checkEmailExists = "SELECT email FROM User WHERE email = '$email';";
    $sqlFindEmail = $conn->query($checkEmailExists);

    // check existing username
    $checkUsernameExists = "SELECT username FROM User WHERE username = '$username';";
    $sqlFindUsername = $conn->query($checkUsernameExists);
    
    if ($sqlFindEmail->num_rows === 1) {
        echo "Email already exists";
    } else if ($sqlFindUsername->num_rows === 1) {
        echo "Username already exists. Create another username";
    } else {
        if ($conn->query($insertData) === TRUE) {
            echo "Successful registration";
            header("Location: ../pages/login.html");
        } else {
            echo "Error: " . $insertData . $conn->error;
        }
    }




    closeConnection($conn);
    exit();

    

?>