<?php session_start();?>
<?php require 'db-connect.php';?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="0;url=https://aso2201135.namaste.jp/ogasawaraisland/UserProfile2.php">
    <title>login</title>
</head>
<body>
    <?php
    unset($_SESSION['user-info']);
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('select*from user where user_name=? and address=? and password=?');
    $sql->execute([$_POST['user_name'],$_POST['mail'],$_POST['password']]);
    foreach($sql as $row){
        $_SESSION['user-info']=[
            'user_id'=>$row['user_id'],
            'user_name'=>$row['user_name'],
            'password'=>$row['password'],
            'address'=>$row['address'],
            'tourokubi'=>$row['tourokubi'],
            'user_image'=>$row['user_image'],
            'user_comment'=>$row['user_comment'],
            'suser_id'=>$_POST['suser_id']
        ];
    }
    if(isset($_SESSION['user-info'])){
        echo 'ログイン完了<br>';
        echo $_SESSION['user-info']['user_name'],'さん。<br>';
        echo $_SESSION['user-info']['suser_id'],'IDや';
    }else{
        echo '<form action="login-insert.php" method="post">';
        echo 'ログイン名またはメールアドレスまたはパスワードが違います。';
        echo '<input type="submit"  value="ログイン画面へ" class="button">';
        echo '</form>';
    }
    ?>
</body>
</html>