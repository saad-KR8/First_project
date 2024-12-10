<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout(preventBack, 0);
    </script>
</head>
<body>
    <script type="text/javascript">
        setTimeout(function () {
            window.location.href = 'index.php';
        }, 0); 
    </script>
</body>
</html>
