<?php session_start();?>
<?php require 'db-connect.php';?>
<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="./css/header.css">
<link rel="stylesheet" href="./css/profile.css">
    <meta charset="UTF-8">
    <title>投稿成功</title>
</head>
<style>
        /* ボタンのスタイル */
        .styled-button {
            background-color: #4EB8E0; /* ボタンの背景色（水色） */
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

        /* ホバー時のスタイル */
        .styled-button:hover {
            background-color: #3A9BCD; /* ホバー時の背景色 */
        }

        /* フォームを中央に配置するためのスタイル */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* 画面全体の高さいっぱいに広がるように設定 */
        }
    </style>
<body>
    <div class="color">
        <img class="rogo" src="./img/rogo.png">
        <div class="homu-iti"><a href="homu.php"><button type="button" class="button-home"><div class="dli-home"></div></button></a></div>
        <div class="search-iti"><a href="search.php"><button type="button" class="button-search"><span class="dli-search"></span></button></a></div>
        <div class="sinkitoukou-iti"><a href="sinkitoukou.php"><button type="button" class="button-sinkitoukou"><span class="dli-box-out"><span></span></span></button></a></div>
        <div class="my-iti"><a href="MyProfile.php"><button type="button" class="button-my"><span class="dli-user-circle-fill"><span></span></span></button></a></div>
        <hr>
    </div>
    <?php
        $image = $_FILES['image']['tmp_name'];
        $imgData = addslashes(file_get_contents($image));
        $pdo=new PDO($connect, USER, PASS);
        //$sql="UPDATE post SET post_image='$imgData'where post_id=39";
        //$sql2=$pdo->prepare($sql);
        //$sql2->execute();
        //echo '<img src="data:imageData/jpg;base64,'.base64_encode($imgData).'" alt="アップロードされた画像">';
        //echo '<img src="data:post_image/jpg;base64,'.base64_encode($imgData).'" style="width: 193px; height:130px;"/>';
        $post_date = date('Y-m-d H:i:s');

        $stmt = $pdo->prepare("INSERT INTO post (user_id, post, post_date) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user-info']['user_id'],$_POST['post'],$post_date]);

        /*if(empty($_POST['image'])){
            echo 'kara';
        }else{
            echo 'aru';
        }*/
        $sql3=$pdo->prepare('select max(post_id) from post');
        $sql3->execute();
        foreach($sql3 as $row){
            $poid=$row['max(post_id)'];
        }

        $sql="UPDATE post SET post_image='$imgData'where post_id='$poid'";
        $sql2=$pdo->prepare($sql);
        $sql2->execute();
    ?>
<div class="form-container">
    <form action="homu.php" method="post" enctype="multipart/form-data">
        <!-- おしゃれなボタン -->
        <input type="submit" value="ホーム画面に戻る" class="styled-button">
    </form>
</div></body>
</html>