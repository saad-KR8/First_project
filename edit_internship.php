<?php
include('connectdb.php');
include('header.php');

  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }

$intern_id = isset($_GET['id_intern']) ? (int)$_GET['id_intern'] : 0;
$departments = [];
$intern = null;

if ($intern_id > 0) {
    $sql_intern = "SELECT * FROM internship WHERE id_intern = ?";
    $stmt_intern = $conn->prepare($sql_intern);
    $stmt_intern->bind_param('i', $intern_id);
    $stmt_intern->execute();
    $result_intern = $stmt_intern->get_result();
    if ($result_intern->num_rows > 0) {
        $intern = $result_intern->fetch_assoc();
    }
    $stmt_intern->close();

    $sql_departments = "SELECT id_depart, nam_depart FROM departement";
    $result_departments = $conn->query($sql_departments);
    if ($result_departments->num_rows > 0) {
        while ($row = $result_departments->fetch_assoc()) {
            $departments[] = $row;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id_depart = (int)$_POST['id_depart'];
    $start_intern = $_POST['start_intern'];
    $end_intern = $_POST['end_intern'];

    $sql_update = "UPDATE internship SET id_depart = ?, start_intern = ?, end_intern = ? WHERE id_intern = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('issi', $id_depart, $start_intern, $end_intern, $intern_id);

    if ($stmt_update->execute()) {
        echo "<script>alert('Internship updated successfully');</script>";
        echo "<script>window.location.href = 'alldep.php?department_id=" . $id_depart . "';</script>";
    } else {
        echo "<script>alert('Error updating internship: " . $stmt_update->error . "');</script>";
    }

    $stmt_update->close();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Internship</title>
    <link rel="stylesheet" href="edit_internship.css">
</head>
<body>
<div class="login-box">
    <?php if ($intern): ?>
    <form action="" method="post">
        <div class="user-box">
            <label for="id_depart" class="dep">Department</label>
            <select name="id_depart" id="id_depart" required>
                <?php foreach ($departments as $department): ?>
                <option value="<?php echo $department['id_depart']; ?>" <?php echo $department['id_depart'] == $intern['id_depart'] ? 'selected' : ''; ?>>
                    <?php echo $department['nam_depart']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="user-box">
            <input type="date" name="start_intern" value="<?php echo $intern['start_intern']; ?>" required>
            <label>Start Date</label>
        </div>
        <div class="user-box">
            <input type="date" name="end_intern" value="<?php echo $intern['end_intern']; ?>" required>
            <label>End Date</label>
        </div>
        <input type="hidden" name="id_intern" value="<?php echo $intern_id; ?>">
        <input type="submit" name="submit" value="Update" class="insert">
    </form>
    <?php endif; ?>
</div>
</body>
</html>
