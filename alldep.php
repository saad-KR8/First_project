<?php
include('header.php');
include('connectdb.php');

  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_department'])) {
    $id = $_POST['delete_department'];
    
    $sql_delete_internship = "DELETE FROM internship WHERE id_depart = $id";
    if (mysqli_query($conn, $sql_delete_internship)) {
        $sql_delete_department = "DELETE FROM departement WHERE id_depart = $id";
        if (mysqli_query($conn, $sql_delete_department)) {
            echo "<script>alert('Department deleted successfully');</script>";
            header("Refresh:0");
        } else {
            echo "<script>alert('Error deleting department: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error deleting related rows from internship table: " . mysqli_error($conn) . "');</script>";
    }
}

$sql = "SELECT * FROM departement"; 
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $allDepartments = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $allDepartments[] = $row;
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SK_8</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="alldep.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <?php if(isset($allDepartments) && !empty($allDepartments)): ?>
            <?php foreach ($allDepartments as $department): ?>
                <div class="department-box">
                    <div class="department-name" onclick="location.href='interndep.php?department_id=<?php echo $department['id_depart']; ?>';">
                        <i class="fas fa-building"></i><?php echo " {$department['nam_depart']}"; ?>
                    </div>
                    <div class="department-options">
                        <div class="department-option1">
                            <button type="submit" class="department-option1" onclick="location.href='edit.php?id_depart=<?php echo $department['id_depart']; ?>';"><i class="fas fa-edit custom-edit-icon"></i>EDIT</button>
                        </div>
                        <form method="post" onsubmit="return confirm('Are you sure you want to delete this department?');">
                            <input type="hidden" name="delete_department" value="<?php echo $department['id_depart']; ?>">
                            <button type="submit" class="department-option2"><i class="fas fa-trash  custom-trash-icon"></i>DELETE</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this department?");
        }
    </script>
</body>
</html>
