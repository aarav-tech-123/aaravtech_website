<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
include('config/db.php');

$post_id = $_GET['id'] ?? null;
if (!$post_id) {
    header('Location: post.php');
    exit;
}

// Fetch the existing post data
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();
if (!$post) {
    header('Location: post.php');
    exit;
}

// Initialize variables
$title = $post['title'];
$content = $post['content'];
$image_path = $post['image_path'];
$error = $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image_path = $post['image_path'];

    // Handle image removal
    if (isset($_POST['remove_current_image']) && $_POST['remove_current_image'] == '1') {
        if ($post['image_path'] && file_exists($post['image_path'])) {
            unlink($post['image_path']);
        }
        $image_path = null;
    }

    // Check if a new file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true)) {
                $error = "Failed to create upload directory.";
            }
        }
        
        if (empty($error)) {
            $file_name = uniqid() . '_' . basename($_FILES['image']['name']);
            $target_file = $upload_dir . $file_name;

            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check === false) {
                $error = "File is not a valid image.";
            } else {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    if ($post['image_path'] && file_exists($post['image_path']) && !isset($_POST['remove_current_image'])) {
                        unlink($post['image_path']);
                    }
                    $image_path = $target_file;
                } else {
                    $error = "Error uploading new image.";
                }
            }
        }
    } elseif (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $error = "File upload error: " . getUploadError($_FILES['image']['error']);
    }

    if (empty($title)) {
        $error = "Title is required.";
    } elseif (empty($content)) {
        $error = "Content is required.";
    }

    if (empty($error)) {
        try {
            $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ?, image_path = ? WHERE id = ?");
            $stmt->execute([$title, $content, $image_path, $post_id]);
            $success = "Post updated successfully!";
            $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
            $stmt->execute([$post_id]);
            $post = $stmt->fetch();
        } catch (PDOException $e) {
            $error = "Error updating post: " . $e->getMessage();
        }
    }
}

function getUploadError($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE: return "File size exceeds server limit.";
        case UPLOAD_ERR_FORM_SIZE: return "File size exceeds form limit.";
        case UPLOAD_ERR_PARTIAL: return "File was only partially uploaded.";
        case UPLOAD_ERR_NO_FILE: return "No file was uploaded.";
        case UPLOAD_ERR_NO_TMP_DIR: return "Missing temporary folder.";
        case UPLOAD_ERR_CANT_WRITE: return "Failed to write file to disk.";
        case UPLOAD_ERR_EXTENSION: return "A PHP extension stopped the file upload.";
        default: return "Unknown upload error.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Post</title>
    <script src="https://cdn.tiny.cloud/1/7yzc3vwl72v3pxhafso5p0l0e7fmq0w2pv76vp73o65rbt9s/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
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

    .alert {
        padding: 12px 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
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

    .file-info {
        margin-top: 10px;
        font-size: 14px;
        color: #718096;
    }

    .current-image {
        margin-bottom: 15px;
    }

    .current-image img {
        max-width: 300px;
        max-height: 200px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border: 2px solid #e2e8f0;
    }

    .image-actions {
        margin-top: 10px;
    }

    .remove-image {
        background: #e53e3e;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
    }

    .remove-image:hover {
        background: #c53030;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .btn-cancel {
        background: #718096;
        color: white;
        text-decoration: none;
        padding: 14px 25px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 150px;
    }

    .btn-cancel:hover {
        background: #4a5568;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(113, 128, 150, 0.3);
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

        .form-actions {
            flex-direction: column;
        }

        .form-actions button,
        .form-actions a {
            width: 100%;
        }
    }
    </style>
    <script>
    tinymce.init({
        selector: '#content',
        plugins: 'image code link lists media table emoticons',
        toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media | table emoticons | code',
        image_title: true,
        automatic_uploads: true,
        images_upload_url: 'upload_handler.php',
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0];
                if (!file.type.match('image.*')) {
                    alert('Please select an image file (JPEG, PNG, GIF, WebP).');
                    return;
                }
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size too large. Please select an image smaller than 5MB.');
                    return;
                }
                var reader = new FileReader();
                reader.onload = function() {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), {
                        title: file.name
                    });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        },
        images_upload_handler: function(blobInfo, progress) {
            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', 'upload_handler.php');
                xhr.upload.onprogress = function(e) {
                    progress(e.loaded / e.total * 100);
                };
                xhr.onload = function() {
                    if (xhr.status === 403) {
                        reject({
                            message: 'Authentication failed. Please log in again.',
                            remove: true
                        });
                        return;
                    }
                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('HTTP Error: ' + xhr.status + ' - ' + xhr.responseText);
                        return;
                    }
                    let json;
                    try {
                        json = JSON.parse(xhr.responseText);
                    } catch (e) {
                        reject('Invalid server response: ' + xhr.responseText);
                        return;
                    }
                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON response from server');
                        return;
                    }
                    resolve(json.location);
                };
                xhr.onerror = function() {
                    reject('Image upload failed due to a network error.');
                };
                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('image');
        const fileInfo = document.getElementById('file-info');

        if (fileInput && fileInfo) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    fileInfo.textContent = 'Selected file: ' + file.name;
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        alert('Please select a valid image file (JPEG, PNG, GIF, WebP).');
                        this.value = '';
                        fileInfo.textContent = 'No file selected';
                        return;
                    }
                    if (file.size > 5 * 1024 * 1024) {
                        alert('File size too large. Please select an image smaller than 5MB.');
                        this.value = '';
                        fileInfo.textContent = 'No file selected';
                    }
                } else {
                    fileInfo.textContent = 'No file selected';
                }
            });
        }

        const removeImageBtn = document.getElementById('remove-image');
        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to remove the current image?')) {
                    let hiddenInput = document.getElementById('remove_current_image');
                    if (!hiddenInput) {
                        hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'remove_current_image';
                        hiddenInput.id = 'remove_current_image';
                        hiddenInput.value = '1';
                        document.querySelector('form').appendChild(hiddenInput);
                    }
                    document.querySelector('.current-image').style.display = 'none';
                }
            });
        }
    });
    </script>
</head>

<body>
    <nav class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="post.php">Manage Blogs</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="main-content">
        <h2>Edit Post</h2>
        <div class="container">
            <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form action="edit_post.php?id=<?php echo $post_id; ?>" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required
                        value="<?php echo htmlspecialchars($post['title']); ?>">
                </div>

                <div>
                    <label for="content">Content:</label>
                    <textarea id="content" name="content"
                        required><?php echo htmlspecialchars($post['content']); ?></textarea>
                </div>

                <div>
                    <label for="image">Featured Image:</label>

                    <?php if ($post['image_path']): ?>
                    <div class="current-image">
                        <p><strong>Current Image:</strong></p>
                        <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Current Post Image">
                        <div class="image-actions">
                            <button type="button" id="remove-image" class="remove-image">Remove Current Image</button>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="file-upload-container">
                        <label for="image" class="file-upload-label">
                            <span style="font-size: 24px;">📁</span>
                            <span>Click to upload new featured image</span>
                        </label>
                        <input type="file" id="image" name="image" accept="image/*" style="display: none;">
                        <div class="file-info" id="file-info">No file selected</div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit">Update Post</button>
                    <a href="post.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>