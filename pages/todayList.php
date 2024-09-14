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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Today List</title>
    <link rel="stylesheet" href="../css/styleTaskList.css">
</head>
<body>
    <div class="taskList-container">

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

                        <?php

                        // RETRIEVE LIST NAMES FROM DATABASE APART FROM TODAY LIST
                        $getLists = "SELECT * FROM TaskList WHERE list_name != 'Today'";
                        $queryGetLists = $conn->query($getLists);

                        if ($queryGetLists==true && $queryGetLists->num_rows > 0) {
                            while ($listRow = mysqli_fetch_assoc($queryGetLists)) {
                                $listName = $listRow["list_name"];    
                                $_SESSION["currentList"] = $listName;
                        
                        ?>

                        <a class="user-list-name" href=""><h4><?php echo"$listName" ?></h4></a>

                        <?php

                            }
                        } else {

                        };

                        ?>

                    </div>
                    
                </div>
                <a href="moodboard.php"><div class="option-container">
                    <div class="menu-icon"></div>
                    <h3 class="menu-text">Moodboard</h3>
                </div></a>
            </div>
            
            <div id="current-mood" class="current-mood">
                <button>What is your current mood?</button>
            </div>

        </div>
        <div class="main-container">

            <div class="header">
                <h1>Today's List</h1>
                <form action="../php/weeklyGoal.php" method="post">
                    <div class="mood-container">
                        <?php
                        $monday = date( 'Y-m-d', strtotime( "monday this week"));
                        $sunday = date( 'Y-m-d', strtotime( "sunday this week"));                        
                        $weeklyGoal = "SELECT goal_name FROM WeeklyGoal WHERE start_date = '$monday' AND end_date = '$sunday';";
                        $sql = $conn->query($weeklyGoal);
                        if ($sql == TRUE) {
                            if ($sql->num_rows > 0) {
                                while ($taskRow = mysqli_fetch_assoc($sql)) {
                                    $goal_name = $taskRow["goal_name"];
                        ?>
                                <div class="weekly-goal" id="weekly-goal">Your goal:&nbsp;<?php echo "<b><i>$goal_name</i></b>"; ?></div>
                        <?php
                                }
                            }
                        }
                        ?>
                        <!-- Input goal -->
                        <input type="text" name="weekly-goal-entry" id="weekly-goal-entry" autocapitalize="on" placeholder="What do you want to achieve this week?">
                        <!-- Cancel creating a goal -->
                        <button type="button" id="cancel-weekly-goal">Cancel</button>
                        <!-- Create the weekly goal -->
                        <button type="submit" id="create-goal">Create Goal</button>
                        <!-- Show create goal input prompt -->
                        <button type="button" id="create-weekly-goal" class="buttons create-goal">What do you want to achieve this week?</button>
                        <!-- Show prompt to create mood goal -->
                        <button type="button" id="create-mood-goal" class="buttons mood-goal">Add mood goal
                        <?php
                        $monday = date( 'Y-m-d', strtotime( "monday this week"));
                        $sunday = date( 'Y-m-d', strtotime( "sunday this week"));                        
                        $weeklyGoal = "SELECT * FROM WeeklyMoodGoal WHERE start_date = '$monday' AND end_date = '$sunday';";
                        $sql = $conn->query($weeklyGoal);
                        if ($sql == TRUE) {
                            if ($sql->num_rows > 0) {
                                while ($taskRow = mysqli_fetch_assoc($sql)) {
                                    $goal_name = $taskRow["moodgoal_name"];
                        
                                    
                                    $moodList = ["calm", "confident", "excited", "hopeful", "neutral", "optimistic"];
                                    if ($goal_name == "calm") {
                                        echo'<img class="little-image" src="../icons/mood_svgs/calm.svg" alt="calm">';
                                    } elseif ($goal_name == "confident") {
                                        echo'<img class="little-image" src="../icons/mood_svgs/confident.svg" alt="confident">';
                                    } elseif ($goal_name == "excited") {
                                        echo'<img class="little-image" src="../icons/mood_svgs/excited.svg" alt="excited">';
                                    } elseif ($goal_name == "hopeful") {
                                        echo'<img class="little-image" src="../icons/mood_svgs/hopeful.svg" alt="hopeful">';
                                    } elseif ($goal_name == "neutral") {
                                        echo'<img class="little-image" src="../icons/mood_svgs/neutral.svg" alt="neutral">';
                                    } elseif ($goal_name == "optimistic") {
                                        echo'<img class="little-image" src="../icons/mood_svgs/optimistic.svg" alt="optimistic">';
                                    } 


                                    
                                }
                            }
                        }
                        ?>
                        </button>

                    </div>

                </form>
            </div>
            <form action="../php/weeklyMoodGoal.php" method="post">
                <div class="little-mood-select" id="little-mood-select">
                    <input type="hidden" name="little-mood-value" id="little-mood-value" value="">
                    <button type="button" class="little-moods" id="current-button-2" onclick="displayMoodGoal(this.id)"><img class="image-background-colour" id="calm" src="../icons/mood_svgs/calm.svg" alt="calm"></button>
                    <button type="button" class="little-moods" id="current-button-3" onclick="displayMoodGoal(this.id)"><img class="image-background-colour" id="confident" src="../icons/mood_svgs/confident.svg" alt="confident"></button>
                    <button type="button" class="little-moods" id="current-button-5" onclick="displayMoodGoal(this.id)"><img class="image-background-colour" id="excited" src="../icons/mood_svgs/excited.svg" alt="excited"></button>
                    <button type="button" class="little-moods" id="current-button-8" onclick="displayMoodGoal(this.id)"><img class="image-background-colour" id="hopeful" src="../icons/mood_svgs/hopeful.svg" alt="hopeful"></button>
                    <button type="button" class="little-moods" id="current-button-10"onclick="displayMoodGoal(this.id)"><img class="image-background-colour" id="neutral" src="../icons/mood_svgs/neutral.svg" alt="neutral"></button>                            
                    <button type="button" class="little-moods" id="current-button-12"onclick="displayMoodGoal(this.id)"><img class="image-background-colour" id="optimistic" src="../icons/mood_svgs/optimistic.svg" alt="optimistic"></button>                            
                    <button type="submit" id="add-mood-goal-button">Add mood goal</button>
                    <button type="submit" formaction="../php/removeMoodGoal.php" id="remove-mood-goal-button">Remove mood goal</button>
                </div>
            </form>

            <div class="tasks-container">

                <?php

                // RETRIEVE TASKS FOR USER
                $getTasks = "SELECT * FROM Task WHERE user_id = '$session_id' OR shared_user = '$session_id';";
                $queryGetTasks = $conn->query($getTasks);
                // $count_rows = mysqli_num_rows($queryGetTasks);

                if ($queryGetTasks == TRUE) {
                    if ($queryGetTasks->num_rows > 0) {
                        while ($taskRow = mysqli_fetch_assoc($queryGetTasks)) {
                            $name = $taskRow["name"];
                            $description = $taskRow["description"];
                            $dueDate = $taskRow["due_date"];
                            $priority = $taskRow["priority"];
                            $mood = $taskRow["mood"];
                            $userId = $taskRow["user_id"];
                            $sharedUser = $taskRow["shared_user"];

                ?>

                <div class="task">
                    <div class="checkbox"></div>
                    <div class="content">
                        <div class="task-content-one">
                            <h4 class="taskname"><?php echo"$name" ?></h4>
                            <div class="tag-list">
                                <!-- <div class="tag-name"><h4>Tag name</h4></div>
                                <div class="tag-name"><h4>Tag name name</h4></div>
                                <div class="tag-name"><h4>Tag name</h4></div> -->
                            </div>
                            <button type="button" class="tag-button">+</button>
                        </div>
                        <?php
                            // if ($sharedUser != null) {
                            //     $findUser = "SELECT name FROM User WHERE user_id = '$sharedUser';";
                            //     $sqlFindUser = $conn->query($findUser);
                            //     if ($sqlFindUser == TRUE) {
                            //         if ($sqlFindUser->num_rows === 1) {
                            //             $row = $sqlFindUser->fetch_assoc();
                            //             // $user_id = $row["user_id"];
                            //             $user_name = $row["name"];
                                            
                        ?>
                        <!-- <div class="peek-user" id="peek-user">
                            <p class="peek-header">Shared task with:</p>
                            <p class="peek-main"><?php // echo $user_name ?></p>
                        </div> -->
                        <?php
                            //         }
                            //     }
                            // }
                        ?>
                        <div class="task-content-two">
                        <?php
                            if ($sharedUser != null) {
                                if ($sharedUser == $session_id) {
                                    $findParentUser = "SELECT name FROM User WHERE user_id = '$userId';";
                                    $sqlFindParentUser = $conn->query($findParentUser);
                                    if ($sqlFindParentUser == TRUE) {
                                        if ($sqlFindParentUser->num_rows === 1) {
                                            $parent_row = $sqlFindParentUser->fetch_assoc();
                                            $parent_user_name = $parent_row["name"];
                        ?>
                        <div class="assigned-sharedUser-icon icon">
                            <p class="shared-intial"><?php echo substr($parent_user_name, 0, 1) ?></p>
                        </div>

                        <?php
                                        }
                                    }
                                } else {
                                    $findUser = "SELECT name FROM User WHERE user_id = '$sharedUser';";
                                    $sqlFindUser = $conn->query($findUser);
                                    if ($sqlFindUser == TRUE) {
                                        if ($sqlFindUser->num_rows === 1) {
                                            $row = $sqlFindUser->fetch_assoc();
                                            $user_name = $row["name"];
                        ?>
                        <div class="sharedUser-icon icon">
                            <p class="shared-intial"><?php echo substr($user_name, 0, 1) ?></p>
                        </div>
                        <?php
                                        }
                                    }
                                }
                            }

                        ?>

                            <div class="description-icon icon">
                                <?php

                                if ($description != null) {
                                    echo'<img src="../icons/task_svgs/description.svg" alt="description">';
                                }

                                ?>
                            </div>
                            <div>
                                <?php
                                if($dueDate == null) {
                                ?>
                                <p class="greyed-out-date">Due date</p>
                                <?php
                                } else {
                                ?>

                                <p id="due-date-label">Due date</p>
                                <p class="due-date"><?php echo"$dueDate";  ?></p>
                                
                                <?php
                                }
                                ?>
                            </div>
                            <div class="priority-icon icon">
                                <?php

                                $priorities = ["no-priority", "low-priority", "med-priority", "high-priority"];
                                if ($priority == "no-priority") {
                                    echo'<img src="../icons/priority_svgs/no_priority.svg" alt="no-priority">';
                                } elseif ($priority == "low-priority") {
                                    echo'<img src="../icons/priority_svgs/low_priority.svg" alt="low-priority">';
                                } elseif ($priority == "med-priority") {
                                    echo'<img src="../icons/priority_svgs/med_priority.svg" alt="med-priority">';
                                } elseif ($priority == "high-priority") {
                                    echo'<img src="../icons/priority_svgs/high_priority.svg" alt="high-priority">';
                                }


                                ?>
                            </div>
                            <div class="mood-separator">
                                <div class="mood-icon icon">
                                    <?php
                                    $moodList = ["anxious", "bothered", "calm", "confident", "confused", "excited", "gloomy", "glum", "hopeful", "nervous", "neutral"];
                                    if ($mood == "anxious") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/anxious.svg" alt="neutral">';
                                    } elseif ($mood == "bothered") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/bothered.svg" alt="bothered">';
                                    } elseif ($mood == "calm") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/calm.svg" alt="calm">';
                                    } elseif ($mood == "confident") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/confident.svg" alt="confident">';
                                    } elseif ($mood == "confused") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/confused.svg" alt="confused">';
                                    } elseif ($mood == "excited") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/excited.svg" alt="excited">';
                                    } elseif ($mood == "gloomy") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/gloomy.svg" alt="gloomy">';
                                    } elseif ($mood == "glum") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/glum.svg" alt="glum">';
                                    } elseif ($mood == "hopeful") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/hopeful.svg" alt="hopeful">';
                                    } elseif ($mood == "nervous") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/nervous.svg" alt="nervous">';
                                    } elseif ($mood == "neutral") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/neutral.svg" alt="neutral">';
                                    } elseif ($mood == "not-bothered") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/not_bothered.svg" alt="not-bothered">';
                                    } elseif ($mood == "optimistic") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/glum.svg" alt="optimistic">';
                                    } elseif ($mood == "restless") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/restless.svg" alt="restless">';
                                    } elseif ($mood == "tense") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/tense.svg" alt="tense">';
                                    } elseif ($mood == "tired") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/tired.svg" alt="tired">';
                                    } elseif ($mood == "worried") {
                                        echo'<img class="display-mood" src="../icons/mood_svgs/worried.svg" alt="worried">';
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

                            }
                        }
                    }

                ?>

                <div id="new-task" class="new-task">
                    <div id="createTask-button" class="createTask-button"><h4>+</h4></div>
                    <div class="content">
                        <div class="task-content-one">
                            <h4 class="taskname">Create new task</h4>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="overlay" id="overlay">
            <div class="create-container" id="create-container">
                
                <form id="task-info-block" action="../php/phpTaskList.php" method="post">
                    <div class="taskName-block">
                        <input type="text" name="name" id="name" placeholder="New task">
                        <button type="button" class="no-priority" id="priority-button">P</button>
                    </div>

                    <div class="start-due-block">
                        <div class="date-block">
                            <label for="start-date">Start date</label>
                            <input type="date" name="start-date" id="start-date">
                        </div>
                        <div class="date-block">
                            <label for="due-date">Due date</label>
                            <input type="date" name="due-date" id="due-date">
                        </div>
                    </div>

                    <div class="tag-block" id="tag-block">
                        <div class="tags" id="tags"></div>
                        <div class="input-tags-content">
                            <input type="text" id="new-tag" placeholder="Enter or create a new tag">
                            <div class="show-tags" id="show-tags"></div>
                        </div>
                        <button type="button" id="add-new-tag">Enter tag</button>
                    </div>

                    <div class="middle-block">
                        <textarea form="task-info-block" name="description" id="description" cols="50" rows="12" placeholder="Description"></textarea>
                        <div class="share">
                            <label for="share-user">Shared with:</label>
                            <button type="button" id="share-user-button">Share task with a user</button>
                            <button type="button" id="remove-user" class="remove-user">x</button>
                        </div>
                        <div class="find-user-block" id="find-user-block">
                            <div class="find-user-header" id="find-user-header">
                                <input type="text" name="username" id="username" placeholder="Search for a user...">
                            </div>
                            <div class="find-user-main" id="find-user-main">
                                <p id="display-users" class="display-users"></p>
                            </div>
                        </div>
                    </div>

                    <div class="checklist-block" id="checklist-block">
                        <h4 id="subtask-header">Create Checklist ...</h4>
                        <div id="sub-task-block" class="sub-task-block">
                            <div id="create-sub-task" class="create-sub-task">
                                <p class="create-subtask-name">Add new task</p>
                            </div>                            
                        </div>

                    </div>

                    <div class="bottom-block">
                        <div class="mood-block bottom-elements" id="mood-block">
                            <p id="tag-heading">Mood tag</p>
                            <button type="button" id="add-mood-tag" onclick="moodTagPrompt()">Add mood tag</button>
                        </div>
                        <div class="time-block bottom-elements">
                            <p>Time estimate</p>
                            <input type="number" step="10" name="time-estimate" id="time-estimate" placeholder="30m">
                        </div>
                    </div>
                    <input type="hidden" name="mood-tag-value"  id="mood-tag-value" value="">
                    <input type="hidden" name="priority-value" id="priority-value" value="no-priority">
                    <input type="hidden" name="shareuser-value" id="shareuser-value" value="">
                    <input type="hidden" name="time-input" id="time-input" value="">

                    <div class="select-mood-block" id="select-mood-block">
                        <p>Select a mood tag</p>
                        <div class="mood-images" id="mood-images">
                            <button type="button" class="image-button" id="image-button-0" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/anxious.svg" alt="anxious"><p>anxious</p></button>
                            <button type="button" class="image-button" id="image-button-1" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/bothered.svg" alt="bothered"></button>
                            <button type="button" class="image-button" id="image-button-2" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/calm.svg" alt="calm"></button>
                            <button type="button" class="image-button" id="image-button-3" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/confident.svg" alt="confident"></button>
                            <button type="button" class="image-button" id="image-button-4" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/confused.svg" alt="confused"></button>
                            <button type="button" class="image-button" id="image-button-5" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/excited.svg" alt="excited"></button>
                            <button type="button" class="image-button" id="image-button-6" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/gloomy.svg" alt="gloomy"></button>
                            <button type="button" class="image-button" id="image-button-7" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/glum.svg" alt="glum"></button>
                            <button type="button" class="image-button" id="image-button-8" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/hopeful.svg" alt="hopeful"></button>
                            <button type="button" class="image-button" id="image-button-9" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/nervous.svg" alt="nervous"></button>                            
                            <button type="button" class="image-button" id="image-button-10" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/neutral.svg" alt="neutral"></button>                            
                            <button type="button" class="image-button" id="image-button-11" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/not_bothered.svg" alt="not-bothered"></button>                            
                            <button type="button" class="image-button" id="image-button-12" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/optimistic.svg" alt="optimistic"></button>                            
                            <button type="button" class="image-button" id="image-button-13" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/restless.svg" alt="restless"></button>                            
                            <button type="button" class="image-button" id="image-button-14" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/tense.svg" alt="tense"></button>                            
                            <button type="button" class="image-button" id="image-button-15" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/tired.svg" alt="tired"></button>                            
                            <button type="button" class="image-button" id="image-button-16" onclick="clickedTag(this.id)"><img src="../icons/mood_svgs/worried.svg" alt="worried"></button>                            
                        </div>
                        <div class="select-tag-buttons" id="select-tag-buttons">
                            <button type="button" class="mood-tag-buttons" id="select-tag-button" onclick="closeTagPrompt()">Complete</button>
                            <button type="button" class="mood-tag-buttons" id="cancel-tag-button" onclick="cancelMoodTagPrompt()">Cancel</button>
                        </div>
                    </div>
                    <div class="task-buttons-container">
                        <input type="button" class="task-buttons" id="cancel-button" onclick="cancelTask()" value="Cancel">
                        <input type="submit" class="task-buttons" id="submit-button" value="Create task">
                    </div>
                </form>
            </div>
        </div>

        <div id="overlay-new-list">
            <div id="new-list-block">
                <form id="new-list-info" action="../php/newList.php" method="post">
                    <h1>Create a new task list</h1>
                    <div class="new-list-divs" id="input-list-name">
                        <input type="text" name="new-list-name" id="new-list-name">
                    </div>
                    <div class="prompt-buttons" id="create-list-buttons">
                        <button type="button" class="cancel-buttons" id="cancel-new-list">Cancel</button>
                        <div class="new-list-divs" id="submit-list-name">
                            <input type="submit" value="Create new list" name="new-list-button" class="create-buttons" id="new-list-button">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="overlay-current-mood">
            <div id="whats-current-mood">
                <div class="current-prompt-text"></div>
                <h1 id="current-heading">What's your current mood?</h1>
                <h3 id="current-subheading">Track you mood daily and see how you progress over time!</h3>
                <input type="hidden" name="current-mood-set" id="current-mood-set" value="">
                <div class="whats-mood-images" id="current-mood-images">
                    <button type="button" class="current-images" id="current-button-0" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/anxious.svg" alt="anxious"><p>anxious</p></button>
                    <button type="button" class="current-images" id="current-button-1" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/bothered.svg" alt="bothered"></button>
                    <button type="button" class="current-images" id="current-button-2" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/calm.svg" alt="calm"></button>
                    <button type="button" class="current-images" id="current-button-3" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/confident.svg" alt="confident"></button>
                    <button type="button" class="current-images" id="current-button-4" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/confused.svg" alt="confused"></button>
                    <button type="button" class="current-images" id="current-button-5" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/excited.svg" alt="excited"></button>
                    <button type="button" class="current-images" id="current-button-6" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/gloomy.svg" alt="gloomy"></button>
                    <button type="button" class="current-images" id="current-button-7" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/glum.svg" alt="glum"></button>
                    <button type="button" class="current-images" id="current-button-8" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/hopeful.svg" alt="hopeful"></button>
                    <button type="button" class="current-images" id="current-button-9" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/nervous.svg" alt="nervous"></button>                            
                    <button type="button" class="current-images" id="current-button-10" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/neutral.svg" alt="neutral"></button>                            
                    <button type="button" class="current-images" id="current-button-11" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/not_bothered.svg" alt="not-bothered"></button>                            
                    <button type="button" class="current-images" id="current-button-12" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/optimistic.svg" alt="optimistic"></button>                            
                    <button type="button" class="current-images" id="current-button-13" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/restless.svg" alt="restless"></button>                            
                    <button type="button" class="current-images" id="current-button-14" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/tense.svg" alt="tense"></button>                            
                    <button type="button" class="current-images" id="current-button-15" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/tired.svg" alt="tired"></button>                            
                    <button type="button" class="current-images" id="current-button-16" onclick="clickedCurrentMood(this.id)"><img src="../icons/mood_svgs/worried.svg" alt="worried"></button>                            
                </div>

                <div class="prompt-buttons" id="current-mood-buttons">
                    <button id="cancel-current-mood" class="cancel-buttons" type="button">Cancel</button>
                    <button type="button" id="continue-button" class="create-buttons">Continue</button>
                </div>
            </div>
            <div id="suggest-prompt">
                <h1>Suggestions for today...</h1>
                <p id="suggest-subheader">Here are suggested tasks you can add to your today list based on your current mood...</p>
                <div id="suggest-tasks-block">
                    <div id="" class="suggested-tasks">
                        <h3>Have some fresh air...</h3>
                        <p>Take a walk, have a breather. Make sure to make some time away from whatever tasks youre doing...</p>
                        <!-- <form action="../php/phpTaskList.php" method="post">
                            <input type="hidden" name="name" value="Have a breather">
                            <input type="hidden" name="description" value="Make sure to make some time away from whatever tasks youre doing...">
                            <input type="hidden" name="time-estimate" value=60 class="suggest-task-date">
                        </form> -->
                    </div>
                    <div id="" class="suggested-tasks">
                        <h3>Take a break...</h3>
                        <p>We all need a well deserved break!</p>
                    </div>
                    <div id="" class="suggested-tasks">
                        <h3>Eat and drink</h3>
                        <p>Have a snack, make something to eat or drink!</p>
                    </div>
                </div>
                <button id="cancel-suggestion" class="cancel-buttons" type="button">No, thank you...</button>

            </div>
        </div>

    </div>

</body>
<script src="../scripts/scriptTaskList.js"></script>
<script>
    var overlay = document.querySelector(".overlay");
    var button = document.querySelector("#new-task");
    var submitButton = document.querySelector("#submit-button");

    button.addEventListener("click", () => {
        overlay.style.display = "flex";
    })

    submitButton.addEventListener("click", () => {
        overlay.style.display = "none";
    })

    // AJAX search user to share task with
    $(document).ready(function() {
        $("#username").keyup(function() {
            // Get values from username input
            var username = $("#username").val();
            // post function
            $.post("../php/shareTask.php", {
                // Passing username variable to php file shareTask
                user: username
            }, function(data, status) {
                // Get result from post function and insert into find-user-block div
                $("#find-user-main").html(data);
            });
        });
    })

    // AJAX search tag to add tag to task
    $(document).ready(function() {
        $("#new-tag").keyup(function() {
            // Get values from username input
            var tagName = $("#new-tag").val();
            // post function
            $.post("../php/findTag.php", {
                // Passing tagName variable to php file findTag
                tag: tagName
            }, function(data, status) {
                // Get result from post function and insert into find-user-block div
                $("#show-tags").html(data);
            });
        });
    })



</script>
</html>

<?php

closeConnection($conn);
exit();

?>