<?php
session_start();

if (!isset($_SESSION["email"])) {
    echo "<script>alert('Still Logged Out!')</script>";
    echo "<script> window.location.href='index.php'; </script>";
}

$host = "localhost";
$user = "root";
$pass = "";
$db   = "webproject";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
    SELECT 
        o.orderID,
        o.email,
        o.paymentMethod,
        o.orderStatus,
        SUM(oi.quantity * pd.price) AS totalPrice,
        MIN(pi.image_path) AS image_path
    FROM orders o
    LEFT JOIN orderitems oi ON o.orderID = oi.orderID
    LEFT JOIN productdetails pd ON oi.prodCode = pd.prodCode
    LEFT JOIN product_images pi ON oi.prodCode = pi.prodCode
    GROUP BY o.orderID, o.email, o.paymentMethod, o.orderStatus
    ORDER BY o.orderID DESC
";

$result = $conn->query($sql);
?>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css" type="text/css" />
</head>
<body>
    <div id="header">
        <div id="logo">
            <img src="projectimg/Head.png" alt="" />
        </div>
        <h1>Admin Control Panel</h1>
        <div class="logout-container">
        <form action="logout.php" method="post">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
    </div>
    <div id="main">
        <h1>Orders</h1>
        <div class="orders-header">
            <div class="col-order">Order</div>
            <div class="col-user">User</div>
            <div class="col-status">Status</div>
            <div class="col-details"></div>
        </div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='order-row'>";
                
                // Order info with image
                echo "<div class='col-order'>";
                if (!empty($row['image_path'])) {
                    echo "<img src='" . $row['image_path'] . "' class='order-img' alt='Product Image'>";
                }
                echo "<div class='order-text'>";
                echo "<strong>ORDER-" . $row['orderID'] . "</strong><br>";
                echo "Total Price: ₱" . number_format($row['totalPrice']) . "<br>";
                echo "Payment: " . $row['paymentMethod'];
                echo "</div>";
                echo "</div>";
                
                // User
                echo "<div class='col-user'>" . $row['email'] . "</div>";
                
                // Status
                echo "<div class='col-status " . strtolower($row['orderStatus']) . "'>" . $row['orderStatus'] . "</div>";
                
                // Details button
                echo "<div class='col-details'><a href='orderdetails.php?id=" . $row['orderID'] . "' class='details-btn'>Details</a></div>";
                
                echo "</div>";
            }
        } else {
            echo "<p>No orders found</p>";
        }
        ?>
    </div>
    <div id="footer">
        <p>&copy; 2026 Aijeeen’s Shumi Shop</p>
    </div>
</body>
</html>
