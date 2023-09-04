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
    "Chats" => "chats.php",
    "List of donations" => "list.php",
    "Profile"  => "profile.php"
);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1>Welcome <?php echo $row["name"]; ?></h1> 
    
    <ul class="navbar">
        <?php
        
        // Loop through the menu items and display them as links
        foreach ($menuItems as $menuItem => $url) {
            echo "<li><a href='$url'>$menuItem</a></li>";
        }
        ?>
    </ul>
   
</body>
</html>


