<?php
    session_start();
    session_destroy();
    $user = "";
    $pass = "";
    $msg = "";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include './db_connect.php';
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $user = htmlspecialchars($user);
        $pass = htmlspecialchars($pass);
        $SQL = "SELECT * FROM users";
        $result = mysqli_query($db_handle, $SQL);
        while($db_field = mysqli_fetch_assoc($result)){
            $u = $db_field['username'];
            $p = $db_field['password'];
            if( ($user == $u) AND ($pass == $p) ){
                session_start();
                $_SESSION['username'] = $user;
                mysqli_close($db_handle);
                header("Location: ./dashboard.php");
                break;
            }
        }
        $msg = "invalid username or password";
        mysqli_close($db_handle);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="./css/login_signup.css">
        <link rel="stylesheet" href="./css/preLoader.css">
        <script src="./js/preLoader.js"></script>
        <script src="./js/login_signup.js"></script>
    </head>
    <body onload="loading();">
        <!-- Preloader Start -->
        <div id="preLoader"></div>
        <!-- Preloader End -->
        <!-- Login Form -->
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <div id="formHeader" class="fadeIn">
                    <p>Login</p>
                </div>
                <form method="POST" action="./login.php">
                    <div class="msg"><?php echo $msg ?></div>
                    <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required>
                    <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required>
                    <input type="submit" class="fadeIn fourth" value="Log In">
                </form>
                <div id="formFooter" class="fadeIn fifth">
                    <a class="underlineHover" href="./signup.php">Create a new account</a>
                </div>
            </div>
        </div>
    </body>
</html>