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


    ?>