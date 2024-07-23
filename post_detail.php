<?php session_start(); ?>
<?PHP require 'db-connect.php'; ?>
<?php require 'header.html'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/MyProfile_change.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post_detail</title>
</head>
<body>
    <?php
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from post where post_id=?');
    $sql->execute([$_GET['post_id']]);

    foreach($sql as $row){
        $sql2=$pdo->prepare('select * from user where user_id=?');
        $sql2->execute([$row['user_id']]);
        echo '<table>';
        echo '<tr>';
        foreach($sql2 as $row2){
            echo '<td><img src="data:user_image/jpg;base64,'.base64_encode($row2['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></td>';
        }
        echo '<td><h2 style="color: white;">',$row['post'],'</h2></td>';
        echo '</tr>';
        echo '</table>';
        echo '<center><img src="data:post_image/jpg;base64,'.base64_encode($row['post_image']).'" style="width: auto; height: 500px;"/></center>';
    }
    echo '<hr>';
    
    $sql=$pdo->prepare('select * from comment where post_id=?');
    $sql->execute([$_GET['post_id']]);
    echo '<table>';
    foreach($sql as $row){
        echo '<tr>';
        $sql2=$pdo->prepare('select * from user where user_id=?');
        $sql2->execute([$row['user_id']]);
        foreach($sql2 as $row2){
            echo '<td><img src="data:user_image/jpg;base64,'.base64_encode($row2['user_image']).'" style="width: 80px; height:80px; border-radius:50%"/></td>';
        }
        echo '<td><p style="color: white;">',$row['comment'],'<p></td></tr>';
    }
    echo '</table>';
    ?>
</body>
</html>