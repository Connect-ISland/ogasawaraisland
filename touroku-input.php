<?php
session_start();

$name = $address = $password = '';
if (isset($_SESSION['touroku'])) {
    $address = $_SESSION['touroku']['address'];
    $password = $_SESSION['touroku']['password'];
    $name = $_SESSION['touroku']['user_name'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力内容確認</title>
    <link rel="stylesheet" href="css/touroku.css">
</head>
<body>
    <div class="h2">
    <div class="title">
    <h1>ConnectIsland</h1>
</div>
    <form action="touroku-confirm.php" method="post">
        <table>
        <div class="mail">
            <tr>
                <td>メールアドレス　</td>
                <td><input type="text" name="address" placeholder="メールアドレス" value="<?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?>"></td>
            </tr>
</div>
        <div class="password">
            <tr>
                <td>パスワード　</td>
                <td><input type="text" name="password" placeholder="パスワード" value="<?php echo htmlspecialchars($password, ENT_QUOTES, 'UTF-8'); ?>"></td>
            </tr>
</div>
        <div class="user">
            <tr>
                <td>氏名　</td>
                <td><input type="text" name="user_name"placeholder="ユーザー名" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"></td>
            </tr>
</div>
        </table>
        <input type="submit" class="button-037"> 
</div>
    </form>
    <form action="login-insert.php" method="post">
    <div class="login">
        <p>ログインへ</p>
    <div class="login2"> 
        <input type="submit" class="button-038" value="戻る">
</div>
    </div>
    </form>
</body>
</html>
