<?php
$menuItems = array(
    "List of Organizations" => "organizations.php", 
    "Newsletters" => "newsletters.php", 
    "How We Work" => "how_we_work.php", 
    "Contact Us" => "contact_us.php",
    "Profile"  => "profile.php",
    "Donate" =>  "donationslist.php"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletters</title>
    <link rel="stylesheet" type="text/css" href="css/newsletters.css">
    <script>
        // Function to handle form submission
        function handleSubmit(event) {
            event.preventDefault(); // Prevents the form from submitting normally

            // Get the email input value
            const emailInput = document.querySelector('.email-input');
            const email = emailInput.value;

            // Check if the email is valid (you can add more validation if needed)
            if (isValidEmail(email)) {
                // Display success message
                alert('Your email has been successfully added!');
                
                // Clear the input field
                emailInput.value = '';
            } else {
                alert('Please enter a valid email address.');
            }
        }

        // Function to validate email using a simple regular expression
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>
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
    <div class="centre">
    <div class="newsletter-form">
        <h2>Join our Newsletter</h2>
        <p>We have monthly newsletters</p>
        <form onsubmit="handleSubmit(event);">
            <input type="email" class="email-input" placeholder="Enter your email">
            <input type="submit" class="btn" value="Subscribe">
        </form>
    </div>
    </div>
</body>
</html>
