<?php
    require_once("connect.php");

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = $connect->query("SELECT * FROM logbook WHERE email = '$email' ");
        if ($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if (password_verify($password, $user["password"])) {
                if ($user['role'] === 'admin') {
                    header("Location: admin_page.php");
                }
                else{
                    header("Location: user_page.php");
                }
                exit();
            }
        }
        header("Location: index.php");
        exit();
    }
?>