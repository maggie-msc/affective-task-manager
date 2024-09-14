<?php

session_start();

// CONNECT TO DATABASE
include "database.php";

$conn = openConnection();

$mood_value = $_POST["little-mood-value"];
$monday = date( 'Y-m-d', strtotime( "monday this week"));
$sunday = date( 'Y-m-d', strtotime( "sunday this week"));

if ($mood_value === "") {
    header("Location: ../pages/taskList.php");
    exit();
}

$checkDates = "SELECT * FROM WeeklyMoodGoal WHERE start_date = '$monday' AND end_date = '$sunday';";
$queryCheckDates = $conn->query($checkDates);
if ($queryCheckDates == TRUE) {
    if ($queryCheckDates->num_rows === 1) {
        $updateGoal = "UPDATE WeeklyMoodGoal SET moodgoal_name = '$mood_value' WHERE start_date = '$monday' AND end_date = '$sunday';";
        $queryUpdateGoal = $conn->query($updateGoal);
        if ($queryUpdateGoal === TRUE) {
            header("Location: ../pages/taskList.php");
            exit();
        }
    } else if ($queryCheckDates->num_rows === 0) {
        $insertGoal = "INSERT INTO WeeklyMoodGoal(moodgoal_name, start_date, end_date) VALUES ('$mood_value', '$monday', '$sunday');";
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