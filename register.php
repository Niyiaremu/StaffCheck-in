<?php
    require_once "connect1.php";

    if (isset($_POST["register"])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $user_email = $connect1->query("SELECT email FROM registration WHERE email = '$email'");
        if ($user_email->num_rows > 0) {
            echo "<script>alert('ERROR; EMAIL HAS ALREADY BEEN REGISTERED!'); window.location.replace('index.php');</script>";
        } 
        else {
            $connect1->query("INSERT INTO registration (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
            echo "<script>alert('CONGRATULATIONS, YOU HAVE SUCCESSFULLY REGISTERED! BEGIN CLOCK-IN'); window.location.replace('index.php');</script>";
        }
    }
?>