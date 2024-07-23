<?php require 'db-connect.php'; ?>
<?php session_start(); ?>
<?php 
    $pdo=new PDO($connect, USER, PASS);
    $sql0 = $pdo->prepare('select * from post where post_id=?');
    $sql0->execute([$_POST['post_id']]);
    if(isset($_SESSION['user-info'])){
        $sql1 = $pdo->prepare('delete from comment where post_id=?');
        $sql1->execute([$_POST['post_id']]);
        $sql2 = $pdo->prepare('delete from post where post_id=?');
        $sql2->execute([$_POST['post_id']]);
        foreach($sql0 as $row){
            header('Location: homu.php');
            exit;
        }
    }
?>
