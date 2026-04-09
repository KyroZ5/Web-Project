<?php
session_start(); ?>

<?php if (!isset($_SESSION["email"])) {
    echo "<script>alert('Still Logged Out!')</script>";
    echo "<script> window.location.href='index.php'; </script>";
} ?>

<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Home</title>
        <link rel="stylesheet" href="about.css" type="text/css" />
    </head>
    <body>
         <div id="header">
            <div id="logo">
                <a href="home.php"> <img src="projectimg/FInal-removebg-preview.png" alt="" /> </a>
            </div>
            <div class="nav" id="nav1">
                <a href="home.php" id="active"><h2>Home</h2></a>
            </div>
            <div class="nav">
                <a href="about.php"> <h2>About</h2></a>
            </div>
            <div class="nav">
                <a href="faq.php"><h2>FAQ</h2></a>
            </div>
            <div class="nav" id="search">
                <form>
                    <input type="text" placeholder="Search.." name="search" />
                    <button type="submit"><img src="projectimg/search.jpg" alt="Icon" /></button>
                </form>
            </div>
            <div class="nav" id="profile">
                <a href="profile.php"><img src="projectimg/profile.jpg" /> </a>
            </div>
            <div class="nav" id="cart">
                <a href="cart.php"><img src="projectimg/cart.png" /> </a>
            </div>
        </div>
        <div id="main">
            <div id="aboutus">
                <h2>ABOUT US</h2>
                <p>
                    Aijeen’s Shumi Shop is an internet retail business founded in 2012 by dedicated figure and model kit enthusiasts in the Philippines. 
                    We are committed to offering only authentic anime figures, plastic models, and related accessories at fair prices. 
                    Our mission is to provide high satisfaction and value to hobbyists and collectors worldwide.
                </p>

                <h3>Store Contact Information:</h3>
                <p>
                    Aijeen’s Shumi Shop<br />
                    6748 Mission St #328<br />
                    Daly City, CA 94014<br />
                    United States<br />
                    Email: support@aijeensshumishop.com
                </p>

                <h3>Our Social Media Pages:</h3>
                <p>
                    <a href="https://www.facebook.com">Aijeen’s Shumi Shop on Facebook</a><br />
                    <a href="https://www.twitter.com">Aijeen’s Shumi Shop on Twitter</a><br />
                    <a href="https://www.instagram.com">Aijeen’s Shumi Shop on Instagram</a>
                </p>

                <h3>Our Storefront on Other Marketplaces:</h3>
                <p>
                    <a href="https://www.ebay.com">Aijeen’s Shumi Shop on eBay</a><br />
                    <a href="https://www.amazon.com">Aijeen’s Shumi Shop on Amazon</a>
                </p>
            </div>
        </div>
        <div id="footer">
            <p>&copy; 2026 Aijeeen’s Shumi Shop</p>
        </div>
    </body>
</html>