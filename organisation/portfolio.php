<?php

require 'config.php';

if (!empty($_SESSION["id"])) {
    # code...
    $id = $_SESSION["id"];
   $result = mysqli_query($conn, "SELECT * FROM organization WHERE id=$id");
   $row= mysqli_fetch_assoc($result);
}
else {
    
    header("Location: login.php");

}

$menuItems = array(
    "Donation Form" => "donation.php", 
    "About" => "about.php", 
    "Portfolio" => "portfolio.php", 
    
    "List of donations" => "list.php",
    "Profile"  => "profile.php"
);

// Initialize variables to store portfolio data
$title = "";
$description = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];

    // Insert portfolio data into the database
    $sql = "INSERT INTO portfolio (title, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $title, $description);

    if ($stmt->execute()) {
        $message = "Portfolio entry added successfully!";
    } else {
        $error = "Error adding portfolio entry: " . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Submission</title>
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
    <h1>Portfolio Submission</h1>
    
    <?php
    // Display success or error message
    if (isset($message)) {
        echo "<p style='color: green;'>$message</p>";
    }
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="title">Portfolio Title:</label>
        <input type="text" id="title" name="title" required><br>

        <label for="description">Portfolio Description:</label>
        <textarea id="description" name="description" required></textarea><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
