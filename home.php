<?php
  include('header.php');
  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }
?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SK_8</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css">
    </head>
<body>
    <div class="dive">
      <h1>DIVE INTO LEARNING</h1>
      <h4>Let the learning be your friend</h4>
    </div>
</body>
</html>