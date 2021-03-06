<?php

    //declare properties for db connection
    $user = 'root';
    $password = 'root';
    $db = 'qa_tracking';
    $host = 'localhost';
    $port = 3306;

    // 1. Connect to the Database
        $mysqli = new mysqli($host, $user, $password, $db, $port);

    // 2. Validate Connection to Database
        if($mysqli->connect_errno){

            echo "Problem connecting to database: " . $mysqli->connect_errno;
            die();
        }

?>