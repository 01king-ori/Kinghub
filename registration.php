<?php
require "config.php";
 // Start a session

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $duplicate = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username' OR email ='$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Username or Email has already been taken');</script>";
    } else {
        if ($password == $confirmpassword) {
            // Use prepared statements to insert data securely
            //$query = "INSERT INTO tb_user (name, username, email, password) VALUES (?, ?, ?, ?)";
            $query = "INSERT INTO tb_user (name, username, email, password) VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $query);
            if (!$stmt) {
                die("Prepared statement failed: " . mysqli_error($conn));
            }
            
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $password);
            
            // Execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION["logged_in"] = true; // Set a session variable to indicate the user is logged in
                $_SESSION["id"] = mysqli_insert_id($conn); // Store the user's ID
                header("Location: index.php"); // Redirect to the index page
                exit(); // Add exit to prevent further script execution
                // echo "<script>alert('Registration successful'); window.location = 'index.php';</script>"; // Redirect to index.php
                exit(); // Add exit to prevent further script execution
            } else {
                echo "Error: " . mysqli_stmt_error($stmt); // Display SQL error;
            }
            
            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Password does not match');</script>";
        }
    
            
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
   <h2>Registration</h2>
   <form class="" action="" method="post" autocomplete="off" >
    <label for="name">Name :</label>
    <input type="text" name="name" id="name" required value=""><br>
    <label for="username">Username :</label>
    <input type="text" name="username" id="username" required value=""><br>
     <label for="email">Email :</label>
    <input type="email" name="email" id="email" required value=""><br>
    <label for="password">Password :</label>
    <input type="password" name="password" id="password" required value=""><br>
    <label for="confirmpassword">Confirm Password :</label>
    <input type="password" name="confirmpassword" id="confirmpassword" required value=""><br>
   <button type="submit" name="submit">Register</button>
</form>
<br>
<a href="login.php">Login</a>
</body>
</html>
