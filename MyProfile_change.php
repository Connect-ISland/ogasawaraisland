<?php session_start(); ?>
<?PHP require 'db-connect.php'; ?>
<?php require 'header.html'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/MyProfile_change.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集</title>
    <style>
       .button {
            background-color: #4EB8E0; /* 水色の背景色 */
            color: white; /* ボタンのテキスト色 */
            border: none; /* ボーダーをなしに設定 */
            padding: 10px 20px; /* ボタンの内側の余白 */
            text-align: center; /* テキストを中央揃えに */
            text-decoration: none; /* テキストの装飾をなしに */
            display: inline-block; /* インラインブロック要素として表示 */
            font-size: 16px; /* フォントサイズ */
            cursor: pointer; /* カーソルをポインターに変更 */
            border-radius: 5px; /* ボタンの角を丸くする */
            transition: background-color 0.3s ease; /* 背景色の変化をアニメーション化 */
        }

        .button:hover {
            background-color: #3A9BCD; /* ホバー時の背景色 */
        }
    </style>
</head>
<body>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <form action="MyProfile_change_out.php" method="post" enctype="multipart/form-data">
    <center><h3 style="color: white;">プロフィール画像(ファイルによっては表示できない場合があります)</h3></center>
<center>　　　　　　　　　　　<input type="file" name="image" id="input" accept="image/*"></center>
        <center><figure id="figure" style="display: none">
            <figcaption>画像ファイルのプレビュー</figcaption>
            <img src="" alt="" id="figureImage" style="width: 80px; height:80px; border-radius:50%">
        </figure></center>
        <center><h3 style="color: white;">ユーザー名</h3></center>
        <?php
        echo '<center><input type="text" name="user_name" value="',$_SESSION['user-info']['user_name'],'" style="width: 45%; height: 30px;"></center>';
        echo '<center><h3 style="color: white;">コメント</h3></center>';
        echo '<center><input type="text" name="comment" value="',$_SESSION['user-info']['user_comment'],'" style="width: 45%; height: 30px;"></center>';
        ?><br>
        <center><input type="submit" value="更新" class="button"></center>
    </form>
    <script src="up.js"></script>
</body>
</html>