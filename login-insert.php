<?PHP require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login-box">
    <div class="left-box">
        <h1>connectisland</h1>
        <h2>L O G I N</h2>
    <form action="login-output.php" method="post">
        <h3>ユーザー名</h3>
        <input type="text" name="user_name"  placeholder="username">
        <h3>メールアドレス</h3>
        <input type="email" name="mail"  placeholder="mail">
        <h3>パスワード</h3>
        <input type="password" name="password"  placeholder="password" >
        <p>
        <input type="submit" value="ログイン" class="button">
        <br>
            アカウントをお持ちでない方は<a href="touroku-input.php"><b>新規登録へ</b></a>
    </form>
</body>
</html>