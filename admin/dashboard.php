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
            max-width: 1000px;
            margin: 0 auto;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 5px;
            display: block;
            font-size: 16px;
        }

        input[type="text"],
        input[type="file"] {
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
            width: 100%;
        }

        input[type="text"]:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            min-height: 400px;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
            width: 100%;
            resize: vertical;
        }

        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            margin-top: 10px;
            width: 200px;
            align-self: flex-start;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .tox-tinymce {
            border-radius: 6px !important;
            border: 1px solid #e2e8f0 !important;
        }

        .file-upload-container {
            border: 2px dashed #cbd5e0;
            border-radius: 6px;
            padding: 20px;
            text-align: center;
            background-color: #f8fafc;
            transition: all 0.3s;
        }

        .file-upload-container:hover {
            border-color: #667eea;
            background-color: #f0f4ff;
        }

        .file-upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            color: #718096;
        }

        .file-upload-label i {
            font-size: 24px;
            margin-bottom: 10px;
            color: #667eea;
        }

        .file-info {
            margin-top: 10px;
            font-size: 14px;
            color: #718096;
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
        <h2>Welcome to the Dashboard, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <div class="container" style="max-width: none;">
            <h3>Dashboard Overview</h3>
            <p>Here you can see a summary of your site's activity. You can add more features here like user counts,
                recent posts, etc.</p>
        </div>
    </div>
</body>

</html>