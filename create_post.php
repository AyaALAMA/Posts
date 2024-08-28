<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = 1;

    $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $user_id]);
    $post_id = $pdo->lastInsertId();

    foreach ($_FILES['media']['tmp_name'] as $key => $tmp_name) {
        $file_name = $_FILES['media']['name'][$key];
        $file_tmp = $_FILES['media']['tmp_name'][$key];
        $file_type = $_FILES['media']['type'][$key];
        $file_path = "path/to/" . $file_name;

        move_uploaded_file($file_tmp, $file_path);

        $media_type = explode('/', $file_type)[0];
        $stmt = $pdo->prepare("INSERT INTO media (post_id, media_type, media_path) VALUES (?, ?, ?)");
        $stmt->execute([$post_id, $media_type, $file_path]);
    }

    header("Location: index.php");
    exit();
}
?>
