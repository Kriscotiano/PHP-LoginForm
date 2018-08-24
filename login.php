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

            <form class="js-login">
                <div class="form-container">
                    <div class="form-section header">
                        <h2>Sign In</h2>
                    </div>

                    <div class="form-section">
                        <label class="form-label" for="email">Email</label>
                        <div class="input-box">
                            <input class="input" id="email" type="email" required="required" placeholder="johndoe@email.com">
                        </div>
                    </div>

                    <div class="form-section">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-box">
                            <input class="input" id="password" type="password" required="required" placeholder="enter password...">
                        </div>
                    </div>

                    <div class="form-section">
                        <button class="login-btn" type="submit">Login</button>
                    </div>
                </div>
            </form>

        </div>

        <?php require_once "parts/footer.php" ?>
    </body>
</html>