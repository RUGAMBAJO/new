<?php
// Connect to database
$con = new mysqli('localhost', 'root', '', 'testdb');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Run signup code only when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $con->real_escape_string($_POST['username']);
    $email = $con->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash password

    // Insert data
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($con->query($sql) === TRUE) {
        echo "Signup successful!";
    } else {
        echo "Error: " . $con->error;
    }

    $con->close();
}
?>

<!-- Signup HTML Form -->
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Sign Up">
</form>
