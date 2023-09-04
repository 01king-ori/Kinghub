<?php
require "config.php";

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    // Check if the form fields are not empty
    if (empty($name) || empty($address) || empty($email) || empty($password) || empty($confirmpassword)) {
        echo "<script>alert('Please fill in all fields');</script>";
    } else {
        $duplicate = mysqli_query($conn, "SELECT * FROM organization WHERE name = '$name' OR email ='$email'");
        
        if (!$duplicate) {
            die("Query failed: " . mysqli_error($conn)); // Display the error message
        }

        if (mysqli_num_rows($duplicate) > 0) {
            echo "<script>alert('Name or Email has already been taken');</script>";
        } else {
            if ($password == $confirmpassword) {
                $query = "INSERT INTO organization (name, address, email, password) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query);

                if (!$stmt) {
                    die("Prepared statement failed: " . mysqli_error($conn)); // Display the error message
                }
                
                mysqli_stmt_bind_param($stmt, "ssss", $name, $address, $email, $password);
                
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION["logged_in"] = true;
                    $_SESSION["id"] = mysqli_insert_id($conn);
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: " . mysqli_stmt_error($stmt); // Display the error message
                }
                
                mysqli_stmt_close($stmt);
            } else {
                echo "<script>alert('Password does not match');</script>";
            }
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
    <label for="address">Address :</label>
    <input type="text" name="address" id="address" required value=""><br>
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
