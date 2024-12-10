<?php
include('connectdb.php');
include('header.php');

  if(!isset($_SESSION['id_admin'] )){
    header("location:index.php");
  }
$_SESSION['username'] = $username;
$department_id = isset($_GET['department_id']) ? (int)$_GET['department_id'] : 0;
$interns = [];
$department_name = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_intern'])) {
    $intern_id = (int)$_POST['delete_intern'];

    $sql_delete = "DELETE FROM internship WHERE id_intern = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param('i', $intern_id);
    $stmt_delete->execute();
    $stmt_delete->close();
}

if ($department_id > 0) {
    $sql_department = "SELECT nam_depart FROM departement WHERE id_depart = ?";
    $stmt_department = $conn->prepare($sql_department);
    $stmt_department->bind_param('i', $department_id);
    $stmt_department->execute();
    $result_department = $stmt_department->get_result();
    if ($result_department->num_rows > 0) {
        $department_name = $result_department->fetch_assoc()['nam_depart'];
    }
    $stmt_department->close();

    $sql_interns = "SELECT intern.*, internship.start_intern, internship.end_intern 
                    FROM intern
                    JOIN internship ON intern.id_intern = internship.id_intern
                    JOIN departement ON internship.id_depart = departement.id_depart
                    WHERE departement.id_depart = ?";
    
    $stmt_interns = $conn->prepare($sql_interns);
    $stmt_interns->bind_param('i', $department_id);
    $stmt_interns->execute();
    $result_interns = $stmt_interns->get_result();

    if ($result_interns->num_rows > 0) {
        while ($row = $result_interns->fetch_assoc()) {
            $interns[] = $row;
        }
    }
    $stmt_interns->close();
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interns by Department</title>
    <link rel="stylesheet" href="all_intern.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="margin: 0 20px 0 20px;">
    <h1 class="title"><i class="fas fa-list"></i> Interns in <?php echo $department_name; ?></h1><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Admin</th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthday</th>
                <th>Start Intern</th>
                <th>End Intern</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            if (!empty($interns)) {
                foreach ($interns as $row) {
                    echo "<tr>
                            <td>". $_SESSION['username'] ."</td>
                            <td>". $row["id_intern"]."</td>
                            <td>". $row["first_name_intern"]."</td>
                            <td>". $row["last_name_intern"]."</td>
                            <td>". $row["birthday_intern"]."</td>
                            <td>". $row["start_intern"]."</td>
                            <td>". $row["end_intern"]."</td>
                            <td>
                                <form method='post' action='' onsubmit='return confirmDelete()' style='display: inline;'>
                                    <input type='hidden' name='delete_intern' value='". $row["id_intern"]."'>
                                    <button type='submit' class='btn btn-danger btn-sm'><i class=\"fas fa-trash\"></i> Delete</button>
                                </form>
                                <a href='edit_internship.php?id_intern=". $row["id_intern"] ."' class='btn btn-primary btn-sm'><i class=\"fas fa-edit\"></i> Update</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No interns found for this department</td></tr>";
            }
        ?>
        </tbody>
    </table>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this intern?');
        }
    </script>
</body>
</html>
