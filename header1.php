<?php
session_start(); 
$username = $_SESSION['username'];
  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK8</title>
    <link rel="stylesheet" href="header.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
    <a class="logo" href="#"><img src="school.png" alt="SK8 SCHOOL Logo"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="deaprtment.php"><i class="fa fa-building"></i> Departments</a></li>
                <li><a href="intern.php"><i class="fas fa-users"></i> Intern</a></li>
                <li><a href="internship.php"><i class="fa fa-address-card"></i> Intership</a></li>
                <li><a href="#" class="user"><i class="fa fa-user"></i> <?php echo "Hello {$username}";?></a></li>
            </ul>
        </nav>
        <a class="cta" href="logout.php">Log out  <i class="fas fas fa-sign-out-alt"></i> </a>
    </header>
</body>
</html>
