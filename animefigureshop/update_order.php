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

$orderID = $_POST['orderID'];
$action  = $_POST['action']; // "Approve" or "Reject"

// Decide new status
$newStatus = ($action === "Approve") ? "Approved" : "Rejected";

// Update order status
$sql = "UPDATE orders SET orderStatus = ? WHERE orderID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $newStatus, $orderID);
$stmt->execute();

// Fetch updated order info
$sql_order = "
    SELECT o.orderID, o.email, o.paymentMethod, o.logisticsMethod, o.orderStatus,
           dd.address, dd.city, dd.province, dd.zipCode, dd.phoneNumber
    FROM orders o
    LEFT JOIN deliverydetails dd ON o.orderID = dd.orderID
    WHERE o.orderID = ?
";
$stmt = $conn->prepare($sql_order);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$orderResult = $stmt->get_result();
$order = $orderResult->fetch_assoc();

// Fetch items
$sql_items = "
    SELECT oi.quantity, pd.prodName, pd.price, MIN(pi.image_path) AS image_path
    FROM orderitems oi
    LEFT JOIN productdetails pd ON oi.prodCode = pd.prodCode
    LEFT JOIN product_images pi ON oi.prodCode = pi.prodCode
    WHERE oi.orderID = ?
    GROUP BY oi.quantity, pd.prodName, pd.price
";
$stmt = $conn->prepare($sql_items);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$itemsResult = $stmt->get_result();

$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Order Receipt</title>
    <link rel="stylesheet" href="update_order.css" type="text/css" />
    <script>
        window.onload = function() {
            alert("Order #<?php echo $order['orderID']; ?> has been <?php echo $order['orderStatus']; ?>!");
        }
    </script>
</head>
<body>
    <div id="header">
        <h1>Order Receipt</h1>
    </div>
    <div id="main" class="order-summary">
        <div class="order-left">
            <h2>Order Summary</h2>
            <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
            <?php if ($order['logisticsMethod'] === 'Delivery') { ?>
                <h3>Delivery Details</h3>
                <p><?php echo $order['address']; ?></p>
                <p><?php echo $order['city']; ?>, <?php echo $order['province']; ?> <?php echo $order['zipCode']; ?></p>
                <p><strong>Phone:</strong> <?php echo $order['phoneNumber']; ?></p>
            <?php } else { ?>
                <h3>Pickup</h3>
                <p>Customer will pick up the order.</p>
            <?php } ?>
            <h3>Payment</h3>
            <p><?php echo $order['paymentMethod']; ?></p>
            <h3>Status</h3>
            <p><?php echo $order['orderStatus']; ?></p>
            <div class="order-actions">
                <form action="admin.php" method="get">
                    <button type="submit" class="done">Done</button>
                </form>
            </div>
        </div>
        <div class="order-right">
            <h2>Order Items</h2>
            <?php
            $subtotal = 0;
            while ($item = $itemsResult->fetch_assoc()) {
                $lineTotal = $item['quantity'] * $item['price'];
                $subtotal += $lineTotal;
                echo "<div class='item-row'>";
                if (!empty($item['image_path'])) {
                    echo "<img src='" . $item['image_path'] . "' class='item-img' alt='Product'>";
                }
                echo "<div class='item-info'>";
                echo "<p><strong>" . $item['prodName'] . "</strong></p>";
                echo "<p>Quantity: " . $item['quantity'] . "</p>";
                echo "<p>Price: ₱" . number_format($item['price']) . "</p>";
                echo "<p><em>Line Total: ₱" . number_format($lineTotal) . "</em></p>";
                echo "</div>";
                echo "</div>";
            }
            ?>
            
            <div class="order-total">
                <p><strong>Sub Total:</strong> ₱<?php echo number_format($subtotal); ?></p>
                <p><strong>Shipping Fee:</strong> ₱0</p>
                <p><strong>Total:</strong> ₱<?php echo number_format($subtotal); ?></p>
            </div>

        </div>
    </div>
    <div id="footer">
        <p>&copy; 2026 Aijeeen’s Shumi Shop</p>
    </div>
</body>
</html>
