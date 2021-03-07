<?php

    // Add user-defined functions
    require_once('../functions.php');

    //include connection to DB from separate file
    require_once('connect.php');

    var_dump($_GET);

    if(isset($_GET['status']) == 'reopen'){

          //Prepare SQL query for update, update the status where it is equal to the note_id
        $sql = 'UPDATE bug_reports SET bug_status = 0 WHERE bug_id = ?';

    $stmt->execute();
        $stmt = $mysqli->prepare($sql);

        //Bind parameters to be updated into database
        $stmt->bind_param('i', $_GET['id']);

        //Execute the query and update entry in database
        $stmt->execute();

        //redirect to main page with constant defined in connect.php
        header('Location: ' . SITE_URL);

        

    } 
    else {

        //Prepare SQL query for update, update the status where it is equal to the note_id
        $sql = 'UPDATE bug_reports SET bug_status = 1 WHERE bug_id = ?';

        $stmt = $mysqli->prepare($sql);

        //Bind parameters to be updated into database
        $stmt->bind_param('i', $_GET['id']);

        //Execute the query and update entry in database
        $stmt->execute();

        //redirect to main page with constant defined in connect.php
        header('Location: ' . SITE_URL);

        }

?>