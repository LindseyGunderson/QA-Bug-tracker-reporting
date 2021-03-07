<?php 

    // 1. Include functions.php file
    require_once('../functions.php');
    
    // 2. check session status and start session
    if(session_status() == 1){

        session_start();
    }

    // 3. If the $_GET request is 'logout' get the session ID  and destory it
    if(isset($_GET['logout'])){

        session_destroy();
    }

    // Redirect the page to the homepage and logout the user
    header('Location: ' . SITE_URL);
    

    ?>