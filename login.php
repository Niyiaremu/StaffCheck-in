<?php
    require_once "connect1.php";

    if (isset($_POST['clock-in'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = $connect1->query("SELECT * FROM clockins WHERE user_email = '$email' ");
        if ($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if (password_verify($password, $user["password"])) {
                if ($user['role'] === 'admin') {
                    echo 'Congratulations, you have successfully registered!';
                    // header("Location: admin_page.php");
                }
                else{
                    $connect2->query("INSERT INTO clockins (user_email, password) VALUES ('$email', '$password')");
                    // header("Location: user_page.php");
                }
                exit();
            }
        }
        header("Location: index.php");
        exit();
    }
?>