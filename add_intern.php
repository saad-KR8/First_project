<?php
include("connectdb.php");
include('header.php');

  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }

if (isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $birthd= $_POST["birthday"];

        $sql = "INSERT INTO intern (first_name_intern, last_name_intern, birthday_intern) 
        VALUES ('$first_name', '$last_name', '$birthd')";


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
    <link rel="stylesheet" href="add_intern.css">
</head>
<body>
<div class="login-box">
    <form action="" method="post">
        <div class="user-box">
            <input type="text" name="first_name" id="first_name" required>
            <label>Intern first name </label>
        </div>
        <div class="user-box">
            <input type="text" name="last_name" id="last_name" required>
            <label>Intern last name</label>
        </div>
        <div class="date">
    <label>birthday</label>
    <input type="date" name="birthday" id="birthday" required>
     </div>

        <input type="submit" name="submit" value="Insert" class="insert">
    </form>
</div>
</body>
</html>