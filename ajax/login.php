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
        $password = $_POST['password'];

        //Make sure user does not exist
        $findUser = $con->prepare("SELECT user_id, password FROM users WHERE email = LOWER(:email) LIMIT 1");
        $findUser->bindParam(':email', $email, PDO::PARAM_STR);
        $findUser->execute();

        if ($findUser->rowCount() == 1) {
            //User exists
            $user = $findUser->fetch(PDO::FETCH_ASSOC); //Creates an array

            $user_id['user_id'] = (int) $user['user_id'];
            $hash = (string) $user['password'];

            if (password_verify($password, $hash)) {
                //User is signed in
                $return['redirect'] = 'dashboard.php';

                $_SESSION['user_id'] = $user_id;
            } else {
                //Invalid user email/password
                $return['error'] = 'Invalid user email/password';
            }
            
            $return['error'] = 'This account already exists';
        } else {
            //User does not exist. 
            $return['error'] = "This account does not exist. <a href='register.php'>Create one now?</a>";
        }

        echo json_encode($return, JSON_PRETTY_PRINT);
    } else {
        exit('Invalid URL');
    }
?>