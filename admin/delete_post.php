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

try {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);
    header('Location: post.php');
    exit;
} catch (PDOException $e) {
    die("Error deleting post: " . $e->getMessage());
}
?>