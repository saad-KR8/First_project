<?php
include("connectdb.php");
include('header.php');

  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
    <link rel="stylesheet" href="intern.css">
</head>

<body>
  <section class="container">
       <div class="card" onclick="location.href='add_intern.php';">
          <div class="card-image  car-1"></div>
            <p>Here you can add an Intern !</p>
            
       </div>
       <div class="card" onclick="location.href='all_intern.php';">
          <div class="card-image car-2"></div>
            <p>Here you can see all of the Interns !</p>
       </div>
  </section>
</body>

</html>