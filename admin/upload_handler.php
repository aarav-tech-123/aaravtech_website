<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

// Set headers for JSON response
header('Content-Type: application/json');

// Directory where uploaded images will be saved
$upload_dir = 'uploads/';
if (!file_exists($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
        echo json_encode(['error' => 'Failed to create upload directory']);
        exit;
    }
}

// Check if a file was uploaded
if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    $error_message = 'No file uploaded or upload error.';
    switch ($_FILES['file']['error'] ?? 4) {
        case UPLOAD_ERR_INI_SIZE:
            $error_message = 'File size exceeds server limit.';
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $error_message = 'File size exceeds form limit.';
            break;
        case UPLOAD_ERR_PARTIAL:
            $error_message = 'File was only partially uploaded.';
            break;
        case UPLOAD_ERR_NO_FILE:
            $error_message = 'No file was uploaded.';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $error_message = 'Missing temporary folder.';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $error_message = 'Failed to write file to disk.';
            break;
        case UPLOAD_ERR_EXTENSION:
            $error_message = 'A PHP extension stopped the file upload.';
            break;
    }
    http_response_code(400);
    echo json_encode(['error' => $error_message]);
    exit;
}

$file = $_FILES['file'];

// Validate file is an image
$allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime_type = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mime_type, $allowed_types)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid file type. Only JPEG, PNG, GIF, WebP, and SVG are allowed.']);
    exit;
}

// Validate file size (max 5MB)
$max_file_size = 5 * 1024 * 1024; // 5MB in bytes
if ($file['size'] > $max_file_size) {
    http_response_code(400);
    echo json_encode(['error' => 'File size too large. Maximum size is 5MB.']);
    exit;
}

// Generate a unique filename
$file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$file_name = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9-_\.]/', '', $file['name']);
$target_file = $upload_dir . $file_name;

// Move the uploaded file to the target directory
if (move_uploaded_file($file['tmp_name'], $target_file)) {
    // Return the URL of the uploaded image
    echo json_encode([
        'location' => $target_file,
        'message' => 'File uploaded successfully'
    ]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to move uploaded file.']);
}
?>