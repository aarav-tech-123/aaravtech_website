<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
include('config/db.php');

// Fetch all posts from the database
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Blogs</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        display: flex;
        min-height: 100vh;
        background-color: #f5f7fa;
        color: #333;
    }

    .sidebar {
        width: 250px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 0;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        position: fixed;
        height: 100vh;
        overflow-y: auto;
        z-index: 100;
    }

    .sidebar a {
        display: block;
        color: white;
        padding: 15px 25px;
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
        font-weight: 500;
    }

    .sidebar a:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-left: 4px solid #fff;
        padding-left: 30px;
    }

    .main-content {
        flex: 1;
        margin-left: 250px;
        padding: 30px;
    }

    h2 {
        color: #4a5568;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
        font-size: 28px;
    }

    .container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .btn-new-post {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-new-post:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    .post-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .post-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #e2e8f0;
    }

    .no-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid #e2e8f0;
        color: #a0aec0;
        font-size: 14px;
    }

    .post-content {
        padding: 20px;
    }

    .post-title {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 15px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #f1f5f9;
    }

    .post-date {
        font-size: 12px;
        color: #718096;
    }

    .post-actions {
        display: flex;
        gap: 10px;
    }

    .btn-edit {
        background: #4299e1;
        color: white;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-edit:hover {
        background: #3182ce;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #e53e3e;
        color: white;
        text-decoration: none;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-delete:hover {
        background: #c53030;
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #718096;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #4a5568;
        margin-bottom: 10px;
        font-size: 20px;
    }

    .empty-state p {
        margin-bottom: 20px;
        font-size: 14px;
    }

    .posts-count {
        color: #718096;
        font-size: 14px;
        background: #f7fafc;
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .main-content {
            margin-left: 0;
        }

        body {
            flex-direction: column;
        }

        .posts-grid {
            grid-template-columns: 1fr;
        }

        .header-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-new-post {
            text-align: center;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .main-content {
            padding: 15px;
        }

        .container {
            padding: 20px;
        }

        .post-actions {
            flex-direction: column;
        }

        .btn-edit,
        .btn-delete {
            text-align: center;
        }
    }
    </style>
</head>

<body>
    <nav class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="posts.php" style="background-color: rgba(255, 255, 255, 0.1); border-left: 4px solid #fff;">Manage
            Blogs</a>
        <!-- <a href="new_post.php">Create New Post</a> -->
        <a href="logout.php">Logout</a>
    </nav>

    <div class="main-content">
        <h2>Manage Blog Posts</h2>
        <div class="container">
            <div class="header-actions">
                <a href="new_post.php" class="btn-new-post">
                    <span>+</span> Create New Post
                </a>
                <div class="posts-count">
                    📊 Total Posts: <?php echo count($posts); ?>
                </div>
            </div>

            <?php if (count($posts) > 0): ?>
            <div class="posts-grid">
                <?php foreach ($posts as $post): ?>
                <div class="post-card">
                    <?php if ($post['image_path']): ?>
                    <img src="<?php echo htmlspecialchars($post['image_path']); ?>"
                        alt="<?php echo htmlspecialchars($post['title']); ?>" class="post-image"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="no-image" style="display: none;">
                        🖼️ Image not found
                    </div>
                    <?php else: ?>
                    <div class="no-image">
                        🖼️ No featured image
                    </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <h3 class="post-title" title="<?php echo htmlspecialchars($post['title']); ?>">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </h3>

                        <div class="post-meta">
                            <div class="post-date">
                                📅 <?php echo date('M j, Y', strtotime($post['created_at'])); ?>
                            </div>
                            <div class="post-actions">
                                <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn-edit">
                                    Edit
                                </a>
                                <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn-delete"
                                    onclick="return confirm('Are you sure you want to delete this post? This action cannot be undone.')">
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <div class="empty-state">
                <div class="empty-state-icon">📝</div>
                <h3>No Blog Posts Yet</h3>
                <p>Get started by creating your first blog post!</p>
                <a href="new_post.php" class="btn-new-post" style="display: inline-flex;">
                    <span>+</span> Create Your First Post
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
    // Add some interactive features
    document.addEventListener('DOMContentLoaded', function() {
        // Add loading animation to cards
        const cards = document.querySelectorAll('.post-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('fade-in');
        });

        // Add confirmation for delete links
        const deleteLinks = document.querySelectorAll('.btn-delete');
        deleteLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (!confirm(
                        'Are you sure you want to delete this post? This action cannot be undone.'
                        )) {
                    e.preventDefault();
                }
            });
        });
    });

    // Add fade-in animation
    const style = document.createElement('style');
    style.textContent = `
            .fade-in {
                animation: fadeInUp 0.6s ease-out forwards;
                opacity: 0;
            }
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
    document.head.appendChild(style);
    </script>
</body>

</html>