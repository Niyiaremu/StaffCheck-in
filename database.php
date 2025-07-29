<?php

    $dbserver = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "checkin-list";
    $conn;

    try {
        $conn = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);
    } 
    catch (mysqli_sql_exception) {
        echo "<script>alert('CONNECTION ERROR');</script>";
    }