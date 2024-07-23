<?php require 'db-connect.php'; ?>
<?php session_start(); ?>
<?php 
    $pdo=new PDO($connect, USER, PASS);
    if(isset($_SESSION['user-info'])){
        if(isset($_POST['comment'])){
            $sql=$pdo->prepare('insert into comment values (null,?,?,?,?)');
            $sql->execute([$_POST['post_id'], $_SESSION['user-info']['user_id'], $_POST['comment'], date("Y/m/d")]);
            header('Location: post.php?post_id='.$_POST['post_id']);
            exit;
        }
    }
?>
