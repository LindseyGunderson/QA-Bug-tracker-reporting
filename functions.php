<?php

    // Remove special characters for preventing sql injections
    function h($data) {
        return htmlspecialchars($data);
    }


    // define and create a constant URL for redirects
    
    function siteURL() {
        $protocol = 'http://';
        $domainName = $_SERVER['HTTP_HOST'] . '/QA-Bug-tracker-reporting/';
        return $protocol . $domainName;      
    }

    define( 'SITE_URL', siteURL() );


    // custom function that show the severity associated with the number result from the database
    function lg_severityResult($severity){

        switch($severity){

            case 1:
                $severity = "Low Severity";
                break;

            case 2:
                $severity = "Moderate Severity";
                break;

            case 3: $severity = "High Severity";
                break;

            default;
        }

        return $severity;

    }

    // Add a badge and colour to the Severity of the bug
    function lg_severityBG($severityBG){

        switch($severityBG){

            case 1:
                $severityBG = "badge-success text-light";
                break;
    
            case 2:
                $severityBG = "badge-warning text-dark";
                break;
    
            case 3: $severityBG = "badge-danger text-light";
                break;
    
            default;
        }

        return $severityBG;

    }

 // custom fuction for displaying error or success messages
 function lg_msgs($message){

    switch ($message) {
        case "loginErrorEmpty":
            echo 'Error: Please enter both your username and password to log in.';
            break;

        case "loginErrorMismatch":
            echo 'Error: Incorrect username or password, please try again.';
            break;

        case "loginSuccess":
            echo 'Login Success: Welcome!';
            break;

        case "errorSignUpEmptyFields":
            echo 'Error: Please fill in all fields to sign up';
            break;

        case "errorSignUpInvalidEmail":
            echo 'Error: Please add a valid email';
            break;

        case "errorSignupPasswordMismatch":
            echo 'Error: Passwords must match';
            break;

        case "errorSignupUserExists":
            echo 'Error: User already exists';
            break;

        case "signupSuccess":
            echo 'Account created: Please login';
            break;
            
        case "0":
        case "1":
            echo 'Error: Please sign up or login.';
            break;

    default:
        
    }

}


    ?>