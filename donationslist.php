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
$menuItems = array(
    "List of Organizations" => "organizations.php", 
    "Newsletters" => "newsletters.php", 
    "How We Work" => "how_we_work.php", 
    "Contact Us" => "contact_us.php",
    "Profile"  => "profile.php",
    "Donate" =>  "donationslist.php"
);



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
<style>
        /* Add the CSS styles for the navbar */
        ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            background-color: #333; /* Background color of the navbar */
            overflow: hidden;
        }

        ul.navbar li {
            float: left;
        }

        ul.navbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.navbar li a:hover {
            background-color: #ddd; /* Background color of navbar items on hover */
            color: black;
        }

        /* Style for the logout button */
        #logout {
            background-color: aqua;
            float: right;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
</head>
<body>

    <h2>Donate</h2>
    <ul class="navbar">
        <?php
        
        // Loop through the menu items and display them as links
        foreach ($menuItems as $menuItem => $url) {
            echo "<li><a href='$url'>$menuItem</a></li>";
        }
        ?>
    </ul>
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
    <a href="show_donationslist.php">View Donations List</a><br>
    <a href="logout.php">Logout</a>
</body>
</html>
