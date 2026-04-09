<?php
session_start();
$conn = new mysqli("localhost", "root", "", "webproject");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$prodCode = $_GET['prodcode'] ?? '';

$stmt = $conn->prepare("
    SELECT p.prodCode, p.prodName, p.price, pi.image_path
    FROM ProductDetails p
    JOIN product_images pi ON p.prodCode = pi.prodCode
    WHERE p.prodCode = ?
    LIMIT 1
");
$stmt->bind_param("s", $prodCode);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$quantity = 1;
$subtotal = 0;
$total = 0;

if ($product) {
    if (isset($_POST['products'][$product['prodCode']])) {
        $quantity = (int)$_POST['products'][$product['prodCode']];
    }

    $subtotal = $product['price'] * $quantity;
    $shippingFee = 0;
    $total = $subtotal + $shippingFee;
}

$stmt->close();
$conn->close();
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
        <title>Title</title>
        <link rel="stylesheet" href="checkout.css" type="text/css" />
    </head>
    <body>
        <div id="header">
            <div id="logo">
                <a href="home.html"> <img src="projectimg/FInal-removebg-preview.png" alt="" /> </a>
            </div>
            <div class="nav" id="nav1">
                <a href="home.html" id="active"><h2>Home</h2></a>
            </div>
            <div class="nav">
                <a href="home.html"> <h2>About</h2></a>
            </div>
            <div class="nav">
                <a href="home.html"><h2>FAQ</h2></a>
            </div>
            <div class="nav" id="search">
                <form>
                    <input type="text" placeholder="Search.." name="search" />
                    <button type="submit"><img src="projectimg/search.jpg" alt="Icon" /></button>
                </form>
            </div>
            <div class="nav" id="profile">
                <a href=""><img src="projectimg/profile.jpg" /> </a>
            </div>
            <div class="nav" id="cart">
                <a href=""><img src="projectimg/cart.png" /> </a>
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
            <form id="checkoutForm" action="placeorder.php" method="POST">
                  
                <div id="email">
                    <img src="projectimg/profile.jpg" alt="" />
                    <h4>gianhakdog24@gmail.com</h4>
                </div>

                <div class="option-selector">
                    <button type="button" class="option active" data-method="Delivery">
                        <img src="projectimg/truck.png" alt="" />Ship
                    </button>
                    <button type="button" class="option" data-method="Pickup">
                        <img src="projectimg/location.png" alt="" />Pickup
                    </button>
                </div>
                <input type="hidden" name="products[<?php echo $_GET['prodcode']; ?>]" id="hiddenQty" value="1">
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
                        <?php if ($product) { ?>
                        <div class="item">
                            <div class="itempic">
                                <img src="<?php echo $product['image_path']; ?>" alt="" />
                            </div>
                            <div class="iteminfo">
                                <h5><?php echo htmlspecialchars($product['prodName']); ?></h5>
                                <p><b>Price: </b> ₱<?php echo number_format($product['price']); ?></p>
                            </div>
                            <div class="amountspinner">
                                <fieldset class="spinner spinner--horizontal l-contain--medium">
                                    <button class="spinner__button js-spinner-horizontal-subtract" data-type="subtract">-</button>
                                    <input type="number"
                                           class="spinner__input js-spinner-input-horizontal"
                                           id="qtySpinner"
                                           value="1"
                                           min="0"
                                           max="5"
                                           step="1" />
                                    <button class="spinner__button js-spinner-horizontal-add" data-type="add">+</button>
                                </fieldset>
                            </div>
                            <div class="delete">
                                <img src="projectimg/trash-bin.png" alt="Delete" />
                            </div>
                        </div>
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
        <div id="footer"></div>
        <script src="checkout.js" type="text/javascript"></script>
    </body>
</html>
