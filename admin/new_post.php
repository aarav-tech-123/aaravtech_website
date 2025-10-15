<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}

// Clear preview data if requested
if (isset($_GET['clear_preview']) && $_GET['clear_preview'] == 1) {
    unset($_SESSION['preview_data']);
}

include('config/db.php');

// Initialize variables
$title = $content = $slug = '';
$error = $success = '';
$preview_data = null;

// Function to generate slug from title
function generateSlug($title) {
    $slug = preg_replace('/[^a-zA-Z0-9\s]/', '', $title);
    $slug = strtolower(trim($slug));
    $slug = preg_replace('/\s+/', '-', $slug);
    $slug = preg_replace('/-+/', '-', $slug);
    return $slug;
}

// Helper function to get upload error messages
function getUploadError($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return "File size exceeds server limit.";
        case UPLOAD_ERR_FORM_SIZE:
            return "File size exceeds form limit.";
        case UPLOAD_ERR_PARTIAL:
            return "File was only partially uploaded.";
        case UPLOAD_ERR_NO_FILE:
            return "No file was uploaded.";
        case UPLOAD_ERR_NO_TMP_DIR:
            return "Missing temporary folder.";
        case UPLOAD_ERR_CANT_WRITE:
            return "Failed to write file to disk.";
        case UPLOAD_ERR_EXTENSION:
            return "A PHP extension stopped the file upload.";
        default:
            return "Unknown upload error.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $slug = trim($_POST['slug'] ?? '');
    $image_path = null;

    // Generate slug if empty
    if (empty($slug) && !empty($title)) {
        $slug = generateSlug($title);
    }

    // Validate slug
    if (empty($slug)) {
        $error = "Slug is required. It will be used in the URL.";
    }

    // Check if it's a preview request
    if (isset($_POST['preview'])) {
        // Handle image for preview
        $preview_image = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            $file_name = uniqid() . '_' . basename($_FILES['image']['name']);
            $target_file = $upload_dir . $file_name;
            
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check !== false && move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $preview_image = $target_file;
            }
        }
        
        // Store preview data in session
        $_SESSION['preview_data'] = [
            'title' => $title,
            'content' => $content,
            'slug' => $slug,
            'image_path' => $preview_image,
            'timestamp' => date('F j, Y \a\t g:i A')
        ];
        
        header('Location: preview.php');
        exit;
        
    } else if (isset($_POST['publish'])) {
        // Handle actual publishing
        // Check if a file was uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            
            // Create uploads directory if it doesn't exist
            if (!is_dir($upload_dir)) {
                if (!mkdir($upload_dir, 0755, true)) {
                    $error = "Failed to create upload directory.";
                }
            }
            
            if (empty($error)) {
                $file_name = uniqid() . '_' . basename($_FILES['image']['name']);
                $target_file = $upload_dir . $file_name;

                // Validate image file
                $check = getimagesize($_FILES['image']['tmp_name']);
                if ($check === false) {
                    $error = "File is not a valid image.";
                } else {
                    // Move the uploaded file to the target directory
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                        $image_path = $target_file;
                    } else {
                        $error = "Error uploading image. Check directory permissions.";
                    }
                }
            }
        } elseif (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
            $error = "File upload error: " . getUploadError($_FILES['image']['error']);
        }

        // Validate input
        if (empty($title)) {
            $error = "Title is required.";
        } elseif (empty($content)) {
            $error = "Content is required.";
        } elseif (empty($slug)) {
            $error = "Slug is required.";
        }

        // Check if slug already exists
        if (empty($error)) {
            $stmt = $pdo->prepare("SELECT id FROM posts WHERE slug = ?");
            $stmt->execute([$slug]);
            if ($stmt->fetch()) {
                $original_slug = $slug;
                $counter = 1;
                while (true) {
                    $new_slug = $original_slug . '-' . $counter;
                    $stmt = $pdo->prepare("SELECT id FROM posts WHERE slug = ?");
                    $stmt->execute([$new_slug]);
                    if (!$stmt->fetch()) {
                        $slug = $new_slug;
                        break;
                    }
                    $counter++;
                }
            }
        }

        // If no errors, insert into database
        if (empty($error)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO posts (title, content, image_path, slug) VALUES (?, ?, ?, ?)");
                $stmt->execute([$title, $content, $image_path, $slug]);
                
                $success = "Post published successfully!";
                
                // Clear form fields on success
                $title = $content = $slug = '';
                
            } catch (PDOException $e) {
                $error = "Error creating post: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create New Post</title>
    <script src="https://cdn.tiny.cloud/1/7yzc3vwl72v3pxhafso5p0l0e7fmq0w2pv76vp73o65rbt9s/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; min-height: 100vh; background-color: #f5f7fa; color: #333; }
        .sidebar { width: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px 0; box-shadow: 2px 0 10px rgba(0,0,0,0.1); position: fixed; height: 100vh; overflow-y: auto; z-index: 100; }
        .sidebar a { display: block; color: white; padding: 15px 25px; text-decoration: none; transition: all 0.3s ease; border-left: 4px solid transparent; font-weight: 500; }
        .sidebar a:hover { background-color: rgba(255,255,255,0.1); border-left: 4px solid #fff; padding-left: 30px; }
        .main-content { flex: 1; margin-left: 250px; padding: 30px; }
        h2 { color: #4a5568; margin-bottom: 25px; padding-bottom: 10px; border-bottom: 2px solid #e2e8f0; font-size: 28px; }
        .container { background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 30px; max-width: 1000px; margin: 0 auto; }
        .alert { padding: 12px 15px; border-radius: 6px; margin-bottom: 20px; font-weight: 500; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        form { display: flex; flex-direction: column; gap: 20px; }
        label { font-weight: 600; color: #4a5568; margin-bottom: 5px; display: block; font-size: 16px; }
        input[type="text"], input[type="file"] { padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 6px; font-size: 16px; transition: all 0.3s; width: 100%; }
        input[type="text"]:focus, input[type="file"]:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.1); }
        
        #content { 
            min-height: 400px; 
            padding: 15px; 
            border: 1px solid #e2e8f0; 
            border-radius: 6px; 
            font-size: 16px; 
            transition: all 0.3s; 
            width: 100%; 
            resize: vertical;
            opacity: 1 !important;
            position: relative !important;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        
        .btn-preview {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            width: 200px;
            text-align: center;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-preview:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(72, 187, 120, 0.3);
        }
        
        button[type="submit"] {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
            width: 200px;
        }
        
        button[type="submit"]:hover, .btn-preview:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102,126,234,0.3);
        }
        
        .tox-tinymce { border-radius: 6px !important; border: 1px solid #e2e8f0 !important; }
        .file-upload-container { border: 2px dashed #cbd5e0; border-radius: 6px; padding: 20px; text-align: center; background-color: #f8fafc; transition: all 0.3s; }
        .file-upload-container:hover { border-color: #667eea; background-color: #f0f4ff; }
        .file-upload-label { display: flex; flex-direction: column; align-items: center; cursor: pointer; color: #718096; }
        .file-info { margin-top: 10px; font-size: 14px; color: #718096; }
        
        .validation-message {
            color: #e53e3e;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        
        .preview-note {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 6px;
            padding: 15px;
            margin-top: 10px;
            color: #856404;
        }
        
        .slug-preview {
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 15px;
            margin-top: 5px;
            font-size: 14px;
            color: #718096;
        }
        
        .slug-preview strong {
            color: #4a5568;
        }
        
        .field-help {
            color: #718096;
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
        
        @media (max-width: 768px) {
            .sidebar { width: 100%; height: auto; position: relative; }
            .main-content { margin-left: 0; }
            body { flex-direction: column; }
            .form-actions { flex-direction: column; }
            .form-actions button, .form-actions .btn-preview { width: 100%; }
        }
    </style>
    <script>
        // Initialize TinyMCE with better configuration
        tinymce.init({
            selector: '#content',
            plugins: 'image code link lists media table emoticons',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media | table emoticons | code',
            image_title: true,
            automatic_uploads: true,
            images_upload_url: 'upload_handler.php',
            file_picker_types: 'image',
            
            // Fix for validation issues
            init_instance_callback: function(editor) {
                // Sync content back to textarea on change
                editor.on('change keyup', function() {
                    editor.save();
                    // Hide validation message when content is added
                    const validationMsg = document.getElementById('content-validation');
                    if (editor.getContent().trim().length > 0) {
                        validationMsg.style.display = 'none';
                    }
                });
            },
            
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
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            },
            images_upload_handler: function (blobInfo, progress) {
                return new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', 'upload_handler.php');
                    xhr.upload.onprogress = function (e) {
                        progress(e.loaded / e.total * 100);
                    };
                    xhr.onload = function() {
                        if (xhr.status === 403) {
                            reject({ message: 'Authentication failed. Please log in again.', remove: true });
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
                    xhr.onerror = function () {
                        reject('Image upload failed due to a network error.');
                    };
                    const formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                });
            }
        });

        // Function to generate slug from title
        function generateSlug(title) {
            return title
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('image');
            const fileInfo = document.getElementById('file-info');
            const form = document.querySelector('form');
            const previewBtn = document.querySelector('.btn-preview');
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            const slugPreview = document.getElementById('slug-preview');
            
            // Auto-generate slug from title
            if (titleInput && slugInput) {
                titleInput.addEventListener('input', function() {
                    if (!slugInput.dataset.manualEdit) {
                        const generatedSlug = generateSlug(this.value);
                        slugInput.value = generatedSlug;
                        updateSlugPreview(generatedSlug);
                    }
                });
                
                // Mark slug as manually edited
                slugInput.addEventListener('input', function() {
                    this.dataset.manualEdit = 'true';
                    updateSlugPreview(this.value);
                });
                
                // Initial slug preview
                updateSlugPreview(slugInput.value);
            }
            
            function updateSlugPreview(slug) {
                if (slugPreview) {
                    if (slug) {
                        slugPreview.innerHTML = `<strong>URL Preview:</strong> yourblog.com/post/${slug}`;
                        slugPreview.style.display = 'block';
                    } else {
                        slugPreview.style.display = 'none';
                    }
                }
            }
            
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

            // Preview button handler
            if (previewBtn) {
                previewBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const title = document.getElementById('title').value.trim();
                    const slug = document.getElementById('slug').value.trim();
                    let content = '';
                    
                    // Get content from TinyMCE
                    if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
                        content = tinymce.activeEditor.getContent().trim();
                        tinymce.activeEditor.save();
                    } else {
                        content = document.getElementById('content').value.trim();
                    }
                    
                    let isValid = true;
                    
                    // Validate title
                    if (!title) {
                        document.getElementById('title').style.borderColor = '#e53e3e';
                        isValid = false;
                    } else {
                        document.getElementById('title').style.borderColor = '#e2e8f0';
                    }
                    
                    // Validate slug
                    if (!slug) {
                        document.getElementById('slug').style.borderColor = '#e53e3e';
                        isValid = false;
                    } else {
                        document.getElementById('slug').style.borderColor = '#e2e8f0';
                    }
                    
                    // Validate content
                    if (!content) {
                        document.getElementById('content-validation').style.display = 'block';
                        isValid = false;
                    } else {
                        document.getElementById('content-validation').style.display = 'none';
                    }
                    
                    if (isValid) {
                        // Create hidden input for preview
                        let previewInput = document.getElementById('preview-flag');
                        if (!previewInput) {
                            previewInput = document.createElement('input');
                            previewInput.type = 'hidden';
                            previewInput.name = 'preview';
                            previewInput.id = 'preview-flag';
                            previewInput.value = '1';
                            form.appendChild(previewInput);
                        }
                        
                        // Show loading state
                        previewBtn.textContent = 'Generating Preview...';
                        previewBtn.disabled = true;
                        
                        // Submit the form for preview
                        form.submit();
                    } else {
                        // Scroll to first error
                        const firstError = document.querySelector('[style*="border-color: #e53e3e"]') || document.getElementById('content-validation');
                        if (firstError) {
                            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }
                });
            }

            // Publish form validation
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Only validate for publish, not for preview
                    if (!document.getElementById('preview-flag')) {
                        e.preventDefault();
                        
                        const title = document.getElementById('title').value.trim();
                        const slug = document.getElementById('slug').value.trim();
                        let content = '';
                        
                        if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
                            content = tinymce.activeEditor.getContent().trim();
                            tinymce.activeEditor.save();
                        } else {
                            content = document.getElementById('content').value.trim();
                        }
                        
                        let isValid = true;
                        
                        if (!title) {
                            document.getElementById('title').style.borderColor = '#e53e3e';
                            isValid = false;
                        } else {
                            document.getElementById('title').style.borderColor = '#e2e8f0';
                        }
                        
                        if (!slug) {
                            document.getElementById('slug').style.borderColor = '#e53e3e';
                            isValid = false;
                        } else {
                            document.getElementById('slug').style.borderColor = '#e2e8f0';
                        }
                        
                        if (!content) {
                            document.getElementById('content-validation').style.display = 'block';
                            isValid = false;
                        } else {
                            document.getElementById('content-validation').style.display = 'none';
                        }
                        
                        if (isValid) {
                            // Create hidden input for publish
                            let publishInput = document.createElement('input');
                            publishInput.type = 'hidden';
                            publishInput.name = 'publish';
                            publishInput.value = '1';
                            form.appendChild(publishInput);
                            
                            // Show loading state
                            const submitBtn = form.querySelector('button[type="submit"]');
                            if (submitBtn) {
                                submitBtn.textContent = 'Publishing...';
                                submitBtn.disabled = true;
                            }
                            
                            // Submit the form
                            form.submit();
                        } else {
                            const firstError = document.querySelector('[style*="border-color: #e53e3e"]') || document.getElementById('content-validation');
                            if (firstError) {
                                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }
                    }
                });
                
                // Remove novalidate attribute to allow custom validation
                form.setAttribute('novalidate', 'novalidate');
            }
        });
    </script>
</head>
<body>
    <nav class="sidebar">
        <a href="dashboard.php">Dashboard</a>
        <a href="post.php">Manage Blogs</a>
        <!-- <a href="new_post.php" style="background-color: rgba(255, 255, 255, 0.1); border-left: 4px solid #fff;">Create New Post</a> -->
        <a href="sitemap.php" target="_blank">View Sitemap</a>
        <a href="logout.php">Logout</a>
    </nav>
    
    <div class="main-content">
        <h2>Create New Post</h2>
        <div class="container">
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($success); ?>
                    <a href="posts.php" style="margin-left: 10px; color: #155724; text-decoration: underline;">View all posts</a>
                    <a href="sitemap.php" target="_blank" style="margin-left: 10px; color: #155724; text-decoration: underline;">View Sitemap</a>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-error">
                    <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <div class="preview-note">
                <strong>💡 SEO Features:</strong> 
                • Slug will be used for SEO-friendly URLs<br>
                • Sitemap is automatically updated when you publish<br>
                • Preview shows exactly how your post will appear to readers
            </div>
            
            <form action="new_post.php" method="POST" enctype="multipart/form-data" novalidate>
                <div>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" placeholder="Enter your post title" value="<?php echo htmlspecialchars($title); ?>">
                    <span class="field-help">This will be the main headline of your post</span>
                </div>
                
                <div>
                    <label for="slug">URL Slug:</label>
                    <input type="text" id="slug" name="slug" placeholder="url-friendly-version" value="<?php echo htmlspecialchars($slug); ?>">
                    <span class="field-help">This will be used in the URL. Auto-generated from title, but you can customize it.</span>
                    <div class="slug-preview" id="slug-preview" style="display: none;">
                        <strong>URL Preview:</strong> yourblog.com/post/<?php echo htmlspecialchars($slug); ?>
                    </div>
                </div>
                
                <div>
                    <label for="content">Content:</label>
                    <textarea id="content" name="content" placeholder="Write your blog content here..."><?php echo htmlspecialchars($content); ?></textarea>
                    <div class="validation-message" id="content-validation">
                        Please enter content for your post.
                    </div>
                </div>
                
                <div>
                    <label for="image">Featured Image:</label>
                    <div class="file-upload-container">
                        <label for="image" class="file-upload-label">
                            <span style="font-size: 24px;">📁</span>
                            <span>Click to upload featured image</span>
                        </label>
                        <input type="file" id="image" name="image" accept="image/*" style="display: none;">
                        <div class="file-info" id="file-info">No file selected</div>
                    </div>
                    <span class="field-help">Recommended size: 1200x630px for optimal social media sharing</span>
                </div>

                <div class="form-actions">
                    <button type="submit">Publish Post</button>
                    <button type="button" class="btn-preview">Preview Post</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>