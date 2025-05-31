<?php
// Connect to database
$con = new mysqli('localhost', 'root', '', 'testdb');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $con->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Fetch user data
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $con->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            echo "Login successful. Welcome, " . htmlspecialchars($username) . "!";
            // You can start a session here if needed
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    $con->close();
}
?>

<!-- Login HTML Form -->
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>
