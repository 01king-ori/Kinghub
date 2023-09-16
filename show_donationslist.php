<?php
require 'config.php'; // Include your database connection configuration

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

// Fetch donation records from the database
$query = "SELECT * FROM donationslist";
$result = mysqli_query($conn, $query);

// Check if there are any donations
if (mysqli_num_rows($result) > 0) {
    echo "<h2>List of Donations</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Donation</th><th>Date of Pickup</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["donation"] . "</td>";
        echo "<td>" . $row["date"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No donations found.</p>";
}

mysqli_close($conn);
?>
