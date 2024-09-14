<?php

    session_start();

    // CONNECT TO DATABASE
    include "database.php";
    $conn = openConnection();

    $getTag = "SELECT * FROM Tag;";
    $queryGetTag = $conn->query($getTag);
    $tagList = array();

    if ($queryGetTag == TRUE) {
        while ($tagRow = mysqli_fetch_assoc($queryGetTag)) {
            $tag = $tagRow["name"];
            // APPEND TO ARRAY FOR TAGS
            array_push($tagList, $tag);
        }
    }

    // Check if username input has a value
    if (isset($_POST["tag"])) {
        $count = 0;
        $tagName = $_POST["tag"];
        $existingTags = array();

        // $tagInput = "added-tag-";
        // $countExTags = 0;
        // $count = 0;
        // while ($countExTags>=0) {
        //     $tempName = $tagInput . strval($countExTags);
        //     if (isset($_POST[$tempName])) {
        //         array_push($existingTags, $_POST[$tempName]);
        //         $countExTags+=1;
        //     } else {
        //         break;
        //     }
        // }

        foreach ($tagList as $atag) {

            $lowercaseTag = strtolower($atag);
            if (strpos($atag, $tagName) !== false || strpos($lowercaseTag, strtolower($tagName)) !== false) {
                // for ($i = 0; $i < sizeof($existingTags); $i++) {
                //     if ($existingTags[$i] === $atag) {
                //         $count+=1;
                //         continue;
                //     } else {
                        // Display tags when the user types values
                        echo '<p class="show-tag-text" id="show-tag-text-'.$count.'" onclick="selectTag(this.id)">'.$atag.'</p>';
                        $count+=1;
                        
                    // }
                // }
            }
        }

    }




    closeConnection($conn);
    exit();


?>