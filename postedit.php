<?php require 'db-connect.php'; ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/postedit.css">
    <link rel="stylesheet" href="./css/header.css"> <!-- 必要なら他のCSSファイルも読み込む -->
    <title>Document</title>
</head>
<body>
    <div class="all">
<div class="border-dashed">
<div class="center">
    <!-- <div class="post"> -->
        <?php
        // データベース接続やデータ取得の処理
        try {
            $pdo = new PDO($connect, USER, PASS);
            if (isset($_SESSION['user-info'])) {
                $sql1 = $pdo->prepare('SELECT * FROM post JOIN user ON post.user_id = user.user_id WHERE post.post_id = ?');
                $sql2 = $pdo->prepare('SELECT * FROM comment JOIN user ON comment.user_id = user.user_id WHERE comment.post_id = ?');
                $sql1->execute([$_GET['post_id']]);
                $sql2->execute([$_GET['post_id']]);
                foreach ($sql1 as $row1) {
                    echo '<form action="postdelete.php" method="post">';
                    echo '<img src="data:image/jpg;base64,' . base64_encode($row1['user_image']) . '" style="width: 80px; height:80px; border-radius:50%"></img>';
                    echo '<u>', $row1['user_name'], '</u>';
                    if ($row1['user_id'] == $_SESSION['user-info']['user_id']) {
                        echo '<input type="hidden" name="post_id" value="', $row1['post_id'], '">';
                        echo '　　<input type="submit" class="delete" value="投稿を削除">';
                    } else {
                        echo ' ';
                    }
                    echo '<main class="column-parts">';
                    
                    // echo '<a href="post.php?post_id=', $row1['post_id'], '">終了</a>';
                    echo '</form>';
                    // echo '<img src="data:image/jpg;base64,' . base64_encode($row1['user_image']) . '" style="width: 80px; height:80px; border-radius:50%"></img>';
                    // echo '<h3>', $row1['user_name'], '</h3>';
                    echo '<div class="sub-contents-parts">';
                    echo '<img src="data:image/jpg;base64,' . base64_encode($row1['post_image']).'" style="width: auto; height: 400px;"></img>';
                    echo '<p>', $row1['post'], '</p>';
                    echo'</div>';
                    echo '<div class="main-contents-parts">';
                    foreach ($sql2 as $row2) {
                        if ($row1['user_id'] == $_SESSION['user-info']['user_id'] || $row2['user_id'] == $_SESSION['user-info']['user_id']) {
                            echo '<form action="commentdelete.php" method="post">';
                            echo '<input type="hidden" name="post_id" value="', $row2['post_id'], '">';
                            echo '<input type="checkbox" name="comment[]" value="', $row2['comment_id'], '"><img src="data:image/jpg;base64,' . base64_encode($row2['user_image']) . '" style="width: 80px; height:80px; border-radius:50%"></img>';
                            echo '<h3>', $row2['user_name'], '</h3>';
                            echo '<p>', $row2['comment'], '</p>';
                            echo '</input>';
                        } else {
                            echo '<img src="data:image/jpg;base64,' . base64_encode($row2['user_image']) . '" style="width: 80px; height:80px; border-radius:50%"></img>';
                            echo '<h3>', $row2['user_name'], '</h3>';
                            echo '<p>', $row2['comment'], '</p>';
                            echo '<a href="post.php?post_id=', $row2['post_id'], '">終了</a>';
                        }
                    }
                }
                echo '</div>';
                echo '</main>';
		echo '--チェックボックスでコメントを選択--';
		echo '<br>';
                echo '<input type="submit" class="delete" value="削除">';
            }
        } catch (PDOException $e) {
            die("データベースエラー: " . $e->getMessage());
        }
        ?>
    </div>
    </div>
    </div>
    <div id="footermenu2-parts">
    <ul>
        <li class="title">Menu</li>
        <li><u><a href="homu.php">マイページへ</a></u></li>
    </ul>
</div>
</body>
</html>
