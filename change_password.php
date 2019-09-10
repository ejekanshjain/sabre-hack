<?php
    session_start();
    $user = $_SESSION['username'];
    $pass = "";
    $msg="";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include './db_connect.php';
        $current_pass = $_POST['password'];
        $new_pass = $_POST['newpassword'];
        $confirm_pass = $_POST['confirmpassword'];
        $current_pass = htmlspecialchars($current_pass);
        $new_pass = htmlspecialchars($new_pass);
        $confirm_pass = htmlspecialchars($confirm_pass);
        $SQL = "SELECT * FROM users WHERE username='$user'";
        $result = mysqli_query($db_handle, $SQL);
        $db_field = mysqli_fetch_assoc($result);
        $pass = $db_field['password'];
        if($pass != $current_pass){
            $msg="Wrong Password";
        }
        else if($new_pass != $confirm_pass){
            $msg="Passwords do not match";
        }
        else{
            $SQL = "UPDATE users SET `password`='$new_pass' WHERE username='$user'";
            $result = mysqli_query($db_handle, $SQL);
            mysqli_close($db_handle);
            $_SESSION['username'] = $user;
            header("Location: ./change_password_successful.php");
        }
        mysqli_close($db_handle);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>
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
        <!-- Change Password Form -->
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <div id="formHeader" class="fadeIn">
                    <p>Change Password</p>
                </div>
                <form method="POST" action="./change_password.php">
                    <div class="msg"><?php echo $msg;?></div>
                    <input type="password" id="password" class="fadeIn second" name="password" placeholder="Current Password" required>
                    <input type="password" id="newpassword" class="fadeIn third" name="newpassword" placeholder="New Password" onblur="checkPassword();" required>
                    <input type="password" id="confirmpassword" class="fadeIn fourth" name="confirmpassword" placeholder="Confirm Password" onblur="confirmChangePass();" required>
                    <input type="submit" id="changepassbtn" class="fadeIn fifth" value="Change Password">
                </form>
                <div id="formFooter" class="fadeIn sixth">
                    <a class="underlineHover" href="./my_account.php">Cancel</a>
                </div>
            </div>
        </div>
    </body>
</html>