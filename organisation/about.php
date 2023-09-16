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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Online Charity</title>
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

    <section class="about-section">
        <div class="container">
            <h1>About Us</h1>
            <p>Welcome to Online Charity, where we are dedicated to making a positive impact in the world through charitable initiatives.</p>

            <h2>Our Mission</h2>
            <p>Our mission is to empower people to create positive change by connecting them with causes they care about. We strive to make giving easy, transparent, and impactful.</p>

            <h2>Our History</h2>
            <p>Online Charity was founded in [Year] with a vision to harness the power of technology to support nonprofits and charitable organizations. Since then, we have been working tirelessly to make a difference in the lives of those in need.</p>

            <h2>Our Team</h2>
            <p>Our dedicated team consists of individuals passionate about social impact and technology. Together, we work collaboratively to drive positive change and support charitable causes worldwide.</p>

            <h2>Our Values</h2>
            <p>At Online Charity, we are guided by the following values:</p>
            <ul>
                <li>Compassion: We care deeply about the well-being of others.</li>
                <li>Transparency: We believe in openness and accountability in our actions.</li>
                <li>Impact: We strive for meaningful and lasting change through our initiatives.</li>
                <li>Inclusivity: We welcome everyone to join us in making a difference.</li>
            </ul>
        </div>
    </section>

    <!-- Include your site's footer here -->
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
