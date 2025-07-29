<?php
    include("database.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Check-In List</title>
</head>
<body bgcolor="E9967A">
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <label>Name:</label> <br>
        <input type="text" name="name" id="name"> <br><br>

        <label>Date:</label> <br>
        <input type="date" name="date" id="date"> <br><br>

        <label>Time:</label> <br>
        <input type="time" name="time" id="time"> <br><br>

        <input type="submit" name="submit" id="submit">
    </form>
</body>
</html>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $date = $_POST["date"];
        $time = $_POST["time"];

        if (empty($name) || empty($date) || empty($time)) {
            echo "<script>alert('FILL THE REQUIRED FIELDS!');</script>";
        } 
        else {
            $sql = "INSERT INTO logbook (name, date, time) VALUES ('$name', '$date', '$time')";

            mysqli_query($conn, $sql);
            echo "<script>alert('SUCCESSFULLY CLOCKED-IN');</script>";
        }
    } 
    mysqli_close($conn);
?>