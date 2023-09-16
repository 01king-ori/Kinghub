<?php
require 'config.php';
//session_start();

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



$id = $_SESSION["id"];
$query = "SELECT * FROM tb_user WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/profile.css">

    <title>Profile</title>
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
    <h1>Profile Page</h1>
    <p>Welcome, <?php echo $user["name"]; ?></p>

    <!-- Display user data -->
    <ul>
        <li>Name: <?php echo $user["name"]; ?></li>
        <li>Username: <?php echo $user["username"]; ?></li>
        <li>Email: <?php echo $user["email"]; ?></li>
    </ul>

    <!-- Update Form -->
    <h2>Update Profile</h2>
    <form action="update_profile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $user["name"]; ?>" required><br>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $user["username"]; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $user["email"]; ?>" required><br>
        <input type="submit" name="update" value="Update">
    </form>

    <!-- Delete Profile -->
    <h2>Delete Profile</h2>
    <form action="delete_profile.php" method="post">
        <input type="submit" name="delete" value="Delete Profile">
    </form>

    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
