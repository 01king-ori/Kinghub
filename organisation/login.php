<?php
 
 require 'config.php';
 if (!empty($_SESSION["id"])) {
    # code...
    header("Location: index.php");
}
if(isset($_POST["submit"])){
  $usernameemail = $_POST["usernameemail"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM organization WHERE  name='$usernameemail' OR email='$usernameemail'");
  $row = mysqli_fetch_assoc($result);
  
  if (mysqli_num_rows($result) > 0) {
      if ($password == $row["password"]) {
          $_SESSION["logged_in"] = true;
          $_SESSION["id"] = $row["id"];
          echo  "<script> alert('Login successfull'); </script>";
          header("Location: index.php");
          exit(); // Add exit to prevent further script execution
      } else {
          echo "<script> alert('Password is not correct'); </script>";
      }  
  } else {
      echo "<script> alert('name is not registered'); </script>";
  }
}?>
 <!DOCTYPE html>
 <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Login</title>
    
</head>
<body>
<div class="wrapper">
    <h1>Login</h1>
    <form class="" action=""  method="post" autocomplete="off">
      <div class="input-box">
       
        <input type="text" name="usernameemail" id="usernameemail" placeholder="Enter name or email" required value="">
       <i class='bx bxs-user'></i>
</div>
<div class="input-box">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter password" required value="">
        <i class='bx bxs-lock-alt'></i>
</div>
        <button type="submit" class="button" name="submit">Login</button>
        <div class="register-link">
<a href="registration.php">Don't have an account </a>
</div>


</form>
</div>
<br>
</body>
</html>