<?php 
    //Allow the config
    define('__CONFIG__', true);
    //Require the config
    require_once "parts/config.php"; 

    forceDashboard();
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">

            <form class="js-register">
                <div class="form-container">
                    <section class="form-section header">
                        <h2>Register</h2>
                    </section>

                    <section class="form-section">
                        <label class="form-label" for="email">Email</label>
                        <div class="input-box">
                            <input class="input" id="email" type="email" required="required" placeholder="johndoe@email.com">
                        </div>
                    </section>
                    <div class="email-validation"></div>

                    <section class="form-section">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-box">
                            <input class="input" id="password" type="password" required="required" placeholder="●●●●●●●●●">
                        </div>
                    </section>
                    <div class="password-validation"></div>

                    <section class="form-section">
                        <label class="form-label" for="password">Confirm Password</label>
                        <div class="input-box">
                            <input class="input" id="confirm" type="password" required="required" placeholder="●●●●●●●●●">
                        </div>
                    </section>
                    <div class="confirm-validation"></div>
                
                    <section class="form-section">
                        <button class="register-btn" type="submit">Register</button>
                    </section>

                    <section class="form-section">
                        <div class="href-box">
                            <a href="login.php">Already have an account?</a>
                        </div>
                    </section>
                </div>
            </form>

        </div>

        <?php require_once "parts/footer.php" ?>
    </body>
</html>