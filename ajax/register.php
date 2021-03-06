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
            $return['error'] = 'This account already exists';
            $return['is_logged_in'] = false;
        } else if ($_POST['password'] !== $_POST['confirm']) {
            $return['error'] = 'Passwords do not match';
            $return['is_logged_in'] = false;
        } else {
            //User does not exist. Add them
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $addUser = $con->prepare("INSERT INTO users(email, password) VALUES(LOWER(:email), :password)");
            $addUser->bindParam(':email', $email, PDO::PARAM_STR);
            $addUser->bindParam(':password', $password, PDO::PARAM_STR);
            $addUser->execute();

            $user_id = $con->lastInsertId();

            $_SESSION['user_id'] = (int) $user_id;

            $return['redirect'] = 'dashboard.php?message=welcome';
            $return['is_logged_in'] = true;
        }
      
        echo json_encode($return, JSON_PRETTY_PRINT);
    } else {
        exit('Invalid URL');
    }
?>