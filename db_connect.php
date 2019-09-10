<?php
    $username = "root";
    $password = "";
    $database = "sabre_hack";
    $server = "localhost";
    $db_handle = mysqli_connect($server, $username, $password);
    $db_found = mysqli_select_db($db_handle, $database);
    if(!$db_found){
        die("Database not found");
    }
?>