<?php
    session_start();
    $user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Account Information Changed Successfully</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="./js/my_account_change_details.js"></script>
    </head>
    <body onload="successful();"></body>
</html>