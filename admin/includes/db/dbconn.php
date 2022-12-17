<?php
// for admin
    //define variables for connection
    $dsn = 'mysql:host=localhost; dbname=blog'; // host + DB name
    $user = 'root';
    $pwd = '';
    $option = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    //create the connect 
    try{
        $connect = new PDO($dsn, $user, $pwd, $option);
        // set the PDO error mode to exception
        $connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo 'failed to connect' . $e -> getMessage();
    }
?>