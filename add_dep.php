<?php
include("connectdb.php");
include('header.php');

  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }

if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $id_ad = $_SESSION['id_admin']; 

        $name_dep = $_POST["name_dep"];
        
        $sql = "INSERT INTO departement (id_admin, nam_depart) VALUES ('$id_ad', '$name_dep')";
        
            if ($conn->query($sql) === TRUE) {
            } else {
                $_SESSION['error'] = true;
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            }
        
    } else {
        if (isset($_SESSION['error'])) {
            echo "<script>alert('An error occurred while inserting the data. Please try again later.');</script>";
            unset($_SESSION['error']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
    <link rel="stylesheet" href="add_dep.css">
</head>
<body>
<div class="login-box">
    <div class="card-image"></div>
    <form action="" method="post">
        <div class="user-box">
            <input type="text" name="name_dep" id="name_dep" required>
            <label>Department Name</label>
        </div>
        <input type="submit" name="submit" value="Insert" class="insert">
    </form>
</div>
</body>
</html>