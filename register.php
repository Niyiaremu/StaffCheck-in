<?php
require_once "connect1.php";

if (isset($_POST["register"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = ($_POST['password']);
    $role = $_POST['role'];

    if ($connect1) {
        $check_stmt = $connect1->prepare("SELECT email FROM registrations WHERE email = ?");
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $user_email = $check_stmt->get_result();

        if ($user_email->num_rows > 0) {
            echo "<script>alert('ERROR; EMAIL HAS ALREADY BEEN REGISTERED!'); window.location.replace('index.php');</script>";
        } 
        else {
            $insert_stmt = $connect1->prepare("INSERT INTO registrations (name, email, password, role) VALUES (?, ?, ?, ?)");
            $insert_stmt->bind_param("ssss", $name, $email, $password, $role);

            if ($insert_stmt->execute()) {
                echo "<script>alert('CONGRATULATIONS, YOU HAVE SUCCESSFULLY REGISTERED! BEGIN CLOCK-IN'); window.location.replace('index.php');</script>";
            } 
            else {
                echo "<script>alert('Registration failed! Please try again.'); window.location.replace('index.php');</script>";
            }
        }
    }
    else {
        echo "<script>alert('Database Connection Failed');</script>";
    }  
}
