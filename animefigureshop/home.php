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
        <link rel="stylesheet" href="home.css?v=1.0" type="text/css" />
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
            <div id="outer">
                <div id="inner">
                    <div class="innerchild">
                        <div class="mySlides fade">
                            <div class="text">
                                <h3>ORDER NOW!</h3>
                                <b>Gift+ Honkai: Star Rail Hyacine 1/8 Complete Figure</b>
                                <div class="buttontop">
                                    <a href="product.php?prodcode=FIGURE-5">Add to Cart</a>
                                </div>
                            </div>
                            <img src="projectimg/slide-1.png" />
                        </div>
                        <div class="mySlides fade">
                            <div class="text">
                                <h3>ORDER NOW!</h3>
                                <b>Lycoris Recoil 1/7 Scale Figure Chisato Nishikigi -Band ver.</b>
                                <div class="buttontop">
                                    <a href="product.php?prodcode=FIGURE-2">Add to Cart</a>
                                </div>
                            </div>
                            <img src="projectimg/slide-2.png" />
                        </div>
                        <div class="mySlides fade">
                            <div class="text">
                                <h3>ORDER NOW!</h3>
                                <b>Umamusume Pretty Derby Dantsu Flame 1/7 Complete Figure</b>
                                <div class="buttontop">
                                    <a href="product.php?prodcode=FIGURE-8">Add to Cart</a>
                                </div>
                            </div>
                            <img src="projectimg/slide-3.png" />
                        </div>
                    </div>
                    <div class="innerchild">
                        <div class="contents">
                            <a href="product.php?prodcode=FIGURE-3"><img src="projectimg/bronya-1.jpg" /></a>
                            <h3>Honkai Impact 3rd Bronya Herrscher of Reason Ver. 1/8 Complete Figure</h3>
                            <h2>₱16,840</h2>
                            <div class="button">
                                <a href="product.php?prodcode=FIGURE-3">View Item</a>
                            </div>
                        </div>
                        <div class="contents">
                            <a href="product.php?prodcode=FIGURE-2"><img src="projectimg/chisato-2.jpg" /></a>
                            <h3>Lycoris Recoil 1/7 Scale Figure Chisato Nishikigi -Band ver.</h3>
                            <h2>₱13,500</h2>
                            <div class="button">
                                <a href="product.php?prodcode=FIGURE-2">View Item</a>
                            </div>
                        </div>
                        <div class="contents">
                            <a href="product.php?prodcode=FIGURE-1"><img src="projectimg/takina-1.jpg" /></a>
                            <h3>Lycoris Recoil 1/7 Scale Figure Takina Inoue -Band ver.</h3>
                            <h2>₱13,500</h2>
                            <div class="button">
                                <a href="product.php?prodcode=FIGURE-1">View Item</a>
                            </div>
                        </div>
                        <div class="contents">
                            <a href="product.php?prodcode=FIGURE-4"><img src="projectimg/teto-nen-1.jpg" /></a>
                            <h3>Nendoroid Kasane Teto: Synthesizer V AI Ver.</h3>
                            <h2>₱2,551</h2>
                            <div class="button">
                                <a href="product.php?prodcode=FIGURE-4">View Item</a>
                            </div>
                        </div>
                    </div>
                    <div class="innerchild">
                        <div class="contents">
                            <a href="product.php?prodcode=FIGURE-6"><img src="projectimg/frieren-2.jpg" /></a>
                            <h3>
                                MADHOUSE x DesignCOCO Frieren: Beyond Journey's End Frieren - Art Nouveau Style - 1/7
                                Complete Figure
                            </h3>
                            <h2>₱11,850</h2>
                            <div class="button">
                                <a href="product.php?prodcode=FIGURE-6">View Item</a>
                            </div>
                        </div>
                        <div class="contents">
                            <a href="product.php?prodcode=FIGURE-7"><img src="projectimg/himmel-2.jpg" /></a>
                            <h3>
                                MADHOUSE x DesignCOCO Frieren: Beyond Journey's End Himmel - Art Nouveau Style - 1/7
                                Complete Figure
                            </h3>
                            <h2>₱11,850</h2>
                            <div class="button">
                                <a href="product.php?prodcode=FIGURE-7">View Item</a>
                            </div>
                        </div>
                        <div class="contents">
                            <a href="product.php?prodcode=FIGURE-5"><img src="projectimg/hyacine-1.jpg" /></a>
                            <h3>Gift+ Honkai: Star Rail Hyacine 1/8 Complete Figure</h3>
                            <h2>₱2,545</h2>
                            <div class="button">
                                <a href="product.php?prodcode=FIGURE-5">View Item</a>
                            </div>
                        </div>
                        <div class="contents">
                            <a href="product.php?prodcode=FIGURE-8"><img src="projectimg/dantsu-1.jpg" /></a>
                            <h3>Umamusume Pretty Derby Dantsu Flame 1/7 Complete Figure</h3>
                            <h2>₱9,730</h2>
                            <div class="button">
                                <a href="product.php?prodcode=FIGURE-8">View Item</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
        <p>&copy; 2026 Aijeeen’s Shumi Shop</p>
    </div>
        <script src="home.js" type="text/javascript"></script>
    </body>
</html>
