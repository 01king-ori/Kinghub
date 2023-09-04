<?php
require 'config.php';
//session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

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
    <title>Profile</title>
</head>
<body>
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
