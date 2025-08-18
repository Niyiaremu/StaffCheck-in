<?php
require_once "connect1.php";

echo "<h2>Database Debug Test</h2>";

// Check connection
if ($connect1) {
    echo "✅ Database connected successfully!<br><br>";
} else {
    echo "❌ Database connection failed!<br>";
    exit;
}

// Show all registered users
echo "<h3>All Registered Users:</h3>";
$result = $connect1->query("SELECT name, email, role FROM registrations");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<strong>Name:</strong> " . $row['name'] . "<br>";
        echo "<strong>Email:</strong> '" . $row['email'] . "'<br>";
        echo "<strong>Role:</strong> " . $row['role'] . "<br>";
        echo "<hr>";
    }
} else {
    echo "❌ No users found in registrations table!<br>";
}

// Manual login test form
echo "<h3>Test Your Login Here:</h3>";
echo '<form method="post">
    <input type="email" name="test_email" placeholder="Your exact email" required><br><br>
    <input type="text" name="test_password" placeholder="Your exact password" required><br><br>
    <button type="submit" name="manual_test">Test Login</button>
</form>';

// Process manual test
if (isset($_POST['manual_test'])) {
    $test_email = $_POST['test_email'];
    $test_password = $_POST['test_password'];
    
    echo "<h3>Testing Login...</h3>";
    echo "Email you entered: '$test_email'<br>";
    echo "Password you entered: '$test_password'<br><br>";
    
    $stmt = $connect1->prepare("SELECT * FROM registrations WHERE email = ?");
    $stmt->bind_param("s", $test_email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "✅ Email found in database!<br>";
        $user = $result->fetch_assoc();
        echo "Database name: " . $user['name'] . "<br>";
        echo "Database email: '" . $user['email'] . "'<br>";
        echo "Password hash starts with: " . substr($user['password'], 0, 15) . "...<br><br>";
        
        if (password_verify($test_password, $user["password"])) {
            echo "🎉 <strong style='color:green'>PASSWORD VERIFICATION SUCCESS!</strong><br>";
            echo "Your login should work perfectly!<br>";
        } else {
            echo "❌ <strong style='color:red'>PASSWORD VERIFICATION FAILED!</strong><br>";
            echo "This means either:<br>";
            echo "1. You're typing the password wrong<br>";
            echo "2. The password wasn't saved correctly when you registered<br>";
        }
    } else {
        echo "❌ Email '$test_email' not found in database!<br>";
        echo "Are you sure this is the exact email you registered with?<br>";
    }
}
?>