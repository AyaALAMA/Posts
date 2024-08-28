<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $post_id]);

    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل منشور</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="edit_post.php" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
        <label for="title">العنوان:</label>
        <input type="text" id="title" name="title" required minlength="3" value="<?php echo $post['title']; ?>"><br><br>
        
        <label for="content">المحتوى:</label>
        <textarea id="content" name="content"><?php echo $post['content']; ?></textarea><br><br>
        
        <button type="submit">تعديل المنشور</button>
    </form>
</body>
</html>
