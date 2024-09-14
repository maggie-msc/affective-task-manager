<?php

    session_start();

    // CONNECT TO DATABASE
    include "database.php";

    $conn = openConnection();

    // GET TASK FORM DATA
    $taskName = $_POST["name"];
    $description = $_POST["description"];
    $dueDate = $_POST["due-date"];
    $startDate = $_POST["start-date"];
    $priorityValue = $_POST["priority-value"];
    $mood = $_POST["mood-tag-value"];
    $shareUserValue = $_POST["shareuser-value"];
    $timeValue = $_POST["time-estimate"];

    
    // FIND USERNAME ID
    $username = $_SESSION["username"];
    $username_id = $_SESSION["user_id"];


    // FIND SHARED USER ID
    $sharedUserId = NULL;
    $findSharedUserId = "SELECT * FROM User WHERE username = '$shareUserValue'";
    $sqlFindSharedQuery = $conn->query($findSharedUserId);
    $checkShareUserArray = $sqlFindSharedQuery->fetch_assoc();

    if ($sqlFindSharedQuery->num_rows === 1) {
        $sharedUserId = $checkShareUserArray["user_id"];
    } else {
        $sharedUserId = NULL;
    };

    // CONVERT DATE INPUT FOR DATABASE
    $newDueDate = date("Y-m-d",strtotime($dueDate));
    $newStartDate = date("Y-m-d",strtotime($startDate));

    // INSERT NEW TASK INTO TASK TABLE IN DB
    $insertNewTask = "INSERT INTO Task (name, description, due_date, start_date,
    priority, mood, user_id, shared_user, time_estimate) VALUES ('$taskName', NULLIF('$description',''),
    '$newDueDate', '$newStartDate', '$priorityValue', '$mood', '$username_id', NULLIF('$sharedUserId', ''), NULLIF('$timeValue', ''))";

    
    if ($startDate == null && $dueDate == null) {
        // INSERT NEW TASK INTO TASK TABLE IN DB
        global $insertNewTask;
        $nullValue = null;
        $insertNewTask = "INSERT INTO Task (name, description,
        priority, mood, user_id, shared_user, time_estimate) VALUES ('$taskName', NULLIF('$description',''), 
        '$priorityValue', '$mood', '$username_id', NULLIF('$sharedUserId', ''), NULLIF('$timeValue', ''))";
    } elseif ($newDueDate === "1970-01-01") {
        // INSERT NEW TASK INTO TASK TABLE IN DB
        global $insertNewTask;
        $insertNewTask = "INSERT INTO Task (name, description, due_date, start_date,
        priority, mood, user_id, shared_user, time_estimate) VALUES ('$taskName', NULLIF('$description',''),
        NULL, '$newStartDate', '$priorityValue', '$mood', '$username_id', NULLIF('$sharedUserId', ''), NULLIF('$timeValue', ''))";
    } elseif ($newStartDate === "1970-01-01") {
        // INSERT NEW TASK INTO TASK TABLE IN DB
        global $insertNewTask;
        $insertNewTask = "INSERT INTO Task (name, description, due_date, start_date,
        priority, mood, user_id, shared_user, time_estimate) VALUES ('$taskName', NULLIF('$description',''),
        '$newDueDate', NULL, '$priorityValue', '$mood', '$username_id', NULLIF('$sharedUserId', ''), NULLIF('$timeValue', ''))";
    } 

    $sqlParentTask = $conn->query($insertNewTask);

    // GETTING ALL SUBTASK IDS, VALUES AND INSERTING INTO SUBTASKS TABLES
    $subtaskInputName = "sub-task-input-";
    $countIds = 0;
    // GET PARENT TASK
    $parentId = NULL;
    $findParentTask = "SELECT task_id FROM Task WHERE name = '$taskName';";
    $queryFindParentTask = $conn->query($findParentTask);
    $checkFindParentArray = $queryFindParentTask->fetch_assoc();
    if ($queryFindParentTask->num_rows === 1) {
        $parentId = $checkFindParentArray["task_id"];
    }

    while ($countIds >= 0) {

        // CHECK FOR INPUT NAME WITH UNIQUE NUMBER AT THE END
        $temp = $subtaskInputName . strval($countIds);

        // CHECK IF THE INPUT ABOVE IS SET
        if (isset($_POST[$temp])) {

            // INSERT SUBTASK AND PARENT TASK INTO SUBTASK TABLE
            $subtask = $_POST[$temp];
            $insertSubtask = "INSERT INTO Subtask (name, parent_task) VALUES ('$subtask', '$parentId');";
            $sqlSubtask = $conn->query($insertSubtask);
            $countIds+=1;

        } else {
            // IF THERE IS NO INPUT WITH NAME STORED IN THE TEMP VARIABLE, BREAK WHILE LOOP
            break;

        }
    }

    // Add tags to database
    $tagName = "added-tag-";
    $countTags = 0;
    $listOfTags = array();

    while ($countTags>= 0) {
        $tempTag = $tagName . strval($countTags);
        
        // CHECK IF TAG ABOVE IS SET
        if (isset($_POST[$tempTag])) {
            $createdTag = $_POST[$tempTag];
            
            // CHECK TAG ALREADY EXISTS
            $checkTag = "SELECT * FROM Tag WHERE name = '$createdTag';";
            $sqlCheckTag = $conn->query($checkTag);
            $checkTagArray = $sqlCheckTag->fetch_assoc();
            if ($sqlCheckTag->num_rows === 1) {
                echo "Tag already exists";
                break;
            } else {
                // INSERT INTO TABLE Tag
                array_push($listOfTags, $createdTag);
                $insertTag = "INSERT INTO Tag (name) VALUES ('$createdTag');";
                $sqlInsertTag = $conn->query($insertTag);
                $countTags+=1;
            }
        } else {
            // IF THERE IS NO INPUT WITH NAME STORED IN THE TEMP VARIABLE, BREAK WHILE LOOP
            break;

        }
    }

    for ($i = 0; $i < sizeof($listOfTags); $i++) {
        $name = $listOfTags[$i];
        $taskId = NULL;
        $tagRelation = "SELECT tag_id FROM Tag WHERE name = '$name';";
        $sqlTagRelation = $conn->query($tagRelation);
        $checkTagRelationArray = $sqlTagRelation->fetch_assoc();

        $findTask = "SELECT task_id FROM Task WHERE name = '$taskName' 
        ORDER BY task_id DESC LIMIT 1;";
        $sqlFindTask = $conn->query($findTask);
        $checkFindTaskArray = $sqlFindTask->fetch_assoc();
        $taskId = $checkFindTaskArray["task_id"];

        if ($sqlTagRelation->num_rows === 1) {
            $tagId = $checkTagRelationArray["tag_id"];
            $insertTagRelation = "INSERT INTO TaskTag (task_id, tag_id) 
            VALUES ('$taskId', '$tagId');";
            $sqlInsertTagRel = $conn->query($insertTagRelation);
        }
    }

    if ($sqlParentTask === TRUE || $sqlSubtask === TRUE) {
        echo "Successful task data input";
        header("Location: ../pages/taskList.php");
        exit();
    } else {
        echo "Error" . $insertNewTask . $conn->error;
        echo "Error" . $insertSubtask . $conn->error;
        exit();
    }

    closeConnection($conn);
    exit();

?>