<?php

    // START SESSION
    session_start();

    // CONNECT TO DATABASE
    include "../php/database.php";

    // OPEN CONNECTION TO DB
    $conn = openConnection();

    // SESSION VARIABLES
    $session_username = $_SESSION["username"];
    $session_id = $_SESSION["user_id"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <link rel="stylesheet" href="../css/styleCalendar.css">
</head>
<body>
    <div class="calendar-container">

        <div class="side-menu">

            <a href="profile.php"><div class="profile-container">
                <div class="profile-icon"></div>
                <h3 class="menu-text" id="profile-text">Profile name</h3>
            </div></a>

            <div class="options">
                <a href="dashboard.php"><div class="option-container">
                    <div class="menu-icon"></div>
                    <h3 class="menu-text">Dashboard</h3>
                </div></a>
                <a href="todayList.php"><div class="option-container">
                    <div class="menu-icon"></div>
                    <h3 class="menu-text">Today</h3>
                </div></a>
                <a href="calendar.php"><div class="option-container">
                    <div class="menu-icon"></div>
                    <h3 class="menu-text">Calendar</h3>
                </div></a>
                <div class="option-container-options">
                <a href="taskList.php"><div class="option-container" id="option-container">
                        <div class="menu-icon" id="list-icon"></div>
                        <h3 class="menu-text" id="list-text">Lists</h3>
                        <img id="arrow-icon" src="../icons/side_menu/arrow_icon.svg" alt="arrow-icon">
                    </div></a>
                    <div class="list-name-block" id="list-name-block">
                        <h4 id="create-new-list">Create new list</h4>
                    </div>
                    
                </div>
                <a href="moodboard.php"><div class="option-container">
                    <div class="menu-icon"></div>
                    <h3 class="menu-text">Moodboard</h3>
                </div></a>
            </div>
            
            <div class="current-mood">
                <button>What is your current mood?</button>
            </div>

        </div>
        <div class="main-container">

            <div class="header">
                <h1>Calendar</h1>
                <div id="switch-calendar">
                    <a href="calendar.php"><div class="switch-view-blocks" id="month-view"></div></a>
                    <a href="five-day-cal.php"><div class="switch-view-blocks" id="five-day-view"></div></a>
                </div>
            </div>
            <div class="subheader">
                <div id="switch-month-block">
                    <button type="button" class="month-arrows" id="left-arrow"><</button>
                    <h2 id="month-name">Month name</h2>
                    <button type="button" class="month-arrows" id="right-arrow">></button>
                </div>
                <h2 id="current-date">Current date</h2>
            </div>
            <div class="calendar-flex-row">
                <div id="daynames-and-days">
                    <div class="day-names" id="day-names"></div>
                    <div class="calendar-main-container" id="calendar-main-container"></div>
                </div>
                <div class="day-tasks" id="day-tasks">
                    <h2>Tasks</h2>
                    <div class="day-task-container">
                        <?php

                        // RETRIEVE TASKS FOR USER
                        $getTasks = "SELECT * FROM Task WHERE user_id = '$session_id'";
                        $queryGetTasks = $conn->query($getTasks);
                        // $count_rows = mysqli_num_rows($queryGetTasks);

                        if ($queryGetTasks == TRUE) {
                            if ($queryGetTasks->num_rows > 0) {
                                while ($taskRow = mysqli_fetch_assoc($queryGetTasks)) {
                                    $name = $taskRow["name"];
                        ?>

                        <div class="cal-task">
                            <p><?php echo "$name"?></p>
                        </div>

                        <?php

                                    }
                                }
                            }

                        ?>


                    </div>
                </div>
            </div>
            
        </div>

        

    </div>

</body>
<script src="../scripts/scriptCalendar.js"></script>
</html>

<?php

closeConnection($conn);
exit();

?>