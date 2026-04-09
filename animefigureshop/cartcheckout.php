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

$items = [];
$subtotal = 0;
$shippingFee = 0;   
$total = 0;

while ($row = $result->fetch_assoc()) {
    $row['subtotal'] = $row['price'] * $row['quantity'];
    $items[] = $row;
    $subtotal += $row['subtotal'];
}

$total = $subtotal + $shippingFee;

$stmt->close();
$conn->close();
?>


<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Cart Checkout</title>
        <link rel="stylesheet" href="checkout.css" type="text/css" />
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
            <div id="upper">
                <a href="javascript:history.back();">
                    <div id="back">
                        <img src="projectimg/back.png" alt="" />
                        <h1>ORDER SUMMARY</h1>
                    </div>
                </a>
            </div>
            <div id="container">
            <div id="methods">
                        <form id="checkoutForm" action="cartplaceorder.php" method="POST">
                            <div id="email">
                                <img src="projectimg/profile.jpg" alt="" />
                                <h4><?php echo htmlspecialchars($_SESSION['email']); ?></h4>
                            </div>

                            <div class="option-selector">
                                <button type="button" class="option active" data-method="Delivery">
                                    <img src="projectimg/truck.png" alt="" />Ship
                                </button>
                                <button type="button" class="option" data-method="Pickup">
                                    <img src="projectimg/location.png" alt="" />Pickup
                                </button>
                            </div>

                            <?php if (!empty($items)) { ?>
                                <?php foreach ($items as $product) { ?>
                                    <input type="hidden" 
                                           name="products[<?php echo $product['prodCode']; ?>]" 
                                           value="<?php echo (int)$product['quantity']; ?>">
                                <?php } ?>
                            <?php } ?>

                            <input type="hidden" name="logisticsMethod" id="logisticsMethod" value="Delivery">

                            <div id="shipDiv" class="methodDiv">
                                <h4>Shipping Information</h4>
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" required />
                                <label for="apt">Apartment, suite, etc. (Optional)</label>
                                <input type="text" id="apt" name="apt" />
                                <div class="row">
                                    <div class="field">
                                        <label for="city">City</label>
                                        <select id="city" name="city">
                                            <option value="manila">Manila</option>
                                            <option value="quezon">Quezon City</option>
                                            <option value="makati">Makati</option>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <label for="province">Province</label>
                                        <select id="province" name="province">
                                            <option value="ncr">NCR</option>
                                            <option value="central-luzon">Central Luzon</option>
                                            <option value="calabarzon">CALABARZON</option>
                                        </select>
                                    </div>
                                </div>

                                <label for="zip">ZIP Code</label>
                                <input type="text" id="zip" name="zip" required />

                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" required />

                                <div class="payment-section">
                                    <h2>Payment</h2>
                                    <p>All transactions are secure and encrypted.</p>
                                    <div class="radio-option">
                                        <label>
                                            <input type="radio" name="payment" value="Bank" checked />
                                            Bank Payment
                                        </label>
                                        <div class="expandable">
                                            <p>Make your payment directly into our bank or Gcash account...</p>
                                        </div>
                                    </div>
                                    <div class="radio-option">
                                        <label>
                                            <input type="radio" name="payment" value="GcashPaymaya" />
                                            Gcash / PayMaya
                                        </label>
                                        <div class="expandable">
                                            <p>Send your payment directly to our gcash/paymaya account...</p>
                                        </div>
                                    </div>
                                    <div class="radio-option">
                                        <label>
                                            <input type="radio" name="payment" value="Paypal" />
                                            Paypal
                                        </label>
                                        <div class="expandable">
                                            <p>We'll send an invoice to your registered email...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="pickupDiv" class="methodDiv" style="display: none">
                                <div class="pickup-header">Pickup location</div>
                                <div class="pickup-body">
                                    <div class="pickup-info">
                                        <strong>Bulacan, Philippines</strong><br />
                                        #70 Malamig Street, Poblacion, Bustos
                                    </div>
                                    <div class="pickup-icon">
                                        <img src="projectimg/check.png" alt="Confirmed" />
                                    </div>
                                </div>
                                <div class="payment-section">
                                    <h2>Payment</h2>
                                    <p>All transactions are secure and encrypted.</p>
                                    <div class="radio-option">
                                        <label>
                                            <input type="radio" name="payment" value="Cash" checked />  
                                            Cash
                                        </label>
                                        <div class="expandable">
                                            <p>Payment in Cash while picking up the package...</p>
                                        </div>
                                    </div>
                                    <div class="radio-option">
                                        <label>
                                            <input type="radio" name="payment" value="GcashPaymaya" />
                                            Gcash / PayMaya
                                        </label>
                                        <div class="expandable">
                                            <p>Send your payment directly to our gcash/paymaya account...</p>
                                        </div>
                                    </div>
                                    <div class="radio-option">
                                        <label>
                                            <input type="radio" name="payment" value="Paypal" />
                                            Paypal
                                        </label>
                                        <div class="expandable">
                                            <p>We'll send an invoice to your registered email...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="buynow">
                                <span>Complete Order</span>
                            </button>
                        </form>

                        <div id="popup">
                            <div class="popup-content">
                                <img src="projectimg/check.png" alt="Success" class="popup-icon" />
                                <p class="popup-text">Added to Cart</p>
                                <button id="okBtn">OK</button>
                            </div>
                        </div>
                    </div>
                <div id="summary">
                    <div id="itemsummary">
                        <?php if (!empty($items)) { ?>
                            <?php foreach ($items as $product) { ?>
                                <div class="item">
                                    <div class="itempic">
                                        <img src="<?php echo $product['image_path']; ?>" alt="" />
                                    </div>
                                    <div class="iteminfo">
                                        <h5><?php echo htmlspecialchars($product['prodName']); ?></h5>
                                        <p><b>Price: </b> ₱<?php echo number_format($product['price']); ?></p>
                                        <p><b>Quantity: </b> <?php echo (int)$product['quantity']; ?></p>
                                    </div>
                                    <div class="delete">
                                        <img src="projectimg/trash-bin.png" alt="Delete" />
                                    </div>
                                </div>

                            <?php } ?>
                        <?php } else { ?>
                            <p>Product not found.</p>
                        <?php } ?>
                    </div>

                    <div id="pricesummary">
                        <div class="summary-row">
                            <span class="label">Sub Total:</span>
                            <span class="value">₱<?php echo number_format($subtotal); ?></span>
                        </div>
                        <div class="summary-row">
                            <span class="label">Shipping Fee:</span>
                            <span class="value">₱<?php echo number_format($shippingFee); ?></span>
                        </div>
                        <div class="summary-row total">
                            <span class="label">Total:</span>
                            <span class="value">₱<?php echo number_format($total); ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="footer">
        <p>&copy; 2026 Aijeeen’s Shumi Shop</p>
    </div>
        <script src="checkout.js" type="text/javascript"></script>
    </body>
</html>
