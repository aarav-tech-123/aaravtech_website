<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
include('config/db.php');

$post_id = $_GET['id'] ?? null;
if (!$post_id) {
    header('Location: posts.php');
    exit;
}

// Fetch the existing post data
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();
if (!$post) {
    header('Location: posts.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_path = $post['image_path']; // Retain the existing image path by default

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $file_name = uniqid() . '_' . basename($_FILES['image']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Delete the old image if it exists
            if ($post['image_path'] && file_exists($post['image_path'])) {
                unlink($post['image_path']);
            }
            $image_path = $target_file;
        } else {
            die("Error uploading new image.");
        }
    }

    try {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, image_path = ? WHERE id = ?");
        $stmt->execute([$title, $content, $image_path, $post_id]);
        header('Location: posts.php');
        exit;
    } catch (PDOException $e) {
        die("Error updating post: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="display: block;">
    <nav class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="post.php">Manage Blogs</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="main-content">
        <h2>Edit Post</h2>
        <div class="container" style="max-width: none;">
            <form action="edit_post.php?id=<?php echo $post_id; ?>" method="POST" enctype="multipart/form-data">
                <label for="image">Upload New Image:</label>
                <?php if ($post['image_path']): ?>
                <p>Current Image:</p>
                <img src="<?php echo htmlspecialchars($post['image_path']); ?>"
                    style="max-width: 200px; display: block; margin-bottom: 10px;" alt="Post Image">
                <?php endif; ?>
                <input type="file" id="image" name="image" accept="image/*">

                <button type="submit">Update Post</button>
            </form>
        </div>
    </div>
</body>

</html>