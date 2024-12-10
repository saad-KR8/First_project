<?php
  include("connectdb.php");
  session_start();
  if(isset($_SESSION['id_admin'] )){
    header("location:home.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <script type="text/javascript">
    function preventBack(){window.history.forward()};
    setTimeout("preventBack()",0);
    window.onunload = function(){null};
  </script>
</head>
<header>
<h1 class="ll">Log In</h1></header>
<body class="align">

  <div class="grid">

    <form action="login.php" method="POST" class="form login">

      <div class="form__field">
        <label for="login__username"><i class="fas fa-user"></i><span class="hidden">Username</span></label>
        <input id="login_username" type="text" name="username" class="form_input" placeholder="Username" required>
      </div>

      <div class="form__field">
        <label for="login__password"><i class="fas fa-lock"></i><span class="hidden">Password</span></label>
        <input id="login_password" type="Password" name="password" class="form_input" placeholder="Password" required>
      </div>
      
      <div class="form__field">
        <input type="submit" name="submit" value="Login">
      </div>
      <div class="form__field">
        <input type="checkbox" name="rememberme" id="remembercheck">
        <label for="remembercheck">Remember me</label>
      </div>   
    </form>
  </div>
</body>
</html>