<?php
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST["submit"])) {
    $foodstuffs = $_POST["foodstuffs"];
    $clothes = $_POST["clothes"];
    $money = $_POST["money"];
    $date_required = $_POST["date_required"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    // Create a new record in the "donations" table
    $query = "INSERT INTO donations (foodstuffs, clothes, money, date_required, address, phone, email)
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die("Prepared statement failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $foodstuffs, $clothes, $money, $date_required, $address, $phone, $email);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Donation request submitted successfully');</script>";
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
}
$menuItems = array(
    "Donation Form" => "donation.php", 
    "About" => "about.php", 
    "Portfolio" => "portfolio.php", 
    "Chats" => "chats.php",
    "List of donations" => "list.php",
    "Profile"  => "profile.php"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Donation Request</title>
</head>
<body>
<ul class="navbar">
        <?php
        
        // Loop through the menu items and display them as links
        foreach ($menuItems as $menuItem => $url) {
            echo "<li><a href='$url'>$menuItem</a></li>";
        }
        ?>
    </ul>
    <h2>Donation Request Form</h2>
    <form action="" method="post" autocomplete="off">
        <label for="foodstuffs">Foodstuffs:</label>
        <input type="text" name="foodstuffs" id="foodstuffs" required><br>

        <label for="clothes">Clothes:</label>
        <input type="text" name="clothes" id="clothes" required><br>

        <label for="money">Money:</label>
        <input type="text" name="money" id="money" required><br>

        <label for="date_required">Date Required:</label>
        <input type="date" name="date_required" id="date_required" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" required><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <button type="submit" name="submit">Submit Request</button>
    </form>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
