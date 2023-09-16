<?php

require 'config.php'; // Include your database connection configuration

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
} 
if (empty($date)) {
    $date = date("Y-m-d"); // Current date in YYYY-MM-DD format
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $donation = $_POST["donation"];
    $date = $_POST["date"];

    // Insert data into the "donationslist" table
    $query = "INSERT INTO donationslist (name, email, phone, address, donation, date) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $phone, $address, $donation, $date);
        if (mysqli_stmt_execute($stmt)) {
            echo "<p>Donation request submitted successfully.</p>";
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<p>Prepared statement failed.</p>";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
</head>
<body>
    <h2>Donate</h2>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="phone">Phone:</label>
        <input type="tel" name="phone" id="phone" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required><br>

        <label for="donation">Donation:</label>
        <input type="text" name="donation" id="donation"  required><br>

        <label for="date">Date of Pickup:</label>
        <input type="date" name="date" id="date" required><br>

        <button type="submit">Submit Donation</button>
    </form>

    <br>
    <a href="donationslist.php">View Donations List</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>
