<?php
    require_once "connect1.php";

    if (isset($_POST['clock-in'])) {
        $email = $_POST['email'];
        $password =  $_POST['password'];

        $connect1->query("INSERT INTO clockins (user_email, password) VALUES ('$email', '$password')");
        
        $result = $connect1->query("SELECT * FROM registration WHERE email = '$email' ");
        if ($result->num_rows > 0){
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user["password"])) {
                if ($user['role'] === 'admin') {
                    include('admin-page.php');
                }
                else{
                    echo "<script>alert('CLOCK-IN SUCCESSFUL');</script>";
                    include('user-page.php');
                }
            }
        }
        else {
            echo "<script>alert('INVALID LOGIN!')</script>;";
        }
    }
?>