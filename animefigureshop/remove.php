<?php
session_start();

if (!isset($_SESSION["email"])) {
    echo "<script>alert('You must be logged in to remove items.');</script>";
    echo "<script> window.location.href='index.php'; </script>";
    exit;
}

$conn = new mysqli("localhost", "root", "", "webproject");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_SESSION['email'];

// Get product code from query string
if (isset($_GET['prodCode'])) {
    $prodCode = $_GET['prodCode'];

    // Prepare delete statement
    $stmt = $conn->prepare("DELETE FROM cartContents WHERE email = ? AND prodCode = ?");
    $stmt->bind_param("ss", $email, $prodCode);

    if ($stmt->execute()) {
        // Redirect back to cart
        header("Location: cart.php");
        exit;
    } else {
        echo "<script>alert('Error removing item.');</script>";
        echo "<script> window.location.href='cart.php'; </script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No product specified.');</script>";
    echo "<script> window.location.href='cart.php'; </script>";
}

$conn->close();
?>
    