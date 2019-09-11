<?php
    session_start();
    session_destroy();
    $user = $pass = $firstname = $lastname = $email = $msg="";
    $contactnumber = 0;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include './db_connect.php';
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $cpass = $_POST['confirmpassword'];
        $user = htmlspecialchars($user);
        $pass = htmlspecialchars($pass);
        $cpass = htmlspecialchars($cpass);
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $contactnumber = $_POST['contactnumber'];
        if($user=="" OR $pass=="" OR $cpass=="" OR $firstname=="" OR $lastname==""){
            $msg="Please fill all the fields";
        }
        else if($cpass != $pass){
            $msg="Passwords do not match";
        }
        else{
            $SQL1 = "SELECT * FROM users WHERE username='$user'";
            $result1 = mysqli_query($db_handle, $SQL1);
            $SQL2 = "SELECT * FROM users WHERE email='$email'";
            $result2 = mysqli_query($db_handle, $SQL2);
            $SQL3 = "SELECT * FROM users WHERE contactnumber='$contactnumber'";
            $result3 = mysqli_query($db_handle, $SQL3);
            if(mysqli_num_rows($result1)>0){
                $msg="Username already exists";
            }
            else if(mysqli_num_rows($result2)>0){
                $msg="Email already registered";
            }
            else if(mysqli_num_rows($result3)>0){
                $msg="Contact Number already registered";
            }
            else{
                $SQL = "INSERT INTO users VALUES('$user','$pass','$firstname','$lastname','$email','$contactnumber')";
                $result = mysqli_query($db_handle, $SQL);
                session_start();
                $_SESSION['username'] = $user;
                mysqli_close($db_handle);
                header("Location: ./dashboard.php");
            }
        }
        mysqli_close($db_handle);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
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
        <!-- Signup Form -->
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <div id="formHeader" class="fadeIn">
                    <p>Sign Up</p>
                </div>
                <form method="POST" action="./signup.php">
                    <div class="msg"><?php echo $msg ?></div>
                    <input type="text" id="firstname" class="fadeIn second" name="firstname" placeholder="First Name" required>
                    <input type="text" id="lastname" class="fadeIn third" name="lastname" placeholder="Last Name" required>
                    <input type="email" id="email" class="fadeIn fourth" name="email" placeholder="E-Mail" required>
                    <input type="number" id="contactnumber" class="fadeIn fifth" name="contactnumber" placeholder="Contact Number" required>
                    <input type="text" id="username" class="fadeIn sixth" name="username" placeholder="Username" required>
                    <input type="password" id="password" class="fadeIn seventh" name="password" placeholder="Password" onblur="validatePass();" required>
                    <input type="password" id="confirmpassword" class="fadeIn eighth" name="confirmpassword" placeholder="Confirm Password" onblur="confirmPass();" required>
                    <input type="submit" id="signupButton" class="fadeIn ninth" value="Sign Up">
                </form>
                <div id="formFooter" class="fadeIn tenth">
                    <a class="underlineHover" href="./login.php">Already have an account?</a>
                </div>
            </div>
        </div>
    </body>
</html>