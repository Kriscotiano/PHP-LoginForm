<?php
    //Allow the config
    define('__CONFIG__', true);
    //Require the config
    require_once "../parts/config.php"; 
    
    //Make sure page is accessed through specified AJAX method only
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Always return JSON format
        // header('Content-Type: application/json');

        $return = [];

        $email = Filter::String( $_POST['email'] );

        //Make sure user does not exist
        $findUser = $con->prepare("SELECT user_id FROM users WHERE email = LOWER(:email) LIMIT 1");
        $findUser->bindParam(':email', $email, PDO::PARAM_STR);
        $findUser->execute();

        if ($findUser->rowCount() == 1) {
            //User exists
            $return['valid'] = false;
        } else {
            //User does not exist
            $return['valid'] = true;
        }

        echo json_encode($return);
    } else {
        exit('Invalid URL');
    }

?>