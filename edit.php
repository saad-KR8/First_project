<?php
include("connectdb.php");
include('header.php');

  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $newName = $_POST['name_dep'];
    $departmentId = $_POST['id_depart'];

    $sql = "UPDATE departement SET nam_depart = '$newName' WHERE id_depart = $departmentId"; 
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Department name updated successfully');</script>";
        echo "<script>window.location.href = 'alldep.php';</script>"; 
    } else {
        echo "<script>alert('Error updating department name: " . mysqli_error($conn) . "');</script>";
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
    <form action="" method="post">
        <div class="user-box">
            <input type="text" name="name_dep" id="id_dep" required>
            <label>New department name</label>
        </div>
        <input type="hidden" name="id_depart" value="<?php echo $_GET['id_depart']; ?>">
        <input type="submit" name="submit" value="Insert" class="insert">
    </form>
</div>
</body>
</html>