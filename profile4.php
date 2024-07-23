<!--profile3.phpの更新バージョン-->
<?PHP require 'db-connect.php'; ?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <?php
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
    foreach($sql as $row){0
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
    echo '<tr><th><img src="data:image/jpg;base64,'.base64_encode($row['image']).'" style="width: 80px; height:80px; border-radius:50%"/></th><th>',$row['user_name'],'</th><th>投稿',$post_con,'件</th><th><button>プロフィールを編集</button></th></tr>';
    echo '</table>';
    
    echo '<table style="color: white;" align="center" class="table2"><tr><th>フォロワー',$follower_con,'人</th><th>フォロー中',$follow_con,'人</th></tr></table>';
    echo '<p style="color: white;" align="center">',$row['post'],'</p>';
    }

    
    $sql2=$pdo->prepare('select * from post where user_id=?');
    $sql2->execute([$num]);

    $count=0;
    echo '<table align="center">';
    echo '<tr>';
    foreach($sql2 as $row2){
        $count=$count+1;
        echo '<th><a href="#"><img src="data:image/jpg;base64,'.base64_encode($row2['image']).'" style="width: 193px; height:130px;"/></a></th>';
        if($count==3){
            echo '</tr>';
            echo '<tr>';
            $count=0;
        }
    }
    echo '</tr>';
    echo '</table>';
    ?>   
</body>
</div>
</html>