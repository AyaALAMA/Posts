<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة المنشورات</title>
    <link rel="stylesheet" href="index<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة المنشورات</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="profile">
            <img src="frappe-framework-hero.png" alt="Profile Picture" class="profile-pic">
        </div>
        <button class="create-post-btn" onclick="openModal()">إنشاء منشور</button>
    </header>

    <main>
        <?php
        $stmt = $pdo->query("SELECT posts.id, posts.title, posts.content, posts.created_at, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            echo "<div class='post'>";
            echo "<div class='post-header'>";
            echo "<h2>{$post['title']}</h2>";
            echo "<p>By {$post['username']} on {$post['created_at']}</p>";
            echo "<p>{$post['content']}</p>";

            $stmt = $pdo->prepare("SELECT media_type, media_path FROM media WHERE post_id = ?");
            $stmt->execute([$post['id']]);
            $media_files = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($media_files as $media) {
                if ($media['media_type'] == 'image') {
                    echo "<img src='{$media['media_path']}' alt='Image'>";
                } elseif ($media['media_type'] == 'video') {
                    echo "<video src='{$media['media_path']}' controls></video>";
                } elseif ($media['media_type'] == 'audio') {
                    echo "<audio src='{$media['media_path']}' controls></audio>";
                }
            }

            echo "<div class='post-options'>";
            echo "<span onclick='toggleOptionsMenu(this)'>⋮</span>";
            echo "<div class='options-menu'>";
            echo "<a href='edit_post.php?id={$post['id']}'>تعديل منشور</a>";
            echo "<a href='delete_post.php?id={$post['id']}'>حذف المنشور</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<hr>";
        }
        ?>
    </main>

    <div id="postModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">×</span>
            <form action="create_post.php" method="POST" enctype="multipart/form-data">
                <label for="title">العنوان:</label>
                <input type="text" id="title" name="title" required minlength="3"><br><br>
                
                <label for="content">المحتوى:</label>
                <textarea id="content" name="content"></textarea><br><br>
                
                <label for="media">رفع الوسائط:</label>
                <input type="file" id="media" name="media[]" multiple><br><br>
                
                <button type="submit">إنشاء منشور</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('postModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('postModal').style.display = 'none';
        }

        function toggleOptionsMenu(element) {
            const menu = element.nextElementSibling;
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
.css">
</head>
<body>
    <header>
        <div class="profile">
            <img src="profile.jpg" alt="Profile Picture" class="profile-pic">
        </div>
        <button class="create-post-btn" onclick="openModal()">إنشاء منشور</button>
    </header>

    <main>
        <?php
        $stmt = $pdo->query("SELECT posts.id, posts.title, posts.content, posts.created_at, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            echo "<div class='post'>";
            echo "<div class='post-header'>";
            echo "<h2>{$post['title']}</h2>";
            echo "<p>By {$post['username']} on {$post['created_at']}</p>";
            echo "<p>{$post['content']}</p>";

            $stmt = $pdo->prepare("SELECT media_type, media_path FROM media WHERE post_id = ?");
            $stmt->execute([$post['id']]);
            $media_files = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($media_files as $media) {
                if ($media['media_type'] == 'image') {
                    echo "<img src='{$media['media_path']}' alt='Image'>";
                } elseif ($media['media_type'] == 'video') {
                    echo "<video src='{$media['media_path']}' controls></video>";
                } elseif ($media['media_type'] == 'audio') {
                    echo "<audio src='{$media['media_path']}' controls></audio>";
                }
            }

            echo "<div class='post-options'>";
            echo "<span onclick='toggleOptionsMenu(this)'>⋮</span>";
            echo "<div class='options-menu'>";
            echo "<a href='edit_post.php?id={$post['id']}'>تعديل منشور</a>";
            echo "<a href='delete_post.php?id={$post['id']}'>حذف المنشور</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<hr>";
        }
        ?>
    </main>

    <div id="postModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">×</span>
            <form action="create_post.php" method="POST" enctype="multipart/form-data">
                <label for="title">العنوان:</label>
                <input type="text" id="title" name="title" required minlength="3"><br><br>
                
                <label for="content">المحتوى:</label>
                <textarea id="content" name="content"></textarea><br><br>
                
                <label for="media">رفع الوسائط:</label>
                <input type="file" id="media" name="media[]" multiple><br><br>
                
                <button type="submit">إنشاء منشور</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('postModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('postModal').style.display = 'none';
        }

        function toggleOptionsMenu(element) {
            const menu = element.nextElementSibling;
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
