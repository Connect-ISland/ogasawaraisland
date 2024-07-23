<?php session_start();?>
<?php require 'header.html'; ?>
<?PHP require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/search-output.css">
    <title>array</title>
</head>

<body>
    <script>
       function enter(){
         if( window.event.keyCode == 13 ){
            document.form1.submit();
        }
        }
    </script>

    <form name="formname" action="search-output.php" method="post">
        <div class="kensaku">
        <input type="text" name="keyword" style="width: 550px; height: 20px;" onkeypress="enter();"><br></div>
    </form>

    <?php
    $pdo=new PDO($connect, USER, PASS);
    $Height=0;
    $width=0;
    if(!empty($_POST["keyword"])) {
        $sql=$pdo->prepare("select * from user where user_name like ?");
        $sql->execute(['%'.$_POST["keyword"].'%']);
        $rows = $sql->fetchAll();
        
        if(!empty($rows)){
            foreach($rows as $row){
                echo '<div class="image"><img src="data:image/jpg;base64,'.base64_encode($row['user_image']).'" style="width: 80px; height:80px; border-radius:50%; position: absolute; top: '.($Height+250).'px; left: '.($width+280).'px;"/></div>';
                echo "<div class='name' style='position: absolute;font:size 30px; top: ".($Height+275)."px; left: ".($width+375)."px;'><a href='UserProfile2.php?user_id=".$row['user_id']."'>".$row["user_name"]."</a></div>";
                $Height=$Height+100;
                $width=$width+0;
            }
        }else{
            echo "<div class='nodeta'>データが１件もありません</div>";
        }

    } else {
        echo "<div class='nowado'>検索キーワードが指定されていません</div>";
    }
    
?>
</body>
</html>