<?php 
    //Allow the config
    define('__CONFIG__', true);
    //Require the config
    require_once "parts/config.php"; 

    forceLogin();

    $user_id = $_SESSION['user_id'];

    $getUserInfo = $con->prepare('SELECT email, reg_time FROM users WHERE user_id = :user_id LIMIT 1');
    $getUserInfo->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $getUserInfo->execute();

    if ($getUserInfo->rowCount() === 1) {
        //User was found
        $user = $getUserInfo->fetch(PDO::FETCH_ASSOC);
    } else {
        //User is not signed in
        header('Location: logout.php'); exit;
    }
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
            <section class="form-section">
                <h2 style="color: #fff;">Dashboard</h2>
                <p style="color: #fff;">Hello <?php echo $user['email']; ?>, you registered at <?php echo $user['reg_time']; ?></p>
                <p><a style="color: #fff;" href="logout.php">Logout</a></p>
            </section>
        </div>

        <?php require_once "parts/footer.php" ?>
    </body>
</html>