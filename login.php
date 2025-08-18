<?php
    require_once "connect1.php";

    if (isset($_POST['clock-in'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($connect1) {
            $stmt = $connect1->prepare("SELECT * FROM registrations WHERE email = ? ");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0){
                $user = $result->fetch_assoc();
            
                if (password_verify($password, $user['password'])) {
                    $today = date('Y-m-d');
                    $check_stmt = $connect1->prepare("SELECT * FROM clockins WHERE user_email = ? AND period = ?");
                    $check_stmt->bind_param("ss", $email, $today);
                    $check_stmt->execute();
                    $check_result = $check_stmt->get_result();

                    if ($check_result->num_rows > 0) {
                        echo "<script>alert('You already clocked in today! Use clock-out instead.'); window.location.replace('index.php');</script>";
                    } 
                    else {
                        $clock_stmt = $connect1->prepare("INSERT INTO clockins (user_email, period, status) VALUES (?, NOW(), 'clocked_in')");
                        $clock_stmt->bind_param("s", $email);
                        $clock_stmt->execute();
                    }
                
                    if ($user['role'] === 'admin') {
                        echo "<script>alert('CLOCK-IN SUCCESSFUL');</script>";
                        include ('admin-page.php');
                    }
                    else{
                        echo "<script>alert('CLOCK-IN SUCCESSFUL');</script>";
                        echo "<script>window.location.replace('user-page.php');</script>";
                    }
                }
                else {
                    echo "<script>alert('Wrong password! Try again.');</script>";
                    echo "<script>window.location.replace('index.php');</script>";
                }
            }
            else {
                echo "<script>alert('No account found with this email!');</script>";
            }
        }
        else {
            echo "<script>alert('Database Connection Failed');</script>";
        }
    }
?>