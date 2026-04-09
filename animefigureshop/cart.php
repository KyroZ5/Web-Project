<?php
session_start();

if(!isset($_SESSION["email"])){
    echo "<script>alert('Still Logged Out!')</script>";
    echo "<script> window.location.href='index.php'; </script>";
    exit;
}

$conn = new mysqli("localhost", "root", "", "webproject");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];

$sql = "
    SELECT c.prodCode, c.quantity, p.prodName, p.price, img.image_path
    FROM cartContents c
    INNER JOIN ProductDetails p ON c.prodCode = p.prodCode
    LEFT JOIN (
        SELECT prodCode, MIN(image_path) AS image_path
        FROM product_images
        GROUP BY prodCode
    ) img ON c.prodCode = img.prodCode
    WHERE c.email = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="cart.css">
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
        <h2>Your Cart</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()):
                $lineTotal = $row['price'] * $row['quantity'];
                $total += $lineTotal;
            ?>
            <tr>
                <td class="product-cell">
                    <?php if (!empty($row['image_path'])): ?>
                        <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Product Image" class="product-img">
                    <?php endif; ?>
                    <div class="product-info">
                        <div class="product-name"><?php echo htmlspecialchars($row['prodName']); ?></div>
                        <div class="product-price">₱<?php echo number_format($row['price'], 2); ?></div>
                    </div>
                </td>
                <td><?php echo (int)$row['quantity']; ?></td>
                <td>₱<?php echo number_format($lineTotal, 2); ?></td>
                <td class="action-cell">
                    <a href="remove.php?prodCode=<?php echo urlencode($row['prodCode']); ?>">
                        <img src="projectimg/trash-bin.png" alt="Remove" class="trash-icon">
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        
        <div class="cart-summary">
            <h3>Estimated Total: ₱<?php echo number_format($total, 2); ?></h3>
            <form action="cartcheckout.php" method="POST">
                <button type="submit">CHECKOUT</button>
            </form>
        </div>
    </div>

    <div id="footer">
        <p>&copy; 2026 Aijeeen’s Shumi Shop</p>
    </div>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
