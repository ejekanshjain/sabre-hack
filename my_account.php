<?php
    session_start();
    $user = $_SESSION['username'];
    $msg="";
    include './db_connect.php';
    $SQL = "SELECT * FROM users WHERE username='$user'";
    $result = mysqli_query($db_handle, $SQL);
    $db_field = mysqli_fetch_assoc($result);
    $firstname = $db_field['firstname'];
    $lastname = $db_field['lastname'];
    $email = $db_field['email'];
    $contactnumber = $db_field['contactnumber'];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        extract($_POST);
        if($newusername=="" OR $newfirstname=="" OR $newlastname=="" OR $newemail==""){
            $msg="Please fill complete details";
        }
        else{
            $SQL = "SELECT * FROM users WHERE username='$newusername'";
            $result = mysqli_query($db_handle, $SQL);
            if(mysqli_num_rows($result)>0){
                $msg="Username already exists";
            }
            else{
                $SQL = "SELECT * FROM users WHERE email='$newemail'";
                $result = mysqli_query($db_handle, $SQL);
                if(mysqli_num_rows($result)>0){
                    $msg="Email already linked to another account";
                }
                else{
                    $SQL = "SELECT * FROM users WHERE contactnumber='$newcontactnumber'";
                    $result = mysqli_query($db_handle, $SQL);
                    if(mysqli_num_rows($result)>0){
                        $msg="Contact Number already linked to another account";
                    }
                    else{
                        $SQL = "UPDATE users SET `username`='$newusername', `firstname`='$newfirstname', `lastname`='$newlastname', `email`='$newemail', `contactnumber`='$newcontactnumber' WHERE `username`='$user'";
                        $result = mysqli_query($db_handle, $SQL);
                        mysqli_close($db_handle);
                        $user = $newusername;
                        $_SESSION['username'] = $user;
                        header("Location: my_account_change_details.php");
                    }
                }
            }
        }
    }
    mysqli_close($db_handle);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Account - <?php echo $user ?></title>
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
        <div><?php echo $msg ?></div>
        <form method="POST" action="./my_account.php">
            <input type="text" id="username" name="newusername" value="<?php echo $user ?>" required>
            <input type="text" id="firstname" name="newfirstname" value="<?php echo $firstname ?>" required>
            <input type="text" id="lastname" name="newlastname" value="<?php echo $lastname ?>" required>
            <input type="email" id="email" name="newemail" value="<?php echo $email ?>" required>
            <input type="number" id="contactnumber" name="newcontactnumber" value="<?php echo $contactnumber ?>" required>
            <a href="./dashboard.php">Cancel</a>
            <input type="reset" id="reset">
            <input type="submit" id="submit" value="Change Details">
        </form>
        <a href="./login.php">Log Out</a>
        <a href="./change_password.php">Change Password</a>
    </body>
</html>