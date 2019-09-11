<?php
    session_start();
    $user = $_SESSION['username'] or header("Location: ./login.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <link rel="stylesheet" href="./css/preLoader.css">
        <script src="./js/preLoader.js"></script>
    </head>
    <body onload="loading();">
        <!-- Preloader Start -->
        <div id="preLoader"></div>
        <!-- Preloader End -->
        <div>Login Successful</div>
        <div>
            <?php
                echo "username : ", $user;
            ?>
        </div>
        <a href="./my_account.php">My Account</a>
        <a href="./login.php"><button type="button">Log Out</button></a>
    </body>
</html>