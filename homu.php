<?php session_start();?>
<?php require 'db-connect.php';?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="./css/header.css">
    <!-- <link rel="stylesheet" href="css/botton.css"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>homepage</title>
    <script src="js/hamberger.js"></script>
    <style>

    </style>
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
<?php
$pdo=new PDO($connect, USER, PASS);
$sql=$pdo->prepare('select * from post where user_id=?');
$sql->execute([$_SESSION['user-info']['user_id']]);
//↓↓テスト用のアカウントの1を使用↓↓
// $sql->execute($arry=['1']);
// $num=$arry[0];
//echo '<h1>',$num,'</h1>';
//$post_con=count($sql);
$post_con=0;
foreach($sql as $row){
    $post_con=$post_con+1;
}

$sql=$pdo->prepare('select * from user where user_id=?');
//echo '<h1>',$num,'</h1>';
// $sql->execute([$num]);
$sql->execute([$_SESSION['user-info']['user_id']]);
foreach($sql as $row){
   echo '<main class="column-parts">';

   echo '<div class="main-contents-parts">';
                    
                    echo '　　　　　　　　　　　　','<img src="data:image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/>';
            // <figcaption>　　　　　　　　　　　　ユーザー名</figcaption>
            echo  '<figcaption>','　　　　　　　　　　　　',$row['user_name'],'</figcaption>';
            echo '<div class="button020">';
            echo '<a href="login-insert.php">','ログアウト','</a>';
            echo '</div>';
        echo '</div>';
}
        ?>
        <?php  
        $pdo=new PDO($connect, USER, PASS);
        // $sql=$pdo->prepare('select * from follow where user_id=? and follow_id=?');
    echo  '　　　　　　　　　','<div class="sub-contents-parts">';
    // $count=0;
    foreach($pdo->query('SELECT user_image,post_id,post_image,user_name,post_image,post FROM post LEFT JOIN user ON post.user_id = user.user_id') as $row){
    echo  '<div class="list-grid">';   
    echo  '<div class="list2">';
    echo  '<figure style="position: relative;">';

    echo '<img src="data:image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/>';
    echo '<figcaption>'.$row['user_name'].'</figcaption>';
    echo '<br>';
    // echo  '<img src="data:image/jpg;base64,',$row['post_image'],'"height="250" width="290">';
    echo  '<img src="data:image/jpg;base64,'.base64_encode($row['post_image']).'"height="290" width="340">';
    echo '<a href="post.php?post_id=', $row['post_id'], '">';
    echo  '<div class="dli-chat">','</div>';
    echo  '</a>';
    echo  '<figcaption>',$row['post'],'</figcaption>';
    echo  '</figure>';
                   
    echo  '</div>';
    }
?>

  </div>
            </div>
        </div>
    </main>
</body>
</html>