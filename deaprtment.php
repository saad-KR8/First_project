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
    <link rel="stylesheet" href="department.css">
</head>

<body>
  <section class="container">
       <div class="card" onclick="location.href='add_dep.php';">
          <div class="card-image  car-1"></div>
            <p>Here you can add department !</p>
            
       </div>
       <div class="card" onclick="location.href='alldep.php';">
          <div class="card-image car-2"></div>
            <p>Here you can see all of the departement !</p>
       </div>
  </section>
</body>

</html>