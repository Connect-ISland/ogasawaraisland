<?PHP require 'db-connect.php'; ?>
<?php session_start();?>
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
    $sql=$pdo->prepare('select * from follow where user_id=? and follow_id=?');
    //↓user_id=2でログインし、user_id=1を参照している状態のテスト用
    $sql->execute(array(2,1));
    $result=$sql->fetchAll();

    if(empty($_SESSION['user-info']['suser_id'])){
        if(empty($result)){
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from post where user_id=?');
            //↓↓テスト用のアカウントの1を使用↓↓
            $sql->execute($arry=['1']);
            $num=$arry[0];
            //echo '<h1>',$num,'</h1>';
            //$post_con=count($sql);
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
    
            $sql=$pdo->prepare('select * from follow where follow_id=?');
            $sql->execute([$num]);
            $follower_con=0;
            foreach($sql as $row){
                $follower_con=$follower_con+1;
            }
    
            $sql=$pdo->prepare('select * from user where user_id=?');
            //echo '<h1>',$num,'</h1>';
            $sql->execute([$num]);
    
            foreach($sql as $row){
            echo '<h1 style="color: white;">ヘッダー</h1>';
            echo '<hr>';
            echo '<table style="color: white;" align="center" class="table1">';
            //$img="data:image/jpeg;base64,".$row['image'];
            echo '<tr><th><a href="data:image/jpg;base64,'.base64_encode($row['user_image']).'" data-lightbox="group"><img src="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></a></th><th>',$row['user_name'],'</th><th>投稿',$post_con,'件</th>';
            
            //
            echo '<th><a href="follow-insert.php?login_user=2&user_id=',$row['user_id'],'"class="follow">フォローする</a></th></tr>';
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
                echo '<th><img src="data:user_image/jpg;base64,'.base64_encode($row2['image']).'" style="width: 193px; height:130px;"/></th>';
                if($count==3){
                    echo '</tr>';
                    echo '<tr>';
                    $count=0;
                }
            }
            echo '</tr>';
            echo '</table>';
        }else{
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from post where user_id=?');
            //↓↓テスト用のアカウントの1を使用↓↓
            $sql->execute($arry=['1']);
            $num=$arry[0];
            //echo '<h1>',$num,'</h1>';
            //$post_con=count($sql);
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
            //echo '<h1>',$num,'</h1>';
            $sql->execute([$num]);
    
            foreach($sql as $row){
            echo '<h1 style="color: white;">ヘッダー</h1>';
            echo '<hr>';
            echo '<table style="color: white;" align="center" class="table1">';
            //$img="data:image/jpeg;base64,".$row['image'];
            echo '<tr><th><a href="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" data-lightbox="group"><img src="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></a></th><th>',$row['user_name'],'</th><th>投稿',$post_con,'件</th>';
            
            //
            echo '<th><a href="follow-delete.php?user_id=',$row['user_id'],'&login_user=2"class="follow">フォローをやめる</a></th></tr>';
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
                echo '<th><img src="data:post_image/jpg;base64,'.base64_encode($row2['post_image']).'" style="width: 193px; height:130px;"/></th>';
                if($count==3){
                    echo '</tr>';
                    echo '<tr>';
                    $count=0;
                }
            }
            echo '</tr>';
            echo '</table>';
        }
    }else{
        $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from post where user_id=?');
            $num=$_SESSION['user-info']['suser_id'];
            $sql->execute([$num]);
            //echo '<h1>',$num,'</h1>';
            //$post_con=count($sql);
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
    
            $sql=$pdo->prepare('select * from follow where follow_id=?');
            $sql->execute([$num]);
            $follower_con=0;
            foreach($sql as $row){
                $follower_con=$follower_con+1;
            }
    
            $sql=$pdo->prepare('select * from user where user_id=?');
            //echo '<h1>',$num,'</h1>';
            $sql->execute([$num]);
    
            foreach($sql as $row){
            echo '<h1 style="color: white;">ヘッダー</h1>';
            echo '<hr>';
            echo '<table style="color: white;" align="center" class="table1">';
            //$img="data:image/jpeg;base64,".$row['image'];
            echo '<tr><th><a href="data:image/jpg;base64,'.base64_encode($row['user_image']).'" data-lightbox="group"><img src="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></a></th><th>',$row['user_name'],'</th><th>投稿',$post_con,'件</th>';
            
            //
            echo '<th><a href="follow-insert.php?login_user=2&user_id=',$row['user_id'],'"class="follow">フォローする</a></th></tr>';
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
                echo '<th><img src="data:user_image/jpg;base64,'.base64_encode($row2['post_image']).'" style="width: 193px; height:130px;"/></th>';
                if($count==3){
                    echo '</tr>';
                    echo '<tr>';
                    $count=0;
                }
            }
            echo '</tr>';
            echo '</table>';
    }
    
    ?>   
</body>
</div>
</html>