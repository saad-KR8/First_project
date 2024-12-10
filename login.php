<?php 
    include("connectdb.php"); 
    session_start(); 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql ="select * from admin where nom_admin = '$username' and pass_admin = '$password'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        $remember=$_POST['rememberme'];

        if($count == 1){
            if(isset($remember)){
                setcookie('username',$username,time()+24*3600,'/');
                setcookie('password',$password,time()+24*3600,'/');
            }
            $_SESSION['username'] = $username;
            $_SESSION['id_admin'] = $row['id_admin'];
        
            header("location:home.php");
        }else{
            echo '<script>
            window.location.href = "index.php";
            alert("login failed. Invalid username/password")
            </script>';
        }
    }
?>