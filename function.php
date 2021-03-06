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



    ?>