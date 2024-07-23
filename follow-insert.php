<?php session_start();?>
<?php require 'db-connect.php'; ?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="0;url=http://aso2201135.namaste.jp/ogasawaraisland/UserProfile2.php?user_id=<?php echo $_GET['user_id']; ?> ">
    <title>profile</title>
</head>
<body>
<?php
  $pdo=new PDO($connect, USER, PASS);
  $sql=$pdo->prepare('insert into follow values(?,?)');
  $sql->execute($arry=[$_GET['login_user'],$_GET['user_id']]);
  echo '<p><a href="UserProfile.php>戻る</a></p>';
?>
</body>
</html>