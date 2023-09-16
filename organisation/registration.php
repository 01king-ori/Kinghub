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
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration</h2>
        <form action="" method="post" autocomplete="off">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter full name" required value="">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" placeholder="Enter address" required value="">
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
