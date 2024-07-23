<?php require 'db-connect.php'; ?>
<?php session_start(); ?>
<?php 
    $pdo=new PDO($connect, USER, PASS);
    $sql1=$pdo->prepare('select * from post where post_id=?');
    $sql1->execute([$_POST['post_id']]);
    if(isset($_SESSION['user-info'])){
        if(isset($_POST['comment']) && is_array($_POST['comment'])){
            foreach($_POST['comment'] as $c){
                $sql2 = $pdo->prepare('delete from comment where comment_id=?');
                $sql2->execute([$c]);
            }
        }
        foreach($sql1 as $row){
            header('Location: post.php?post_id='.$row['post_id']);
            exit;
        }
    }
?>
