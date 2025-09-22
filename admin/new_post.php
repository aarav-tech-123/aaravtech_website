<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
include('config/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_path = null;

    // Check if a file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Create this directory in your project root
        $file_name = uniqid() . '_' . basename($_FILES['image']['name']);
        $target_file = $upload_dir . $file_name;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        } else {
            die("Error uploading image.");
        }
    }

    // Validate input
    if (empty($title) || empty($content)) {
        die("Title and content are required.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, image_path) VALUES (?, ?, ?)");
        $stmt->execute([$title, $content, $image_path]);
        header('Location: posts.php');
        exit;
    } catch (PDOException $e) {
        die("Error creating post: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create New Post</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="display: block;">
    <nav class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="post.php">Manage Blogs</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="main-content">
        <h2>Create New Post</h2>
        <div class="container" style="max-width: none;">
            <form action="new_post.php" method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="10" required></textarea>

                <label for="image">Upload Image:</label>
                <input type="file" id="image" name="image" accept="image/*">

                <button type="submit">Publish Post</button>

            </form>
        </div>
    </div>
</body>

</html>