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
    <title>Contact Us</title>
    <link rel="stylesheet" type="text/css" href="css/contact.css">
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
            <br>
        <div class="contact-form">
            <h1>Contact Us</h1>
            
            <div class="container">
                <div class="main">
                    <div class="content">
                        <h2>Contact Us</h2>
                        <form action="" method="post">
                            <input type="text" name="name" placeholder="Enter Your Name"required="required">
                          
                            <input type="email" name="name" placeholder="Enter Your Email" required="required">
                            <textarea name="message" placeholder="Your Message"required="required"></textarea>                   
                 <button type="submit" class="btn">Send </button>
                        </form>
                    </div>
                    <div class="form-img">
                        <img src="../charity_sw/imgs/bg1.png" alt="">
                    </div>
                </div>
            </div>
        </div> 
    </body>
    </html>