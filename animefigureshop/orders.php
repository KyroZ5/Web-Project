<?php
session_start();
?>

<?php
if(!isset($_SESSION["email"])){
    echo "<script>alert('Still Logged Out!')</script>";
    echo "<script> window.location.href='index.php'; </script>";
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>My Account - Aijeeen's Shumi Shop</title>
        <link rel="stylesheet" href="orders.css" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Konkhmer+Sleokchher&family=Montserrat&family=Kodchasan&display=swap">
    </head>
    <body>
         <div id="header">
            <div id="logo">
                <a href="home.php"> <img src="projectimg/FInal-removebg-preview.png" alt="Aijeeen's Shumi Shop Logo" /> </a>
            </div>
            <div class="nav">
                <a href="home.php"><h2>Home</h2></a>
            </div>
            <div class="nav">
                <a href="about.php"> <h2>About</h2></a>
            </div>
            <div class="nav">
                <a href="faq.php"><h2>FAQ</h2></a>
            </div>
            <div class="nav" id="search">
                <form action="search.php" method="GET">
                    <input type="text" placeholder="Search.." name="query" />
                    <button type="submit"><img src="projectimg/search.jpg" alt="Search Icon" /></button>
                </form>
            </div>
            <div class="nav" id="profile">
                <a href="profile.php"><img src="projectimg/profile.jpg" alt="User Profile Icon" /> </a>
            </div>
            <div class="nav" id="cart">
                <a href="cart.php"><img src="projectimg/cart.png" alt="Shopping Cart Icon" /> </a>
            </div>
        </div>
        <div class="my-account">
                <h1>ORDERS</h1>
        </div>
        <div id="main-account">
            <div class="account-sidebar">
                <div class="user-info">
                    <h3>Sean Kevin Mananghaya</h3> <!-- Dynamic user name would go here -->
                </div>
                <ul>
                    <li><a href="profile.php"><span class="icon">👤</span> MY ACCOUNT</a></li>
                    <li class="active"><a href="orders.php"><span class="icon">📦</span> ORDERS</a></li>
                    <li><a href="edit_account.php"><span class="icon">✏️</span> EDIT ACCOUNT</a></li>
                    <li><a href="logout.php"><span class="icon">→</span> LOG OUT</a></li>
                </ul>
            </div>
            
            <div class="account-content">
               CONTENT HERE
            </div>
        </div>
        <div id="footer">
            <p>&copy; <?php echo date("Y"); ?> Aijeeen’s Shumi Shop</p>
        </div>
    </body>
</html>