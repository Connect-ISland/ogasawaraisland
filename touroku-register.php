<?php
session_start();
require 'db-connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['touroku'])) {
    $address = $_SESSION['touroku']['address'];
    $password = $_SESSION['touroku']['password'];
    $name = $_SESSION['touroku']['user_name'];
    $tourokubi = date('Y-m-d H:i:s');

    try {
        // データベースに接続
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // データをデータベースに挿入
        $stmt = $pdo->prepare("INSERT INTO user (address, password, user_name, tourokubi) VALUES (?, ?, ?, ?)");
        $stmt->execute([$address, $password, $name, $tourokubi]);

        // 登録成功後、セッションをクリアしてログイン画面にリダイレクト
        unset($_SESSION['touroku']);
        header('Location: login-insert.php');
        exit;
    } catch (PDOException $e) {
        echo "データベースエラー: " . $e->getMessage();
    }
} else {
    echo "エラーが発生しました。";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録エラー</title>
</head>
<body>
    <p>登録に失敗しました。</p>
    <form action="touroku-input.php" method="post">
        <input type="submit" value="登録画面に戻る">
    </form>
</body>
</html>

