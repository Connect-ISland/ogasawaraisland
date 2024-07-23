<?php session_start(); ?>
<?PHP require 'db-connect.php'; ?>
<?php require 'header.html'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="css/MyProfile_change_out.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php session_start(); ?>
<?PHP require 'db-connect.php'; ?>
<?php require 'header.html'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="css/MyProfile_change_out.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="refresh" content="0; url=https://aso2201135.namaste.jp/ogasawaraisland/MyProfile.php">
    <title>プロフィール編集</title>
</head>
<body>
<form
<?php
    $pdo=new PDO($connect, USER, PASS);
    $image = $_FILES['image']['tmp_name'];

    if(!empty($image)){
        $imgData = addslashes(file_get_contents($image));
        $sql=$pdo->prepare('update user set user_name=?,user_comment=? where user_id=?');
        $sql->execute([$_POST['user_name'],$_POST['comment'],$_SESSION['user-info']['user_id']]);
        $userid=$_SESSION['user-info']['user_id'];
        $pass=$_SESSION['user-info']['password'];
        $address=$_SESSION['user-info']['address'];
        $toroku=$_SESSION['user-info']['tourokubi'];
        $uimg=$_SESSION['user-info']['user_image'];

        $poid=$_SESSION['user-info']['user_id'];
        $sql="UPDATE user SET user_image='$imgData'where user_id='$poid'";
        $sql2=$pdo->prepare($sql);
        $sql2->execute();
        
        $_SESSION['user-info']=[
            'user_id'=>$userid,
            'user_name'=>$_POST['user_name'],
            'password'=>$pass,
            'address'=>$address,
            'tourokubi'=>$toroku,
            'user_image'=>$imgData,
            'user_comment'=>$_POST['comment'],
        ];
    }else{
        $sql=$pdo->prepare('update user set user_name=?,user_comment=? where user_id=?');
        $sql->execute([$_POST['user_name'],$_POST['comment'],$_SESSION['user-info']['user_id']]);
        $userid=$_SESSION['user-info']['user_id'];
        $pass=$_SESSION['user-info']['password'];
        $address=$_SESSION['user-info']['address'];
        $toroku=$_SESSION['user-info']['tourokubi'];
        $uimg=$_SESSION['user-info']['user_image'];
        
        $_SESSION['user-info']=[
            'user_id'=>$userid,
            'user_name'=>$_POST['user_name'],
            'password'=>$pass,
            'address'=>$address,
            'tourokubi'=>$toroku,
            'user_image'=>$uimg,
            'user_comment'=>$_POST['comment'],
        ];
    }
?>
</body>
</html>
    <title>プロフィール編集</title>
</head>
<body>
<form
<?php
    $pdo=new PDO($connect, USER, PASS);
    $image = $_FILES['image']['tmp_name'];

    if(!empty($image)){
        $imgData = addslashes(file_get_contents($image));
        $sql=$pdo->prepare('update user set user_name=?,user_comment=? where user_id=?');
        $sql->execute([$_POST['user_name'],$_POST['comment'],$_SESSION['user-info']['user_id']]);
        $userid=$_SESSION['user-info']['user_id'];
        $pass=$_SESSION['user-info']['password'];
        $address=$_SESSION['user-info']['address'];
        $toroku=$_SESSION['user-info']['tourokubi'];
        $uimg=$_SESSION['user-info']['user_image'];

        $poid=$_SESSION['user-info']['user_id'];
        $sql="UPDATE user SET user_image='$imgData'where user_id='$poid'";
        $sql2=$pdo->prepare($sql);
        $sql2->execute();
        
        $_SESSION['user-info']=[
            'user_id'=>$userid,
            'user_name'=>$_POST['user_name'],
            'password'=>$pass,
            'address'=>$address,
            'tourokubi'=>$toroku,
            'user_image'=>$imgData,
            'user_comment'=>$_POST['comment'],
        ];
    }else{
        $sql=$pdo->prepare('update user set user_name=?,user_comment=? where user_id=?');
        $sql->execute([$_POST['user_name'],$_POST['comment'],$_SESSION['user-info']['user_id']]);
        $userid=$_SESSION['user-info']['user_id'];
        $pass=$_SESSION['user-info']['password'];
        $address=$_SESSION['user-info']['address'];
        $toroku=$_SESSION['user-info']['tourokubi'];
        $uimg=$_SESSION['user-info']['user_image'];
        
        $_SESSION['user-info']=[
            'user_id'=>$userid,
            'user_name'=>$_POST['user_name'],
            'password'=>$pass,
            'address'=>$address,
            'tourokubi'=>$toroku,
            'user_image'=>$uimg,
            'user_comment'=>$_POST['comment'],
        ];
    }
?>
</body>
</html>