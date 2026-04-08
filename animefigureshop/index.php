<?php
session_start(); ?>
<?php

if(isset($_SESSION["email"])){
    echo "<script>alert('Still Logged in!')</script>";
    echo "<script> window.location.href='home.php'; </script>";
}

?>

<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>LogIn</title>
        <link rel="stylesheet" href="index.css?v=1.0" type="text/css"/>
    </head>

    <body>
        <div id="header">
            <div id="logo">
                <a href="home.php"> <img src="projectimg/FInal-removebg-preview.png" alt="" /> </a>
            </div>
        </div>
        <div id="main">
            <div id="indexbox">
                <div class="option-selector">
                    <button type="button" class="option active" data-method="login">Log In</button>
                    <button type="button" class="option" data-method="signup">Sign Up</button>
                </div>
                <div id="loginDiv" class="methodDiv">
                    <div class="from-box">
                        <?php if (isset($_GET['login_msg'])): ?>
                            <div class="message <?php echo htmlspecialchars($_GET['login_status']); ?>">
                                <?php echo htmlspecialchars($_GET['login_msg']); ?>
                            </div>
                        <?php endif; ?>
                        <form action="test.php" method="post">
                            <input type="email" name="email" placeholder="Email"  /> <br>
                            <input type="password" name="password" placeholder="Password"/>
                            <div class="options">
                                <label><input type="checkbox" name="remember" /> Remember me</label>
                                <a href="#">Forgot Password?</a>
                            </div>

                            <button type="submit" name="login">LOG IN</button>
                        </form>
                    </div>
                </div>
                
                <div id="signupDiv" class="methodDiv" style="display: none">
                    <div class="form-box">
                        <?php if (isset($_GET['signup_msg'])): ?>
                            <div class="message <?php echo htmlspecialchars($_GET['signup_status']); ?>">
                                <?php echo htmlspecialchars($_GET['signup_msg']); ?>
                            </div>
                        <?php endif; ?>
                        <form action="create.php" method="post">
                            <input type="email" name="email" placeholder="Email"  />
                            <input type="text" name="firstname" placeholder="First Name" />
                            <input type="text" name="lastname" placeholder="Last Name"  />
                            <input type="password" name="password" placeholder="Password" />
                            <input type="password" name="confirm_password" placeholder="Confirm Password"/>
                            <div class="terms">
                                <label>
                                    <input type="checkbox" name="terms" required/>
                                    I accept the Terms of Service and Privacy Policy
                                </label>
                            </div>
                            <button type="submit" name="signup">SIGN UP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer"></div>

        <script src="index.js" type="text/javascript"></script>
    </body>
</html>