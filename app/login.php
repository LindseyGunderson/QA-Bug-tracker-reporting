<?php

    // 1. Include functions.php
    require_once('../functions.php');

    // 2. Connect to the database
    require_once('connect.php');

    //define variables to store $_POST data
    $loginEmail = $_POST['loginEmail'];
    $loginPassword = $_POST['loginPassword'];


    var_dump($_POST);


    // 3. Redirect to the homepage if there is no post data
    if(!isset($_POST['loginSubmit'])){

        header('Location: ' . SITE_URL);
        die();

    }

    // 4. Redirect to the home page if email or password are empty
    if(empty($loginEmail) || empty($loginPassword)){

        header('Location: ' . SITE_URL . '?msg=loginErrorEmpty');
        die();

    }

    // 5. Verify user email & password
    // check if the email and password match
   
    $sql = 'SELECT * FROM users 
            WHERE user_email = ?';

    // Prepare the query
    $stmt = $mysqli->prepare($sql);

    // Bind the placeholders with input form data
    $stmt->bind_param('s', $loginEmail);
    
    // Execute the query
    $stmt->execute();
    
    // Store the results
    $result = $stmt->get_result();
    
    // 7. Redirect to the home page if the password is incorrect or no rows were returned
    if($result->num_rows == 0){

        header('Location: ' . SITE_URL . '?msg=loginErrorMismatch');
        die();

    }

    $record = $result->fetch_assoc();

    // 8. Check the hashed password against the email to see if they return turn. If true, create a session for the user.
    if(password_verify($loginPassword, $record['user_password'])){
    
        if(session_status() == 1){

            session_start();

        }

        

        $_SESSION['user_id'] = $record['user_id'];

      

        // Redirect the homepage
        header('Location: ' . SITE_URL . '?msg=loginSuccess');
        die();

    } else {

        header('Location: ' . SITE_URL . '?msg=loginErrorMismatch');
        die();
    }