<!DOCTYPE html>
<html>
<head>
    <title>About</title>
</head>
<body>
    <h1>About <?php echo $_GET['org_name']; ?></h1>
    <p>
        <?php
        // Include the database connection file
        include 'includes/db.php';

        // Retrieve and display the organization's "About" text
        $org_name = $_GET['org_name'];
        $query = "SELECT about_text FROM about WHERE name = '$name'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        echo $row['about_text'];

        // Close the database connection
        mysqli_close($connection);
        ?>
    </p>
</body>
</html>
