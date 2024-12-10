<?php
include('connectdb.php');
include('header.php');

  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_intern'])) {
    $id = $_POST['edit_intern'];

    $sql = "SELECT * FROM intern WHERE id_intern = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('No intern found with the given ID.');</script>";
        header("Location: all_intern.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_intern'])) {
    $id = $_POST['id_intern'];
    $first_name = $_POST['first_name_intern'];
    $last_name = $_POST['last_name_intern'];
    $birthday = $_POST['birthday_intern'];

    $sql_update = "UPDATE intern SET 
                    first_name_intern='$first_name', 
                    last_name_intern='$last_name', 
                    birthday_intern='$birthday'
                   WHERE id_intern=$id";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Intern updated successfully');</script>";
        header("Location: all_intern.php");
        exit();
    } else {
        echo "<script>alert('Error updating intern: " . mysqli_error($conn) . "');</script>";
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Intern</title>
    <link rel="stylesheet" href="update_intern.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="update-box">
        <h1 class="title" style="text-align:center;color:antiquewhite"><i class="fas fa-edit" ></i> Update Intern</h1><br>
        <form method="post" action="">
            <input type="hidden" name="id_intern" value="<?php echo $row['id_intern']; ?>">
            <div class="form-group">
                <input type="text" id="first_name_intern" name="first_name_intern" value="<?php echo $row['first_name_intern']; ?>" required>
                <label for="first_name_intern">First Name</label>
            </div>
            <div class="form-group">
                <input type="text" id="last_name_intern" name="last_name_intern" value="<?php echo $row['last_name_intern']; ?>" required>
                <label for="last_name_intern">Last Name</label>
            </div>
            <div class="form-group">
                <input type="date" id="birthday_intern" name="birthday_intern" value="<?php echo $row['birthday_intern']; ?>" required>
                <label for="birthday_intern">Birthday</label>
            </div>
            <button type="submit" class="btn btn-primary" name="update_intern">Update</button>
            <a href="all_intern.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>