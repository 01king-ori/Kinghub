<?php
require 'config.php';


if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM organization";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Profiles</title>
</head>
<body>
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
