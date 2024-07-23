<?php session_start();?>
<?php require 'db-connect.php';?>
<link rel="stylesheet" href="css/loguinoutput.css">
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php
    unset($_SESSION['user-info']);
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select*from user where user_name=? and address=? and password=?');
    $sql->execute([$_POST['user_name'],$_POST['mail'],$_POST['password']]);
    foreach($sql as $row){
        $_SESSION['user-info']=[
            'user_id'=>$row['user_id'],
            'user_name'=>$row['user_name'],
            'password'=>$row['password'],
            'address'=>$row['address'],
            'tourokubi'=>$row['tourokubi'],
            'user_image'=>$row['user_image'],
	'user_comment'=>$row['user_comment'],
        ];
    }
    if (isset($_SESSION['user-info'])) {
        // ログイン後のページ
        echo '<div class="login-container success-message">';
        echo 'ログイン完了<br>';
        echo '<div class="center-text">' . htmlspecialchars($_SESSION['user-info']['user_name'], ENT_QUOTES, 'UTF-8') . '様。</div><br>';
        echo '<a href="homu.php" class="button next-page-link">ホーム画面へ</a>';
        echo '</div>';
    } else {
        echo '<div class="login-container error-message">';
        echo 'ログイン名またはメールアドレスまたはパスワードが違います。<br>';
        echo '<form action="login-insert.php" method="post">';
        echo '<input type="submit" value="ログイン画面へ" class="button">';
        echo '</form>';
        echo '</div>';
    }
    ?>
</body>
</html>