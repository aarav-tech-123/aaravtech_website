<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="post.php">Manage Blogs</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="main-content">
        <h2>Welcome to the Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <div class="container" style="max-width: none;">
            <h3>Dashboard Overview</h3>
            <p>Here you can see a summary of your site's activity. You can add more features here like user counts,
                recent posts, etc.</p>
        </div>
    </div>
</body>

</html>