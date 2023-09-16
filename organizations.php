<?php
require 'config.php';


if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}
$menuItems = array(
    "List of Organizations" => "organizations.php", 
    "Newsletters" => "newsletters.php", 
    "How We Work" => "how_we_work.php", 
    "Contact Us" => "contact_us.php",
    "Profile"  => "profile.php",
    "Donate" =>  "donationslist.php"
);



$query = "SELECT * FROM organization";
$result = mysqli_query($conn, $query);

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
    <title>Organization Profiles</title>
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
    <h1>Organization Profiles</h1>
    
    <p>Welcome, </p>

    <?php
    // Loop through the organization profiles
    while ($org = mysqli_fetch_assoc($result)) {
    ?>

    <h2>Profile for <?php echo $org["name"]; ?></h2>
    <ul>
        <li>Name: <?php echo $org["name"]; ?></li>
        <li>Address: <?php echo $org["address"]; ?></li>
        <li>Email: <?php echo $org["email"]; ?></li>
    </ul>

    <?php
    }
    ?>

    <!-- Logout -->
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
