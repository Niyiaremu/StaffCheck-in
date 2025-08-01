<?php
    $date = date("Y-m-d H:i:s"); // current date and time
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clock-in Verified</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="clockin-success">
        <h1>SUCCESSFULLY CLOCKED-IN!</h1>
    </div>
    <div class="timestamp">
        Time: <?php echo $date; ?>
    </div>
</body>
</html>