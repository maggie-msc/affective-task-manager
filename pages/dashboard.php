<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleDashboard.css">
    <title>Dashboard</title>
</head>
<body>

    <div class="dashboard-container">

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

            <h1>Welcome to your dashboard, username</h1>
            
            <div class="sides">
                <div class="left-side">
    
                    <div class="heatmap-container">
                        <h3>Your mood heatmap for this week</h3>
                        <div class="heatmap"></div>
                    </div>
    
                    <div class="goal-container">
                        <div class="weekly-goal">
                            <h3>Your goal for the week</h3>
    
                        </div>
                    </div>
                    <div class="left-horizontal">
                        <div class="schedule-tasks">
                            <h2>Tasks scheduled</h2>
                            <h1>0</h1>
                        </div>
                        <div class="mood-goal">
                            <h2>Create mood goal</h2>
                        </div>
    
                    </div>
                </div>
                <div class="right-side">
    
                    <div class="overallmood-container">
                        <div class="goal"></div>
                        <h3>Overall mood this week</h3>
                    </div>
    
                    <div class="week-container">
                        <div class="week-goal">
                            <p>SUN</p>
                        </div>
                        <div class="week-goal">
                            <p>MON</p>
                        </div>
                        <div class="week-goal">
                            <p>TUE</p>
                        </div>
                        <div class="week-goal">
                            <p>WED</p>
                        </div>
                        <div class="week-goal">
                            <p>THUR</p>
                        </div>
                        <div class="week-goal">
                            <p>FRI</p>
                        </div>
                        <div class="week-goal">
                            <p>SAT</p>
                        </div>
                    </div>
                    
                </div>

            </div>
            <div class="bottom">
                <div class="arrow"></div>
            </div>
        </div>
    </div>

    

</body>
</html>