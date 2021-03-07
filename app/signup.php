<?php

    //1. Include the functions.php file
    require_once('../functions.php');

    //2. Connect to the databse
    require_once('connect.php');

    //3. Check if form was submitted, if not redirect back to the homepage
    if(!isset($_POST['signupSubmit'])) {

        header('Location: ' . SITE_URL);
        die();

    }

    //4. assign the data sent via POST to variables
    $userEmail = $_POST['signupEmail'];
    $userPassword = $_POST['signupPassword'];
    $userPasswordConfirm = $_POST['signupPasswordConfirm'];

    //5. redirect to homepage if any input fields are empty
    if(empty($userEmail) || empty($userPassword) || empty($userPasswordConfirm)) {
    
        header('Location: ' . SITE_URL . '?msg=errorSignUpEmptyFields');
        die();
    }

    // 6.  Redirect to the home page if invalid password
    if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)){

        header('Location: ' . SITE_URL . '?msg=errorSignUpInvalidEmail');
        die();

    }


    //7. check if both password and confirmPassword match
    if($userPassword != $userPasswordConfirm){

        header('Location: ' . SITE_URL . '?msg=errorSignupPasswordMismatch');
        die();

    }

    // 8. prepare the query and check the users email for a match
    $sql = 'SELECT * FROM users WHERE user_email = ?';

    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param('s', $userEmail);

    $stmt->execute();

    $result = $stmt->get_result();


    // 9. check if the email already exists as a user in the users table
    if($result->num_rows){

        header('Location: ' . SITE_URL . '?msg=errorSignupUserExists');
        die();
    }


    //10. If everything is good to go, insert the new user into the database
    $sql = 'INSERT INTO users(user_email, user_password) VALUES (?, ?)';

    $stmt = $mysqli->prepare($sql);

    $stmt->bind_param('ss', $userEmail, password_hash($userPassword, PASSWORD_DEFAULT));

    $stmt->execute();
     
    header('Location: ' . SITE_URL . '?msg=signupSuccess');




?>