<?php session_start();?>
<?php require 'db-connect.php';?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   	<link rel="stylesheet" href="./css/header.css">
	<link rel="stylesheet" href="./css/shinkitoukou1.css">
    <title>画像アップロード</title>
</head>
<body>
    <div class="color">
        <img class="rogo" src="./img/rogo.png">
        <div class="homu-iti"><a href="homu.php"><button type="button" class="button-home"><div class="dli-home"></div></button></a></div>
        <div class="search-iti"><a href="search.php"><button type="button" class="button-search"><span class="dli-search"></span></button></a></div>
        <div class="sinkitoukou-iti"><a href="sinkitoukou.php"><button type="button" class="button-sinkitoukou"><span class="dli-box-out"><span></span></span></button></a></div>
        <div class="my-iti"><a href="MyProfile.php"><button type="button" class="button-my"><span class="dli-user-circle-fill"><span></span></span></button></a></div>
        <hr>
    </div>

    <form action="sinkitoukou2.php" method="post" enctype="multipart/form-data">
        <span style="color: white;">新規投稿を作成</span><br>
        <input type="file" name="image" id="input" accept="image/*">
        <br>
        <textarea name="post" rows="5" cols="40" placeholder="コメント入力" required></textarea>
        <br>
        <?php
            echo '<img src="data:user_image/jpg;base64,'.base64_encode($_SESSION['user-info']['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/>';
        ?>
        <br>
        
            <span style="color: white;"><?php echo $_SESSION['user-info']['user_name']; ?></span>
        
        <br>
        <?php
            //$image = $_FILES['image']['tmp_name'];
            //$imgData = addslashes(file_get_contents($image));
            //echo '<img src="data:post_image/jpg;base64,'.base64_encode($imgData).'"alt="アップロードされた画像" style="width: 193px; height:130px;"/>';
        ?>

        <figure id="figure" style="display: none">
            <figcaption>画像ファイルのプレビュー</figcaption>
            <img src="" alt="" id="figureImage" style="max-width: 100%">
        </figure>
        <input type="submit" value="投稿する">
    </form>

    <script src="up.js"></script>
</body>
</html>