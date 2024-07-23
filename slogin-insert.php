<?PHP require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" href="./css/slogin-insert.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php
        echo '<form action="slogin-output.php" method="post">';
        echo    '<h3>ユーザー名</h3>';
        echo    '<input type="text" name="user_name" style="width: 45%; height: 30px;">';
        echo    '<h3>メールアドレス</h3>';
        echo    '<input type="text" name="mail" style="width: 45%; height: 30px;">';
        echo    '<h3>パスワード</h3>';
        echo    '<input type="text" name="password" style="width: 45%; height: 30px;" >';
        echo    '<input type="hidden" name="suser_id" value="',$_GET['suser_id'],'">';
	echo	   '<br>';
        echo    '<input type="submit" value="ログイン" class="button">';
        echo '</form>';
    ?>
</body>
</html>