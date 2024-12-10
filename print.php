<?php
include('connectdb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['print_certificate'])) {
    $id = $_POST['print_certificate'];
    $sql = "SELECT first_name_intern, last_name_intern, birthday_intern FROM intern WHERE id_intern = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('No intern found with the given ID.');</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
    exit();
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intern Certificate</title>
    <link rel="stylesheet" href="print.css">
</head>
<body>
    <div class="certificate">
        <img src="school.png" alt="Company Logo" class="logo">
        <h1>Certificate of Completion</h1>
        <p>This is to certify that</p>
        <h2><?php echo $row['first_name_intern'] . " " . $row['last_name_intern']; ?></h2>
        <p>has successfully completed the internship program.</p>
        <p>Date of Birth: <?php echo $row['birthday_intern']; ?></p>
        <p>Date: <?php echo date("Y-m-d"); ?></p>
    </div>
    <button onclick="window.print()">Print Certificate</button>
</body>
</html>