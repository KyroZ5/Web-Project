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

$currentEmail = $_SESSION["email"];


$firstname        = trim($_POST['first_name']);
$lastname         = trim($_POST['last_name']);
$newEmail         = trim($_POST['email']);
$currentPassword  = $_POST['current_password'];
$newPassword      = $_POST['new_password'];
$confirmPassword  = $_POST['confirm_password'];


$sql = "SELECT password FROM accounts WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $currentEmail);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<script>alert('Account not found.'); window.location.href='edit_account.php';</script>";
    exit;
}

$updateFields = [];
$params = [];
$types = "";


$updateFields[] = "firstname = ?";
$params[] = $firstname;
$types .= "s";

$updateFields[] = "lastname = ?";
$params[] = $lastname;
$types .= "s";


if ($newEmail !== $currentEmail) {
    $updateFields[] = "email = ?";
    $params[] = $newEmail;
    $types .= "s";
}


if (!empty($newPassword)) {
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New password and confirmation do not match.'); window.location.href='edit_account.php';</script>";
        exit;
    }

  
    if (empty($currentPassword) || $currentPassword !== $user['password']) {
        echo "<script>alert('Current password is incorrect.'); window.location.href='edit_account.php';</script>";
        exit;
    }

    $updateFields[] = "password = ?";
    $params[] = $newPassword;  
    $types .= "s";
}


$sqlUpdate = "UPDATE accounts SET " . implode(", ", $updateFields) . " WHERE email = ?";
$params[] = $currentEmail;
$types .= "s";

$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param($types, ...$params);

if ($stmtUpdate->execute()) {
    if ($newEmail !== $currentEmail) {
        $_SESSION["email"] = $newEmail;
    }
    echo "<script>alert('Account updated successfully.'); window.location.href='profile.php';</script>";
} else {
    echo "<script>alert('Error updating account.'); window.location.href='edit_account.php';</script>";
}
?>
