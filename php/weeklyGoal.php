<?php

session_start();

// CONNECT TO DATABASE
include "database.php";

$conn = openConnection();

$goal_name = ucfirst($_POST["weekly-goal-entry"]);
$monday = date( 'Y-m-d', strtotime( "monday this week"));
$sunday = date( 'Y-m-d', strtotime( "sunday this week"));

// print_r($monday);
// print_r($sunday);

if (empty($goal_name)) {
    header("Location: ../pages/taskList.php");
    exit();
}

$checkDates = "SELECT * FROM WeeklyGoal WHERE start_date = '$monday' AND end_date = '$sunday';";
$queryCheckDates = $conn->query($checkDates);
if ($queryCheckDates == TRUE) {
    if ($queryCheckDates->num_rows === 1) {
        $updateGoal = "UPDATE WeeklyGoal SET goal_name = '$goal_name' WHERE start_date = '$monday' AND end_date = '$sunday';";
        $queryUpdateGoal = $conn->query($updateGoal);
        if ($queryUpdateGoal === TRUE) {
            header("Location: ../pages/taskList.php");
            exit();
        }
    } else if ($queryCheckDates->num_rows === 0) {
        $insertGoal = "INSERT INTO WeeklyGoal(goal_name, start_date, end_date) VALUES ('$goal_name', '$monday', '$sunday');";
        $inserting = $conn->query($insertGoal);
        if ($inserting == TRUE) {
            echo "success";
            header("Location: ../pages/taskList.php");
            exit();
        } else {
            echo "fail";
            header("Location: ../pages/taskList.php");
            exit();
        }
        
    }

}

closeConnection($conn);
exit();


?>