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
    <link rel="stylesheet" type="text/css" href="css/reg.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration</h2>
        <form action="" method="post" autocomplete="off">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter full name" required value="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Enter username" required value="">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required value="">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required value="">
            <label for="confirmpassword">Confirm Password:</label>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm password" required value="">
            <button type="submit" name="submit">Register</button>
        </form>
        <a href="login.php">Already have an account? Login</a>
    </div>
</body>
</html>
