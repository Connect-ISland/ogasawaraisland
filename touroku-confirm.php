<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['touroku'] = $_POST;
}

$address = $_SESSION['touroku']['address'];
$password = $_SESSION['touroku']['password'];
$name = $_SESSION['touroku']['user_name'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力内容確認</title>
    <link rel="stylesheet" href="css/touroku2.css">
</head>
<body>
    <div class="h1">
    <h1>user Informetion</h1></div>
    <form action="touroku-register.php" method="post">
        <table>
            <tr>
            <div class="border">
</div>
            <div class="text">
                <span>　メールアドレス</span>
            </div>
            <div class="border2">
                <div class="text2">
                <span>　<?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></span></div>
            </div>
            </tr>  
            <tr>
                <div class="border3">
                <div class="text3">
                <span>　パスワード</span></div>
                </div>
                <div class="border4">
                <div class="text4">
                <span>　<?php echo htmlspecialchars($password, ENT_QUOTES, 'UTF-8'); ?></span></div>
            </div>
            </tr>
            <tr>
                <div class="border5">
                <div class="text5">
                <span>　氏名<span></div>
                </div>
                <div class="border6">
                <div class="text6">
                <span>　<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></span></div>
            </div>
            </tr>
        </table>
        <div class="botton1">
        <input type="submit" style=background-color:aqua; value="登録する"></div>
    </form>
    <div class="botton2">
    <form action="touroku-input.php" method="post">
        <input type="submit" style=background-color:yellow; value="入力に戻る"></div>
    </form>
</body>
</html>