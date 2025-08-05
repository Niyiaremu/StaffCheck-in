<?php
    require_once "connect1.php";

    $user_email = $connect1->query("SELECT * from registration where email = '$email'");
    $user = $user_email->fetch_assoc();

    $username = $user ? $user['name'] : "Unknown";

    $record = $connect1->query("SELECT period from clockins where user_email = '$email' ORDER by period DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Clockin History</title>
    <link rel="stylesheet" href="tables.css">
</head>
<body>
    <h2> <?php echo "Hello {$username},"; ?> </h2>
    <h2>Your Clock-in History</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Clock-in Time</th>
        </tr>
        <?php
            $count = 1;
            while ($row = mysqli_fetch_assoc($record)) {
                echo "<tr>
                        <td>$count</td>
                        <td>{$row['period']}</td>
                     </tr>";
                $count++;
            }
        ?>
    </table>
</body>
</html>















