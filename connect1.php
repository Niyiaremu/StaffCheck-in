<?php
    $dbserver = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "clockindb";

    try {
        $connect1 = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);
    } 
    catch (mysqli_sql_exception) {
        echo "<script>alert('CONNECTION ERROR');</script>";
    }
?>