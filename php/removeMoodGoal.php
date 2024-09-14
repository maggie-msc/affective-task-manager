<?php

session_start();

// CONNECT TO DATABASE
include "database.php";

$conn = openConnection();

$mood_value = $_POST["little-mood-value"];
$monday = date( 'Y-m-d', strtotime( "monday this week"));
$sunday = date( 'Y-m-d', strtotime( "sunday this week"));

$removeGoal = "DELETE FROM WeeklyMoodGoal WHERE start_date = '$monday' AND end_date = '$sunday';";
$queryRemoveGoal = $conn->query($removeGoal);

if ($queryRemoveGoal === TRUE) {
    header("Location: ../pages/taskList.php");
    exit();
}

closeConnection($conn);
exit();


?>