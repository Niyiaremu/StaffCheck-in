<?php
    require_once "connect1.php";
    $query = "SELECT * FROM clockins ORDER BY period DESC";
    $result = mysqli_query($connect1, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clock-In Records</title>
    <link rel="stylesheet" href="tables.css">
</head>
<body>
    <div class="container">
        <h2>CLOCKED-IN STAFF</h2>

        <table>
            <tr>
                <th>id</th>
                <th>user-email</th>
                <th>time</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['user_email'] ?></td>
                <td><?= $row['period'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
 
