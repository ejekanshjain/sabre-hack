<?php
    session_start();
    $user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Password Changed Successfully</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="./js/change_password_successful.js"></script>
    </head>
    <body onload="successful();"></body>
</html>