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

            <div class="profile-container">
                <div class="profile-icon"></div>
                <a href="profile.php"><h3 class="menu-text">Profile name</h3></a>
            </div>

            <div class="options">
                <div class="option-container">
                    <div class="menu-icon"></div>
                    <a href="todayList.php"><h3 class="menu-text">Today</h3></a>
                </div>
                <div class="option-container">
                    <div class="menu-icon"></div>
                    <a href="dashboard.php"><h3 class="menu-text">Dashboard</h3></a>
                </div>
                <div class="option-container">
                    <div class="menu-icon"></div>
                    <a href="calendar.php"><h3 class="menu-text">Calendar</h3></a>
                </div>
                <div class="option-container">
                    <div class="menu-icon"></div>
                    <a href="taskList.php"><h3 class="menu-text">Task Lists</h3></a>
                </div>
                <div class="option-container">
                    <div class="menu-icon"></div>
                    <a href="moodboard.php"><h3 class="menu-text">Moodboard</h3></a>
                </div>
            </div>
            
            <div class="current-mood">
                <button>What is your current mood?</button>
            </div>

        </div>
        <div class="main-container">

            <div class="header">
                <h1>5 day view</h1>
                <div id="switch-calendar">
                <a href="calendar.php"><div class="switch-view-blocks" id="month-view"></div></a>
                    <a href="five-day-cal.php"><div class="switch-view-blocks" id="five-day-view"></div></a>
                </div>
            </div>
            <div class="subheader">
                <h2 id="month-name">Month name</h2>
                <h2 id="current-date">Current date</h2>
            </div>
            <div class="calendar-flex-row">
                <div class="calendar-main-container" id="calendar-main-container">
                    
                </div>
    
                <div class="day-tasks" id="day-tasks">
    
                </div>
            </div>
            
        </div>

        

    </div>

</body>
<script src="../scripts/scriptCalendar.js"></script>
</html>