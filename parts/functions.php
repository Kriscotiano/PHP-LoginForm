<?php

    //Force user to be logged in or redirect
    function forceLogin() {
        if (isset($_SESSION['user_id'])) {
            //User is allowed here
        } else {
            //User is not allowed here
            header('Location: login.php'); exit;
        }
    }

    function forceDashboard() {
        if (isset($_SESSION['user_id'])) {
            //User is allowed here but redirected
            header('Location: dashboard.php'); exit;
        } else {
            //User is not allowed here
        }
    }
    
?>