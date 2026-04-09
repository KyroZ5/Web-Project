<?php
session_start();

if (!isset($_SESSION["email"])) {
    echo "<script>alert('Still Logged Out!')</script>";
    echo "<script> window.location.href='index.php'; </script>";
    exit;
}

$host = "localhost";
$user = "root";
$pass = "";
$db   = "webproject";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION["email"];

// Fetch user name
$sql_user = "SELECT firstname, lastname FROM accounts WHERE email = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $email);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user = $result_user->fetch_assoc();

// Fetch orders
$sql_orders = "
    SELECT 
        o.orderID,
        o.orderStatus,
        o.paymentMethod,
        o.orderDate,
        SUM(oi.quantity * pd.price) AS totalPrice,
        MIN(pi.image_path) AS image_path
    FROM orders o
    LEFT JOIN orderitems oi ON o.orderID = oi.orderID
    LEFT JOIN productdetails pd ON oi.prodCode = pd.prodCode
    LEFT JOIN product_images pi ON oi.prodCode = pi.prodCode
    WHERE o.email = ?
    GROUP BY o.orderID, o.orderStatus, o.paymentMethod, o.orderDate
    ORDER BY o.orderID DESC
";

$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bind_param("s", $email);
$stmt_orders->execute();
$result_orders = $stmt_orders->get_result();
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
            <a href="home.php"><img src="projectimg/FInal-removebg-preview.png" alt="Aijeeen's Shumi Shop Logo" /></a>
        </div>
        <div class="nav"><a href="home.php"><h2>Home</h2></a></div>
        <div class="nav"><a href="about.php"><h2>About</h2></a></div>
        <div class="nav"><a href="faq.php"><h2>FAQ</h2></a></div>
        <div class="nav" id="search">
            <form action="search.php" method="GET">
                <input type="text" placeholder="Search.." name="query" />
                <button type="submit"><img src="projectimg/search.jpg" alt="Search Icon" /></button>
            </form>
        </div>
        <div class="nav" id="profile">
            <a href="profile.php"><img src="projectimg/profile.jpg" alt="User Profile Icon" /></a>
        </div>
        <div class="nav" id="cart">
            <a href="cart.php"><img src="projectimg/cart.png" alt="Shopping Cart Icon" /></a>
        </div>
    </div>

    <div class="my-account">
        <h1>ORDERS</h1>
    </div>

    <div id="main-account">
        <div class="account-sidebar">
            <div class="user-info">
                <h3>
                    <?php 
                    if ($user) {
                        echo htmlspecialchars($user['firstname'] . " " . $user['lastname']);
                    } else {
                        echo htmlspecialchars($email);
                    }
                    ?>
                </h3>
            </div>
            <ul>
                <li><a href="profile.php"><span class="icon">👤</span> MY ACCOUNT</a></li>
                <li class="active"><a href="orders.php"><span class="icon">📦</span> ORDERS</a></li>
                <li><a href="edit_account.php"><span class="icon">✏️</span> EDIT ACCOUNT</a></li>
                <li><a href="logout.php"><span class="icon">→</span> LOG OUT</a></li>
            </ul>
        </div>

        <div class="account-content">
            <?php
            if ($result_orders->num_rows > 0) {
                while ($row = $result_orders->fetch_assoc()) {
                    echo "<div class='account-order'>";
                    if (!empty($row['image_path'])) {
                        echo "<img src='" . $row['image_path'] . "' class='account-order-img' alt='Product'>";
                    }
                    echo "<div class='account-order-info'>";
                    echo "<strong>ORDER-" . $row['orderID'] . "</strong><br>";
                    echo "Total Price: ₱" . number_format($row['totalPrice']) . "<br>";
                    echo "Payment: " . $row['paymentMethod'] . "<br>";
                    echo date('m-d-Y', strtotime($row['orderDate'])) . "<br>";
                    echo "<span class='status " . strtolower($row['orderStatus']) . "'>" . $row['orderStatus'] . "</span>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No orders found for your account.</p>";
            }
            ?>
        </div>
    </div>

    <div id="footer">
        <p>&copy; <?php echo date("Y"); ?> Aijeeen’s Shumi Shop</p>
    </div>
</body>
</html>
