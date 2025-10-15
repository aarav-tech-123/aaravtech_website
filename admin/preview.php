<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

// Check if preview data exists
if (!isset($_SESSION['preview_data'])) {
    header('Location: new_post.php');
    exit;
}

$preview = $_SESSION['preview_data'];
$title = $preview['title'];
$content = $preview['content'];
$image_path = $preview['image_path'];
$timestamp = $preview['timestamp'];

// Handle publishing from preview
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['publish_from_preview'])) {
    include('config/db.php');
    
    try {
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, image_path) VALUES (?, ?, ?)");
        $stmt->execute([$title, $content, $image_path]);
        
        // Clear preview data
        unset($_SESSION['preview_data']);
        
        header('Location: post.php?success=1');
        exit;
    } catch (PDOException $e) {
        $error = "Error publishing post: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Preview Post</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; min-height: 100vh; background-color: #f5f7fa; color: #333; }
        .sidebar { width: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 0; box-shadow: 2px 0 10px rgba(0,0,0,0.1); position: fixed; height: 100vh; overflow-y: auto; z-index: 100; }
        .sidebar a { display: block; color: white; padding: 15px 25px; text-decoration: none; transition: all 0.3s ease; border-left: 4px solid transparent; font-weight: 500; }
        .sidebar a:hover { background-color: rgba(255,255,255,0.1); border-left: 4px solid #fff; padding-left: 30px; }
        .main-content { flex: 1; margin-left: 250px; padding: 30px; }
        
        .preview-header {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
            border-left: 5px solid #48bb78;
        }
        
        .preview-header h1 {
            color: #4a5568;
            margin-bottom: 10px;
            font-size: 32px;
        }
        
        .preview-badge {
            display: inline-block;
            background: #48bb78;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        .preview-actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        .btn-publish {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 200px;
        }
        
        .btn-edit {
            background: #718096;
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 200px;
        }
        
        .btn-publish:hover, .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102,126,234,0.3);
        }
        
        .blog-preview {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 40px;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.7;
        }
        
        .blog-title {
            font-size: 2.5em;
            color: #2d3748;
            margin-bottom: 20px;
            line-height: 1.3;
            border-bottom: 3px solid #667eea;
            padding-bottom: 15px;
        }
        
        .blog-meta {
            color: #718096;
            font-size: 0.9em;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .blog-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .blog-content {
            font-size: 1.1em;
            color: #4a5568;
            line-height: 1.8;
        }
        
        .blog-content h1, .blog-content h2, .blog-content h3 {
            color: #2d3748;
            margin: 30px 0 15px 0;
        }
        
        .blog-content p {
            margin-bottom: 20px;
        }
        
        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .blog-content blockquote {
            border-left: 4px solid #667eea;
            padding-left: 20px;
            margin: 20px 0;
            font-style: italic;
            color: #718096;
        }
        
        .blog-content ul, .blog-content ol {
            margin: 20px 0;
            padding-left: 30px;
        }
        
        .blog-content li {
            margin-bottom: 8px;
        }
        
        .blog-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .blog-content table, .blog-content th, .blog-content td {
            border: 1px solid #e2e8f0;
        }
        
        .blog-content th, .blog-content td {
            padding: 12px;
            text-align: left;
        }
        
        .blog-content th {
            background-color: #f7fafc;
        }
        
        .no-image {
            background: #f7fafc;
            border: 2px dashed #cbd5e0;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            color: #718096;
            margin-bottom: 30px;
        }
        
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main-content { margin-left: 0; }
            body { flex-direction: column; }
            .blog-preview { padding: 20px; }
            .blog-title { font-size: 2em; }
            .preview-actions { flex-direction: column; }
            .preview-actions a, .preview-actions button { width: 100%; }
        }
    </style>
</head>
<body>
    <nav class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="post.php">Manage Blogs</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="main-content">
        <div class="preview-header">
            <span class="preview-badge">📝 POST PREVIEW</span>
            <h1>Preview Your Blog Post</h1>
            <p>This is exactly how your post will appear to readers. Review everything carefully before publishing.</p>
            
            <div class="preview-actions">
                <form action="preview.php" method="POST" style="display: inline;">
                    <button type="submit" name="publish_from_preview" class="btn-publish">
                        ✅ Publish Now
                    </button>
                </form>
                <a href="edit_post.php" class="btn-edit">✏️ Edit Post</a>
                <a href="new_post.php?clear_preview=1" class="btn-edit" style="background: #e53e3e;">❌ Cancel</a>
            </div>
        </div>
        
        <div class="blog-preview">
            <h1 class="blog-title"><?php echo htmlspecialchars($title); ?></h1>
            
            <div class="blog-meta">
                <span>📅 <?php echo $timestamp; ?></span>
                <span>•</span>
                <span>👤 Admin</span>
                <span>•</span>
                <span>🔍 Preview Mode</span>
            </div>
            
            <?php if ($image_path): ?>
                <img src="<?php echo htmlspecialchars($image_path); ?>" alt="<?php echo htmlspecialchars($title); ?>" class="blog-image">
            <?php else: ?>
                <div class="no-image">
                    <span style="font-size: 48px;">🖼️</span>
                    <p>No featured image selected</p>
                    <small>Add an image in the editor to make your post more engaging</small>
                </div>
            <?php endif; ?>
            
            <div class="blog-content">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</body>
</html>
