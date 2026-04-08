<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php?login_status=error&login_msg=Please login first&tab=login");
    exit;
}

$email      = $_SESSION['email'];
$logistics  = $_POST['logisticsMethod'] ?? 'ship'; 
$payment    = $_POST['payment'] ?? 'bank';         
$products   = $_POST['products'] ?? [];            

$conn = new mysqli("localhost", "root", "", "webproject");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($logistics === 'pickup') {
    $payment = 'Cash';
}


$stmt = $conn->prepare("INSERT INTO Orders (email, paymentMethod, logisticsMethod) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $payment, $logistics);
$stmt->execute();
$orderID = $stmt->insert_id;
$stmt->close();


$itemStmt = $conn->prepare("INSERT INTO OrderItems (orderID, prodCode, quantity) VALUES (?, ?, ?)");
foreach ($products as $prodCode => $quantity) {
    // Cast to correct types
    $prodCode = (string)$prodCode;
    $quantity = (int)$quantity;

    $itemStmt->bind_param("isi", $orderID, $prodCode, $quantity);
    if (!$itemStmt->execute()) {
        echo "Error inserting item: " . $itemStmt->error;
    }
}
$itemStmt->close();


if ($logistics === 'ship') {
    $address       = $_POST['address'] ?? '';
    $apartmentSuite= $_POST['apt'] ?? '';
    $city          = $_POST['city'] ?? '';
    $province      = $_POST['province'] ?? '';
    $zipCode       = $_POST['zip'] ?? '';
    $phoneNumber   = $_POST['phone'] ?? '';

    $delStmt = $conn->prepare("INSERT INTO DeliveryDetails 
        (orderID, address, apartmentSuite, city, province, zipCode, phoneNumber) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $delStmt->bind_param("issssss", $orderID, $address, $apartmentSuite, $city, $province, $zipCode, $phoneNumber);
    $delStmt->execute();
    $delStmt->close();
}

$conn->close();

if ($orderID) {
    header("Location: checkout.php?order_status=success&orderID=$orderID");
} else {
    header("Location: checkout.php?order_status=failed");
}
exit;
?>