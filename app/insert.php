<?php

    // Add user-defined functions
    require_once('../functions.php');

    //include connection to DB from separate file
    require_once('connect.php');


   if(isset($_POST['newBug'])){

        // var_dump($_POST);

        //define variables for $_POST
        $bug_severity = $_POST['bugSeverity'];
        $bug_title = $_POST['bugTitle'];
        $bug_desc = $_POST['bugDescription'];
        $bug_date = $_POST['bugDate'];
        $bug_status = $_POST['status'];


        //Prepare SQL query for insert
        $sql = 'INSERT INTO bug_reports(bug_severity, bug_title, bug_note, bug_created_date, bug_status) VALUES (?, ?, ?, ?, ?)';

        $stmt = $mysqli->prepare($sql);

        //Bind parameters to be inserted into database
        $stmt->bind_param('isssi', $bug_severity, $bug_title, $bug_desc, $bug_date, $bug_status);

        //Execute the query and inserted into database
        $stmt->execute();

        
        ///redirect to main page with constant defined in connect.php
        header('Location: ' . SITE_URL);

    }


        if (isset($_POST['commentMsg']) && !empty($_POST['commentMsg'])) {
        
            var_dump($_POST);

            //define variables for $_POST
            $comment_bug_id = $_POST['id'];
            $comment_msg = $_POST['commentMsg'];
            $comment_date = $_POST['currentDate'];


            // //Prepare SQL query for insert
            $sql = 'INSERT INTO bug_comments(comment_bug_id, comment_msg, comment_date_created) VALUES (?, ?, ?)';

            $stmt = $mysqli->prepare($sql);

            //Bind parameters to be inserted into database
            $stmt->bind_param('iss', $comment_bug_id, $comment_msg, $comment_date);

            //Execute the query and inserted into database
            $stmt->execute();

            header('Location: ' . SITE_URL .'view.php?id=' . $_POST['id']);

        }


?>