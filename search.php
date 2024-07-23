<?php session_start();?>
<?php require 'header.html'; ?>
<?PHP require 'db-connect.php'; ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/search.css">
    <title>Document</title>
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
</body>
</html>