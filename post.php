<?php
// db-connect.php に必要なDB接続情報が記述されていると仮定
require 'db-connect.php';

session_start();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/post.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>

<div class="all">
    <div class="border-dashed">
        <div class="center">
            <?php
            // ログインユーザーのIDを取得
            $loggedInUserId = isset($_SESSION['user-info']['user_id']) ? $_SESSION['user-info']['user_id'] : null;

            try {
                $pdo = new PDO($connect, USER, PASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if(isset($_SESSION['user-info']) && isset($_GET['post_id'])){
                    // 投稿の取得と表示
                    $post_id = $_GET['post_id'];

                    // 投稿情報を取得
                    $stmt1 = $pdo->prepare('SELECT * FROM post JOIN user ON post.user_id = user.user_id WHERE post.post_id = ?');
                    $stmt1->execute([$post_id]);
                    $post = $stmt1->fetch(PDO::FETCH_ASSOC);

                    if ($post) {
                        // 投稿者の情報
                        echo '<img src="data:image/jpg;base64,'.base64_encode($post['user_image']).'" style="width: 80px; height:80px; border-radius:50%"></img>';
                        echo '<u>', $post['user_name'], '</u>';

                        // 自分の投稿であれば編集ボタンを表示
                        if ($loggedInUserId && $post['user_id'] == $loggedInUserId) {
                            echo '　　<button class="delete" onclick="location.href=\'postedit.php?post_id=', $post['post_id'], '\'">投稿を編集</button>';
                        }

                        // メインコンテンツの表示
                        echo '<main class="column-parts">';
                        echo '<div class="main-contents-parts">';
                        // コメントの取得と表示
                        $stmt2 = $pdo->prepare('SELECT * FROM comment JOIN user ON comment.user_id = user.user_id WHERE comment.post_id = ?');
                        $stmt2->execute([$post_id]);
                        $comments = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($comments as $comment) {
                            echo '<div class="tinko">';
                            echo '<img src="data:image/jpg;base64,'.base64_encode($comment['user_image']).'" style="width: 80px; height:80px; border-radius:50%"></img>';
                            echo '<br><span style="color: blue;">' . $comment['user_name'] . 'さん</span></br>';
                            echo '<span>', $comment['comment'], '</span>';
                            echo '</div>';
                            if (isset($comment['comment_image'])) {
                                echo '<img src="data:image/jpg;base64,'.base64_encode($comment['comment_image']).'" style="width: auto; height: 150px;"></img>';
                            }
                        }

                        echo '</div>';
                        echo '<div class="sub-contents-parts">';
                        echo '<img src="data:image/jpg;base64,'.base64_encode($post['post_image']).'" style="width: auto; height: 400px;"></img>';
			echo '<p>', $post['post'],'</p>';
                        echo '</div>';
                        echo '</main>';

                        // コメント投稿フォーム
                        echo '<form action="commentoutput.php" method="post">';
                        echo '<input type="text" name="comment" placeholder="コメントを入力する" class="text">';
                        echo '<input type="hidden" name="post_id" value="', $post['post_id'],'">';
                        echo '<input type="submit" class="post">';
                        echo '</form>';
                    } else {
                        echo '<p>投稿が見つかりません</p>';
                    }

                } else {
                    echo '<p>表示できません</p>';
                }

            } catch(PDOException $e) {
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
<!--/#footermenu2-parts-->

</body>
</html>
