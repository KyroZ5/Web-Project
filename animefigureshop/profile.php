<?php
session_start();

if(!isset($_SESSION["email"])){
    echo "<script>alert('Still Logged Out!')</script>";
    echo "<script> window.location.href='index.php'; </script>";
    exit();
}

// Database connection
$servername = "localhost";
$username   = "root";     // adjust if needed
$password   = "";         // adjust if needed
$dbname     = "webproject";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user info
$email = $_SESSION["email"];
$sql   = "SELECT firstname, lastname FROM accounts WHERE email = ?";
$stmt  = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $fullname = $row['firstname'] . " " . $row['lastname'];
} else {
    $fullname = "Unknown User";
}

$stmt->close();
$conn->close();
?>

<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>My Account - Aijeeen's Shumi Shop</title>
        <link rel="stylesheet" href="profile.css" type="text/css" />
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
                <h1>MY ACCOUNT</h1>
        </div>
        <div id="main-account">
            <div class="account-sidebar">
                <div class="user-info">
                    <h3><?php echo htmlspecialchars($fullname); ?></h3>
                </div>
                <ul>
                    <li class="active"><a href="profile.php"><span class="icon">👤</span> MY ACCOUNT</a></li>
                    <li><a href="orders.php"><span class="icon">📦</span> ORDERS</a></li>
                    <li><a href="edit_account.php"><span class="icon">✏️</span> EDIT ACCOUNT</a></li>
                    <li><a href="logout.php"><span class="icon">→</span> LOG OUT</a></li>
                </ul>
            </div>
            
            <div class="account-content">
                <p>Hello <?php echo htmlspecialchars($fullname); ?> (not <?php echo htmlspecialchars($fullname); ?>? <a href="logout.php">Log out</a>)</p>
                <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>

                <div class="account-actions">
                    <a href="profile.php" class="btn"><h3>My Account</h3></a>
                    <a href="orders.php" class="btn"><h3>Orders</h3></a>
                    <a href="edit_account.php" class="btn"><h3>Edit Account</h3></a>
                    <a href="logout.php" class="btn btn-danger"><h3>Log out</h3></a>
                </div>
            </div>
        </div>
        <div id="footer">
            <p>&copy; <?php echo date("Y"); ?> Aijeeen’s Shumi Shop</p>
        </div>
    </body>
</html>
