<?php

session_start(); // Start the session.

    //file paths
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("PUBLIC_PATH", PROJECT_PATH, '/public');
    define("SHARED_PATH", PRIVATE_PATH, '/shared');
    define("WWW_ROOT", "");

    // If no session value is present, redirect the user:
    // Also validate the HTTP_USER_AGENT!
    if (!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($_SERVER['HTTP_USER_AGENT']) )) {

    	// Need the functions:
    	require ('shared/login_functions.inc.php');

      // Redirect the user:
      header("Location: http://groupfour.uwmsois.com/cdcc-scheduler/public/index.php");
      exit(); // Quit the script.

    }

    //echo 'session ' . $_SESSION['admin'] . ' dir ' . basename(dirname((__FILE__)));

    require_once('functions.php');

    include('shared/mysqli_connect.php');

?>
