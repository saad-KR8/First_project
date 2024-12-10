<?php 
  $db_server = "localhost";
  $db_user = "root";
  $db_pass =  "";
  $db_name = "gestion";
  $conn = mysqli_connect($db_server,$db_user,$db_pass,$db_name,3307);
  if($conn -> connect_error){
    die("connection failed".$conn->connect_error);
  }
  
?>