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
    <title>Login</title>
    
</head>
<body>
    <h2>Login</h2>
    <form class="" action=""  method="post" autocomplete="off">
        <label for="usernameemail">Username or email</label>
        <input type="text" name="usernameemail" id="usernameemail" required value="">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required value="">
        <button type="submit" name="submit">Login</button>

</form>
<br>
<a href="registration.php">Don't have an account </a>
</body>
</html>