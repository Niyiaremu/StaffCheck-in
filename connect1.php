<?php
    $dbserver = "localhost:3307";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "checkin_list";

    $connect1 = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);

    try {
        $connect1 = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);
    } 
    catch (mysqli_sql_exception) {
        echo "<script>alert('CONNECTION ERROR');</script>";
    }
?> 