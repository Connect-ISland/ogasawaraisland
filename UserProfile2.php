<?PHP require 'db-connect.php'; ?>
<?php session_start();?>
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
    //7月10日
    //今日も夕方からバイトで鬱。
    //今日はコードを少し書いたが、大半は暇であった。
    //明日こそ頑張る。
    $pdo=new PDO($connect, USER, PASS);
    //$sql=$pdo->prepare('select * from follow where user_id=? and follow_id=?');
    //$snum=$_SESSION['user-info']['suser_id'];
    //$sql->execute([$_SESSION['user-info']['user_id'],$snum]);
    //$result=$sql->fetchAll();

    //7月8日
    //昨日はシャニマスの映画を見た。話は面白くないが、新曲が聞けたので良かった。今日は特にすることはなかった。
    //明日から頑張ろうと思う。

    $look_user=0;

    //共有機能からではない場合
    if(empty($_SESSION['user-info']['suser_id'])){
        //echo '<h1>共有機能からではない</h1>';
        //7月8日
        //今日はソースコードとにらめっこ状態だった。よく見たら無駄な箇所多い気がする。
        //今日はここまで、明日こそ頑張る。
        $sql=$pdo->prepare('select * from follow where user_id=? and follow_id=?');
        $sql->execute([$_SESSION['user-info']['user_id'],$_GET['user_id']]);
        $result=$sql->fetchAll();
        //フォローしていない場合
        if(empty($result)){
            //echo '<h1>フォローしてない</h1>';
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from post where user_id=?');
            $sql->execute([$_GET['user_id']]);
            //$num=$_GET['user_id'];
            //echo '<h1>',$num,'</h1>';
            //$post_con=count($sql);
            $post_con=0;
            foreach($sql as $row){
                $post_con=$post_con+1;
            }

            //7月9日
            //今日は夕方からバイトがあるので萎え
            //今日も今日とて暇である。明日から頑張る。
            $sql=$pdo->prepare('select * from follow where user_id=?');
            $sql->execute([$_GET['user_id']]);
            $follow_con=0;
            foreach($sql as $row){
                $follow_con=$follow_con+1;
            }
    
            $sql=$pdo->prepare('select * from follow where follow_id=?');
            $sql->execute([$_GET['user_id']]);
            $follower_con=0;
            foreach($sql as $row){
                $follower_con=$follower_con+1;
            }
    
            //7月12日
            //今日はデータの送受信に手間取った。
            //ソースコードに日記を書いているせいでコードが非常に読みにくいのが原因で時間もかかった。
            //土日を費やして頑張ろうと思う。

            $sql=$pdo->prepare('select * from user where user_id=?');
            //echo '<h1>',$num,'</h1>';
            $sql->execute([$_GET['user_id']]);
    
            foreach($sql as $row){
            //echo '<h1 style="color: white;">ヘッダー</h1>';
            //echo '<hr>';
            echo '<table style="color: white;" align="center" class="table1">';
            //$img="data:image/jpeg;base64,".$row['image'];
            echo '<tr><th><a href="data:image/jpg;base64,'.base64_encode($row['user_image']).'" data-lightbox="group"><img src="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></a></th><th>',$row['user_name'],'</th><th>投稿',$post_con,'件</th>';
            
            //
            echo '<th><a href="follow-insert.php?login_user=',$_SESSION['user-info']['user_id'],'&user_id=',$row['user_id'],'"class="follow">フォローする</a></th><th><button type="button" id="link-btn">このページのアカウントをシェアする</button></th></tr>';
            echo '</table>';
            
            echo '<table style="color: white;" align="center" class="table2"><tr><th>フォロワー',$follower_con,'人</th><th>フォロー中',$follow_con,'人</th></tr></table>';
            echo '<p style="color: white;" align="center">',$row['user_comment'],'</p>';
            }
    
            
            $sql2=$pdo->prepare('select * from post where user_id=?');
            $sql2->execute([$_GET['user_id']]);
    
            $count=0;
            echo '<table align="center">';
            echo '<tr>';
            foreach($sql2 as $row2){
                $count=$count+1;
                echo '<th><a href="http://aso2201135.namaste.jp/ogasawaraisland/post_detail.php?post_id=',$row2['post_id'],'"><img src="data:post_image/jpg;base64,'.base64_encode($row2['post_image']).'" style="width: 193px; height:130px;"/><a></th>';
                if($count==3){
                    echo '</tr>';
                    echo '<tr>';
                    $count=0;
                }
            }
            echo '</tr>';
            echo '</table>';
        //フォローしてる場合

        /*
        
            　＿＿＿　　　見えませ～ん 
            ∥　　　 |　　　  ∨ 
            ∥現実  ∧_∧ 　 .ﾍ∧
            ∥　＼ ( ･∀･)　(ﾟA● )
            ||￣￣⊂　　 )  (  と) 
            凵 　　 し`Ｊ　  U  U

            　＿＿＿　　 読めませ～ん 
            ∥　　　 |　　　  ∨ 
            ∥空気  ∧_∧ 　 .ﾍ∧
            ∥　＼ ( ･∀･)　(ﾟA● )
            ||￣￣⊂　　 )  (  と) 
            凵 　　 し`Ｊ　  U  U

            　＿＿＿　　 知りませ～ん 
            ∥　　　 |　　　  ∨ 
            ∥常識  ∧_∧ 　 .ﾍ∧
            ∥　＼ ( ･∀･)　(ﾟA● )
            ||￣￣⊂　　 )  (  と) 
            凵 　　 し`Ｊ　  U  U

            　＿＿＿　　 ありませ～ん 
            ∥　　　 |　　　  ∨ 
            ∥未来  ∧_∧ 　 .ﾍ∧
            ∥　＼ ( ･∀･)　(ﾟA● )
            ||￣￣⊂　　 )  (  と) 
            凵 　　 し`Ｊ　  U  U

        */
        }else{
            //echo '<h1>フォローしてる</h1>';
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from post where user_id=?');
            //↓↓テスト用のアカウントの1を使用↓↓
            $sql->execute([$_GET['user_id']]);
            $num=$_GET['user_id'];
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
            //echo '<h1 style="color: white;">ヘッダー</h1>';
            //echo '<hr>';
            echo '<table style="color: white;" align="center" class="table1">';
            //$img="data:image/jpeg;base64,".$row['image'];
            echo '<tr><th><a href="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" data-lightbox="group"><img src="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></a></th><th>',$row['user_name'],'</th><th>投稿',$post_con,'件</th>';
            
            //
            echo '<th><a href="follow-delete.php?user_id=',$row['user_id'],'&login_user=',$_SESSION['user-info']['user_id'],'"class="follow">フォローをやめる</a></th><th><button type="button" id="link-btn">このページのアカウントをシェアする</button></th></tr>';
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
                echo '<th><a href="http://aso2201135.namaste.jp/ogasawaraisland/post_detail.php?post_id=',$row2['post_id'],'"><img src="data:post_image/jpg;base64,'.base64_encode($row2['post_image']).'" style="width: 193px; height:130px;"/></a></th>';
                if($count==3){
                    echo '</tr>';
                    echo '<tr>';
                    $count=0;
                }
            }
            echo '</tr>';
            echo '</table>';
        }
    //共有機能からの場合
    }else{
        //echo '<h1>共有機能からです</h1>';
        $sql=$pdo->prepare('select * from follow where user_id=? and follow_id=?');
        $sql->execute([$_SESSION['user-info']['user_id'],$_SESSION['user-info']['suser_id']]);
        //echo $_SESSION['user-info']['user_id'];
        //echo '<br>';
        //echo $_SESSION['user-info']['suser_id'];
        $result=$sql->fetchAll();
        
        //フォローしていない場合
        if(empty($result)){
            //echo '<h1>フォローしてない</h1>';
            //$pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from post where user_id=?');
            //$num=$_SESSION['user-info']['suser_id'];
            $sql->execute([$_SESSION['user-info']['suser_id']]);
            //echo '<h1>',$num,'</h1>';
            //$post_con=count($sql);
            $post_con=0;
            foreach($sql as $row){
                $post_con=$post_con+1;
            }
    
            $sql=$pdo->prepare('select * from follow where user_id=?');
            $sql->execute([$_SESSION['user-info']['suser_id']]);
            $follow_con=0;
            foreach($sql as $row){
                $follow_con=$follow_con+1;
            }
    
            $sql=$pdo->prepare('select * from follow where follow_id=?');
            $sql->execute([$_SESSION['user-info']['suser_id']]);
            $follower_con=0;
            foreach($sql as $row){
                $follower_con=$follower_con+1;
            }
    
            $sql=$pdo->prepare('select * from user where user_id=?');
            //echo '<h1>',$num,'</h1>';
            $sql->execute([$_SESSION['user-info']['suser_id']]);

            /*
            しょうりゅうけん！！
            　　　　∧∧ ∩
            　　　 (`･ω･)/
            　　　⊂　　ノ
            　　　　(つノ
            　　　　 (ﾉ
            　＿＿_／(＿＿_
            ／　　(＿＿＿／
            ￣￣￣￣￣
            */
    
            foreach($sql as $row){
            //echo '<h1 style="color: white;">ヘッダー</h1>';
            //echo '<hr>';
            echo '<table style="color: white;" align="center" class="table1">';
            //$img="data:image/jpeg;base64,".$row['image'];
            echo '<tr><th><a href="data:image/jpg;base64,'.base64_encode($row['user_image']).'" data-lightbox="group"><img src="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></a></th><th>',$row['user_name'],'</th><th>投稿',$post_con,'件</th>';
            
            //
            echo '<th><a href="follow-insert.php?login_user=',$_SESSION['user-info']['user_id'],'&user_id=',$row['user_id'],'"class="follow">フォローする</a></th><th><button type="button" id="link-btn">このページのアカウントをシェアする</button></th></tr>';
            echo '</table>';
            
            echo '<table style="color: white;" align="center" class="table2"><tr><th>フォロワー',$follower_con,'人</th><th>フォロー中',$follow_con,'人</th></tr></table>';
            echo '<p style="color: white;" align="center">',$row['user_comment'],'</p>';
            }
            //6月13日
            //今日は土曜日にコードを書いた。
            //学マスのイベントをコツコツやっていたら一日が終わってしまった。
            //非常に怠惰な土曜日だった（　＾ω＾）・・・
            
            $sql2=$pdo->prepare('select * from post where user_id=?');
            $sql2->execute([$_SESSION['user-info']['suser_id']]);
    
            $count=0;
            echo '<table align="center">';
            echo '<tr>';
            foreach($sql2 as $row2){
                $count=$count+1;
                echo '<th><a href="http://aso2201135.namaste.jp/ogasawaraisland/post_detail.php?post_id=',$row2['post_id'],'"><img src="data:user_image/jpg;base64,'.base64_encode($row2['post_image']).'" style="width: 193px; height:130px;"/></a></th>';
                if($count==3){
                    echo '</tr>';
                    echo '<tr>';
                    $count=0;
                }
            }
            echo '</tr>';
            echo '</table>';

            $_SESSION['user-info']['suser_id']="";
        }else{
            //echo '<h1>フォローしてる</h1>';
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare('select * from post where user_id=?');
            //↓↓テスト用のアカウントの1を使用↓↓
            $sql->execute([$_SESSION['user-info']['suser_id']]);
            $num=$_SESSION['user-info']['suser_id'];
            //echo '<h1>',$num,'</h1>';
            //$post_con=count($sql);
            $post_con=0;
            foreach($sql as $row){
                $post_con=$post_con+1;
            }
    
            //フォロー中のカウント処理
            $sql=$pdo->prepare('select * from follow where user_id=?');
            $sql->execute([$num]);
            $follow_con=0;
            foreach($sql as $row){
                $follow_con=$follow_con+1;
            }

            /*
            　　　　　　 ＿＿
            　　　　　／＞　　フ
            　　　　　|  　_　_l
            　 　　　／` ミ＿xノ
            　　 　 /　　　 　|
            　　　 /　 ヽ　　 ﾉ
            　 　 │　　|　|　|
            　／￣|　　 |　|　|
            　| (￣ヽ＿_ヽ_)__)
            　＼二つ
            */
    
            //フォロワーのカウント処理
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
            //echo '<h1 style="color: white;">ヘッダー</h1>';
            //echo '<hr>';
            echo '<table style="color: white;" align="center" class="table1">';
            //$img="data:image/jpeg;base64,".$row['image'];
            echo '<tr><th><a href="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" data-lightbox="group"><img src="data:user_image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></a></th><th>',$row['user_name'],'</th><th>投稿',$post_con,'件</th>';
            
            //
            echo '<th><a href="follow-delete.php?user_id=',$row['user_id'],'&login_user=',$_SESSION['user-info']['user_id'],'"class="follow">フォローをやめる</a></th><th><button type="button" id="link-btn">このページのアカウントをシェアする</button></th></tr>';
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
                echo '<th><a href="http://aso2201135.namaste.jp/ogasawaraisland/post_detail.php?post_id=',$row2['post_id'],'"><img src="data:post_image/jpg;base64,'.base64_encode($row2['post_image']).'" style="width: 193px; height:130px;"/></a></th>';
                if($count==3){
                    echo '</tr>';
                    echo '<tr>';
                    $count=0;
                }
            }
            echo '</tr>';
            echo '</table>';

            $_SESSION['user-info']['suser_id']="";
        }
        //６月14日
        //今日は日曜日だった
        //明日は学校だと思っていたが祝日だった、嬉しい＼(^_^)／
        //コードも書き終わった．．．はず！
        //無駄なコメントとコードがありすぎて過去一見にくい。二度とコードに日記なんて書かない。
    }
    ?>
    <script>
        const link_btn = document.getElementById('link-btn');
        link_btn.addEventListener('click', async () => {
        try {
            await navigator.share({
            title:'<?php
                        echo $_SESSION['user-info']['user_name'],'さんのプロフィールです。ログインして見てみよう！';
                    ?> ', 
            text:'<?php
                        echo $_SESSION['user-info']['user_name'],'さんのプロフィールです。ログインして見てみよう！';
                ?>',
            url:<?php
                    echo '"http://aso2201135.namaste.jp/ogasawaraisland/slogin-insert.php?suser_id=',$_GET['user_id'],'"'; 
                ?>
            });
        } catch (error) {
            console.error(error);
        }
        });
    </script>    
</body>
</div>
</html>