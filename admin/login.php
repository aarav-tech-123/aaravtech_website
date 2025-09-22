<?php
session_start();
include('config/db.php'); // Your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Authentication successful
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        
        // Set a session cookie
        setcookie(session_name(), session_id(), time() + 3600, "/");

        header('Location: dashboard.php'); // Redirect to the dashboard
        exit;
    } else {
        // Authentication failed
        header('Location: index.php?error=1');
        exit;
    }
}
?>