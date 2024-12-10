<?php
include("connectdb.php");
include('header.php');

  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }

$interns = [];
$intern_sql = "SELECT id_intern, first_name_intern, last_name_intern FROM intern";
$intern_result = mysqli_query($conn, $intern_sql);
if (mysqli_num_rows($intern_result) > 0) {
    while ($row = mysqli_fetch_assoc($intern_result)) {
        $interns[] = $row;
    }
}

$departments = [];
$department_sql = "SELECT id_depart, nam_depart FROM departement";
$department_result = mysqli_query($conn, $department_sql);
if (mysqli_num_rows($department_result) > 0) {
    while ($row = mysqli_fetch_assoc($department_result)) {
        $departments[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $intern_id = $_POST["intern_id"];
    $department_id = $_POST["department_id"];
    $start_intern = $_POST["start_date"];
    $end_intern = $_POST["end_date"];
    
    $id_admin = $_SESSION['id_admin']; 
    
    $stmt = mysqli_prepare($conn, "INSERT INTO internship (id_intern, id_admin, id_depart, start_intern, end_intern) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iiiss", $intern_id, $id_admin, $department_id, $start_intern, $end_intern);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Internship assigned successfully');</script>";
    } else {
        echo "<script>alert('Error assigning internship: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assign Internship</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="internship.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <h2>Assign Internship</h2>
        <form method="post">
            <div class="form-group">
                <label for="intern_select">Select Intern:</label>
                <select name="intern_id" id="intern_select" required>
                    <option value="">Choose Intern</option>
                    <?php foreach ($interns as $intern): ?>
                        <option value="<?php echo $intern['id_intern']; ?>"><?php echo "{$intern['id_intern']} - {$intern['first_name_intern']} {$intern['last_name_intern']}"; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="department_select">Select Department:</label>
                <select name="department_id" id="department_select" required>
                    <option value="">Choose Department</option>
                    <?php foreach ($departments as $department): ?>
                        <option value="<?php echo $department['id_depart']; ?>"><?php echo $department['nam_depart']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" required>
            </div>

            <button type="submit" name="submit">Assign Internship</button>
        </form>
    </div>
</body>
</html>