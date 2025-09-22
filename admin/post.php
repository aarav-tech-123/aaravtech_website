<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
include('config/db.php'); // Include your database connection

// Fetch all posts from the database (you'll need a 'posts' table)
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Blogs</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="post.php">Manage Blogs</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="main-content">
        <h2>Manage Blogs</h2>
        <div class="container" style="max-width: none;">
            <a href="new_post.php" class="button">Create New Post</a>
            <div class="posts-list">
                <?php if (count($posts) > 0): ?>
                <?php foreach ($posts as $post): ?>
                <div class="post-item">
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <?php if ($post['image_path']): ?>
                    <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image"
                        style="max-width: 100%; height: auto; margin-bottom: 15px;">
                    <?php endif; ?>
                    <p><?php echo substr(htmlspecialchars($post['content']), 0, 150) . '...'; ?></p>
                    <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="button">Edit</a>
                    <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="button"
                        style="background-color: #e74c3c;">Delete</a>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p>No blog posts found. Create a new one!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>