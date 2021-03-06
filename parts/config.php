<?php

    // If there is no constant defined called __CONFIG__, do not load this file
    if (!defined('__CONFIG__')) {
        exit('You do not have a config file');
    }

    // Set Sessions to always turned on 
    if (!isset($_SESSION)) {
        session_start();
    }

    // Config is below
    // Allow errors
    error_reporting(-1);
    ini_set('display_errors', 'On');

    // Include the DB.php file.
    include_once "classes/DB.php";
    include_once "classes/Filter.php";
    include_once "functions.php";

    $con = DB::getConnection();
    
?>