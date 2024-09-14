<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleProfile.css">
    <title>Profile</title>
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

            <h1>Profile Page</h1>
            
                <div class="left-side">
                    
                    <div class="header-container">
                        <div class="icon"></div>
                        <h3>Username</h3>
                    </div>
        
                    <div class="change-username">
                        <h3>Change username</h3>
                    </div>
            
                    <div class="delete-account">
                        <h3>Delete account</h3>
                    </div>

                    <div class="logout">
                        <a href="../php/logout.php"><h3>Log out</h3></a>
                    </div>
                
                </div>
                

            
            
        </div>
    </div>

    

</body>
</html>