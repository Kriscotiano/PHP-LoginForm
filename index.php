<?php 
    //Allow the config
    define('__CONFIG__', true);
    //Require the config
    require_once "parts/config.php"; 
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="robots" content="follow" />

        <title>Registration & Login Form</title>

        <link rel="stylesheet" type="text/css" href="resources/css/style.css" />
    </head>

    <body>
        <div class="container">
            <div class="landing">
                <h1>Welcome. Today is:</h1>
                <br><br>
                <?php
                    echo date('y m d');
                ?>
                <br><br>
                <p>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                </p>
            </div>       
        </div>

        <?php require_once "parts/footer.php" ?>
    </body>
</html>
