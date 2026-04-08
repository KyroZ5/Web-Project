<?php
session_start(); ?>

<?php if (!isset($_SESSION["email"])) {
    echo "<script>alert('Still Logged Out!')</script>";
    echo "<script> window.location.href='index.php'; </script>";
} ?>

<?php
$conn = new mysqli("localhost", "root", "", "webproject");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$prodcode = $_GET["prodcode"] ?? "";

$sql = "SELECT prodName, price, releaseDate, brand, seriesTitle, charName 
        FROM productDetails
        WHERE prodCode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $prodcode);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $prodName = $row["prodName"];
    $price = $row["price"];
    $releaseDate = $row["releaseDate"];
    $brand = $row["brand"];
    $seriesTitle = $row["seriesTitle"];
    $charName = $row["charName"];
} else {
    $prodName = "Product not found";
    $price = 0;
    $releaseDate = "-";
    $brand = "-";
    $seriesTitle = "-";
    $charName = "-";
}
$stmt->close();
$sql = "SELECT image_path FROM product_images WHERE prodCode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $prodcode);
$stmt->execute();
$images = $stmt->get_result();
$stmt->close();
$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?php echo $prodName; ?></title>
    <link rel="stylesheet" href="product.css?v=1.0" type="text/css" />
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
                </div>
            </a>
        </div>
        <div id="middle">
            <div id="pics">
                <?php while ($row = $images->fetch_assoc()): ?>
                <div class="mySlides fade">
                    <img src="<?php echo $row['image_path']; ?>" />
                </div>
                <?php endwhile; ?>
                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
            </div>
            <div id="desc">
                <h1><?php echo $prodName; ?></h1>
                <div id="price">
                    <h2>₱<?php echo number_format($price, 0); ?></h2>
                </div>
                <div id="buttons">
                        <div class="b2">
                            <div id="qty">                               
                                <form>
                                    <label for="quantity">Quantity: </label>
                                    <input type="number" id="quantity" name="quantity" min="1" max="5" value="1"/>
                                </form>
                            </div>
                        </div>
                        <div class="b1">
                            <a href="addtocart.php?prodcode=<?php echo $prodcode; ?>" id="tocart">
                                <div id="addcart">
                                    <img src="projectimg/cart.png" alt="" />
                                    <h2>Add To Cart</h2>
                                </div>
                            </a>
                            <a href="checkout1.html">
                                <div id="buynow">
                                    <h2>Buy Now</h2>
                                </div>
                            </a>
                        </div>
                    </div>

                <div id="aboutitem">
                    <h2>About this Item</h2>
                    <table>
                        <tr>
                            <td>Release Date:</td>
                            <td><?php echo $releaseDate; ?></td>
                        </tr>
                        <tr>
                            <td>Shop Code:</td>
                            <td><?php echo $prodcode; ?></td>
                        </tr>
                        <tr>
                            <td>Brand:</td>
                            <td><?php echo $brand; ?></td>
                        </tr>
                        <tr>
                            <td>Series Title:</td>
                            <td><?php echo $seriesTitle; ?></td>
                        </tr>
                        <tr>
                            <td>Character Name:</td>
                            <td><?php echo $charName; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div id="lower">
            <h2>You may also like</h2>
             <div id="contents">
                    <div class="recommend">
                        <a href="product2.html"><img src="projectimg/1.png" /></a>
                        <h4>Lycoris Recoil 1/7 Scale Figure Chisato Nishikigi -Band ver.</h4>
                    </div>
                    <div class="recommend">
                        <a href="product3.html"><img src="projectimg/2.png" /></a>
                        <h4>Lycoris Recoil 1/7 Scale Figure Takina Inoue -Band ver.</h4>
                    </div>
                    <div class="recommend">
                        <a href="product4.html"><img src="projectimg/3.png" /></a>
                        <h4>Gift+ Honkai: Star Rail Hyacine 1/8 Complete Figure</h4>
                    </div>
                    <div class="recommend">
                        <a href="product5.html"><img src="projectimg/4.png" /></a>
                        <h4>Nendoroid Kasane Teto: Synthesizer V AI Ver.</h4>
                    </div>
                </div>
        </div>
    </div>
    <div id="footer"></div>
    <div id="popup">
        <div class="popup-content">
                <img src="projectimg/check.png" alt="Success" class="popup-icon" />
                <p class="popup-text">Added to Cart</p>
                <button id="okBtn">OK</button>
         </div>

    </div>
    <script src="product.js" type="text/javascript"></script>
</body>
</html>
