<?php
// Include your database connection file
include('config/db.php');

// Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input (e.g., check for empty fields)
    if (empty($username) || empty($password)) {
        die("Please fill in all fields.");
    }

    // Hash the password for security before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

        // Execute the statement with the user data
        $stmt->execute([$username, $hashed_password]);

        // Redirect to a success page or login page
        echo "User created successfully! You can now <a href='index.php'>log in</a>.";

    } catch (PDOException $e) {
        // Handle a potential error, e.g., if the username already exists
        echo "Error creating user: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Signup</title>
</head>
<body>
    <h2>User Signup</h2>
    <form action="signup.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>