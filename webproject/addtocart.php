<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php?login_status=error&login_msg=Please login first&tab=login");
    exit;
}

$email    = $_SESSION['email'];
$prodcode = $_GET['prodcode'] ?? '';
$quantity = (int)($_GET['quantity'] ?? 1);

if (!empty($prodcode)) {
    $conn = new mysqli("localhost", "root", "", "webproject");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("SELECT quantity FROM cartContents WHERE email = ? AND prodCode = ?");
    $stmt->bind_param("ss", $email, $prodcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $newQty = $row['quantity'] + $quantity;
        $update = $conn->prepare("UPDATE cartContents SET quantity = ? WHERE email = ? AND prodCode = ?");
        $update->bind_param("iss", $newQty, $email, $prodcode);
        $update->execute();
        $update->close();
        header("Location: product.php?prodcode=$prodcode&cart_status=updated");
        exit;
    } else {
        $insert = $conn->prepare("INSERT INTO cartContents (email, prodCode, quantity) VALUES (?, ?, ?)");
        $insert->bind_param("ssi", $email, $prodcode, $quantity);
        $insert->execute();
        $insert->close();
        header("Location: product.php?prodcode=$prodcode&cart_status=success");
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: product.php?cart_status=error&cart_msg=No product code");
    exit;
}
?>
