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
        <title>Home</title>
        <link rel="stylesheet" href="faq.css" type="text/css" />
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
            <div id="faq">
                <h2>FAQ</h2>
                <h3>General Questions</h3>
                <p><b>Q. How do I contact you?</b><br>
                You can reach us by email at: support@aijeensshumishop.com. We usually reply within 48 hours.  
                You may also message us through Facebook, Instagram, or Twitter.</p>
                <p><b>Q. Can I pick up my online order?</b><br>
                Yes, you can collect your items from our pickup location in Bulacan. Please contact support to schedule an appointment.</p>
                <p><b>Q. I can’t find the item I want, can you get it?</b><br>
                Feel free to contact us if you’re looking for items not listed in the shop. We’ll try to source them and get back to you with a quote.</p>
                <h3>Product Questions</h3>
                <p><b>Q. Does Aijeen’s Shumi Shop sell genuine products?</b><br>
                Absolutely! All our products are authentic and sourced from authorized distributors.</p>
                <p><b>Q. Can I get a discount for bulk orders?</b><br>
                We strive to keep our prices fair and competitive. Because of this, we cannot offer additional discounts for large orders.</p>
                <p><b>Q. An item in my order shows as sold out. Will I still receive it?</b><br>
                Don’t worry — once your order is confirmed, stock is reserved for you. “Sold out” only means we can’t accept new orders for that item.</p>
                <h3>Payment Questions</h3>
                <p><b>Q. What payment methods are available?</b><br>
                We accept Bank Payment, Gcash/PayMaya, PayPal, and Cash (for pickup orders).</p>
                <p><b>Q. What currency do you use?</b><br>
                All payments are charged in Philippine Pesos (PHP).</p>
            </div>
        </div>
        <div id="footer">
            <p>&copy; 2026 Aijeeen’s Shumi Shop</p>
        </div>
    </body>
</html>