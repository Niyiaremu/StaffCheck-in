<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $relate = mysqli_connect("localhost:3307", "root", "", "checkin_list") or die("Connection Failed:" . mysqli_connect_error());

    if (isset($_POST["name"]) && isset($_POST["date"]) && isset($_POST["time"])) {
        $name = $_POST["name"];
        $date = $_POST["date"];
        $time = $_POST["time"];


        $sql = "INSERT INTO `logbook` (`name`, `date`, `time`) VALUES ('$name', '$date', '$time')";

        $query = mysqli_query($relate, $sql);

        if ($query) {
            echo "Entry Successful";
        } else {
            echo "Error Occured";
        }
    }
}
