<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moodboard</title>
    <link rel="stylesheet" href="../css/styleMoodboard.css">
</head>
<body>
    <div class="moodboard-container">

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
                <h1>Moodboard</h1>

            </div>

            <div class="moodboard-block-container">
                
            </div>
            
        </div>

        

    </div>

</body>
</html>