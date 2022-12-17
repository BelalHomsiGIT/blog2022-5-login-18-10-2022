<?php
    session_start();
    session_unset();
    session_destroy();
    header('refresh:1; url=home.php');

    //page name,uri,....
    echo $_SERVER['PHP_SELF']  . "<BR>";
    $uri = $_SERVER['REQUEST_URI'];
    echo $uri . "<BR>"; // Outputs: URI
    
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    
    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo $url . "<BR>"; // Outputs: Full URL
    
    $query = $_SERVER['QUERY_STRING'];
    echo $query . "HHHHH" . "<BR>"; // Outputs: Query String
?>