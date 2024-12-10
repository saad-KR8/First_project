<?php 
include('connectdb.php');
include('header.php');

$allintern = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_intern'])) {
    $id = $_POST['delete_intern'];
    $sql_delete_internship = "DELETE FROM internship WHERE id_intern = $id";
    if (mysqli_query($conn, $sql_delete_internship)) {
        $sql_delete_intern = "DELETE FROM intern WHERE id_intern = $id";
        if (mysqli_query($conn, $sql_delete_intern)) {
            echo "<script>alert('Row deleted successfully');</script>";
            header("Refresh:0");
        } else {
            echo "<script>alert('Error deleting the row: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Error deleting related rows from internship table: " . mysqli_error($conn) . "');</script>";
    }
}

$sql = "
    SELECT 
        intern.id_intern, 
        intern.first_name_intern, 
        intern.last_name_intern, 
        intern.birthday_intern
    FROM intern
"; 

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $allintern[] = $row;
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Intern</title>
    <link rel="stylesheet" href="all_intern.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="margin: 0 20px 0 20px;">
    <h1 class="title"><i class="fas fa-list"></i> List of Interns</h1><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Birthday</th>
                <th style="width: 400px;">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($allintern)) {
            foreach ($allintern as $row) {
                echo "<tr>
                        <td>". $row["id_intern"]."</td>
                        <td>". $row["first_name_intern"]."</td>
                        <td>". $row["last_name_intern"]."</td>
                        <td>". $row["birthday_intern"]."</td>
                        <td>
                            <div class='btn-group'>
                                <form method='post' action='update_intern.php'>
                                    <input type='hidden' name='edit_intern' value='". $row["id_intern"]."'>
                                    <button type='submit' class='btn btn-success btn-sm'><i class=\"fas fa-edit\"></i> Update</button>
                                </form>
                                <form method='post' action='' onsubmit='return confirmDelete()'>
                                    <input type='hidden' name='delete_intern' value='". $row["id_intern"]."'>
                                    <button type='submit' class='btn btn-danger btn-sm'><i class=\"fas fa-trash\"></i> Delete</button>
                                </form>
                                <form method='post' action='print.php' target='_blank'>
                                    <input type='hidden' name='print_certificate' value='". $row["id_intern"]."'>
                                    <button type='submit' class='btn btn-primary btn-sm'><i class=\"fas fa-print\"></i> Print Certificate</button>
                                </form>
                            </div>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>No interns found </td></tr>";
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