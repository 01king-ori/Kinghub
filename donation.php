<?php
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

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
</head>
<body>
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
    <a href="logout.php">Logout</a>
</body>
</html>
