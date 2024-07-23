<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.html'; ?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" defer type="text/javascript"></script>
</head>
<body>


    <?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from post where user_id=?');
    $sql->execute([$_SESSION['user-info']['user_id']]);
    $num=$_SESSION['user-info']['user_id'];

    $post_con=0;
    foreach($sql as $row){
        $post_con=$post_con+1;
    }

    $sql=$pdo->prepare('select * from follow where user_id=?');
    $sql->execute([$num]);
    $follow_con=0;
    foreach($sql as $row){
        $follow_con=$follow_con+1;
    }

    $sql=$pdo->prepare('select * from follower where user_id=?');
    $sql->execute([$num]);
    $follower_con=0;
    foreach($sql as $row){
        $follower_con=$follower_con+1;
    }

    $sql=$pdo->prepare('select * from user where user_id=?');
    $sql->execute([$num]);

    foreach($sql as $row){
        echo '<table style="color: white;" align="center" class="table1">';
        echo '<tr><th><a href="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" data-lightbox="group"><img src="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></a></th><th>',$row['user_name'],'</th><th>投稿',$post_con,'件</th><th><button onclick="location.href=\'https://aso2201135.namaste.jp/ogasawaraisland/MyProfile_change.php\'">プロフィールを編集</button>
             </th><th><button type="button" id="link-btn">このページのアカウントをシェアする</button></th></tr>';
        echo '</table>';
        
        echo '<table style="color: white;" align="center" class="table2"><tr><th>フォロワー',$follower_con,'人</th><th>フォロー中',$follow_con,'人</th></tr></table>';
        echo '<p style="color: white;" align="center">',$row['user_comment'],'</p>';
    }

    
    $sql2=$pdo->prepare('select * from post where user_id=?');
    $sql2->execute([$num]);

    $count=0;
    echo '<table align="center">';
    echo '<tr>';
    foreach($sql2 as $row2){
        $count=$count+1;
        echo '<th><a href="https://aso2201135.namaste.jp/ogasawaraisland/post_detail.php?post_id=',$row2['post_id'],'"><img src="data:post_image/jpg;base64,'.base64_encode($row2['post_image']).'" style="width: 223px; height:160px;"/></a></th>';
        if($count==3){
            echo '</tr>';
            echo '<tr>';
            $count=0;
        }
    }
    echo '</tr>';
    echo '</table>';
    ?>  
    <script>
        const link_btn = document.getElementById('link-btn');
        link_btn.addEventListener('click', async () => {
        try {
            await navigator.share({
            title:'<?php echo $_SESSION['user-info']['user_name'],'さんのプロフィールです。ログインして見てみよう！'; ?> ', 
            text:'<?php echo $_SESSION['user-info']['user_name'],'さんのプロフィールです。ログインして見てみよう！'; ?>',
            url:<?php echo '"https://aso2201135.namaste.jp/ogasawaraisland/slogin-insert.php?suser_id=',$_SESSION['user-info']['user_id'],'"'; ?>
            });
        } catch (error) {
            console.error(error);
        }
        });
    </script> 
</body>
</html>
