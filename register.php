<?php
    require_once "connect.php";

    if (isset($_POST["register"])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        $checkEmail = $connect->query("SELECT email FROM logbook WHERE email = '$email'");
        if ($checkEmail->num_rows > 0) {
            $_SESSION['error_message'] = 'Email has already been registered';
            header("Location: register.php");
            exit();
        } 
        else {
            $connect->query("INSERT INTO logbook (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
            $_SESSION['success_message'] = 'Congratulations, you have successfully registered!';
            header("Location: index.php"); 
            exit();
        }
    }
?>