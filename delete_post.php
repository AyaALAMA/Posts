<?php
include 'config.php';

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);

    $stmt = $pdo->prepare("DELETE FROM media WHERE post_id = ?");
    $stmt->execute([$post_id]);

    header("Location: index.php");
    exit();
}
?>

