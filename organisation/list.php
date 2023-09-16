<?php
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

$menuItems = array(
    "Donation Form" => "donation.php", 
    "About" => "about.php", 
    "Portfolio" => "portfolio.php", 
    
    "List of donations" => "list.php",
    "Profile"  => "profile.php"
);


// Fetch donation records from the "donations" table
$query = "SELECT * FROM donations";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Donations</title>
    <style>
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
            
    
    
</head>
<body>
<header>
    <ul class="navbar">
        <?php
        
        // Loop through the menu items and display them as links
        foreach ($menuItems as $menuItem => $url) {
            echo "<li><a href='$url'>$menuItem</a></li>";
        }
        ?>
    </ul>
    </header>
    <h2>View Donation Records</h2>
    
    <table >
        <tr>
            <th>Foodstuffs</th>
            <th>Clothes</th>
            <th>Money</th>
            <th>Date Required</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["foodstuffs"] . "</td>";
            echo "<td>" . $row["clothes"] . "</td>";
            echo "<td>" . $row["money"] . "</td>";
            echo "<td>" . $row["date_required"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    
</body>
</html>
