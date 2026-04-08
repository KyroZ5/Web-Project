<?php
session_start();

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "webproject";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    header("Location: index.php?signup_status=error&signup_msg=Database connection failed&tab=signup");
    exit;
}

$email      = $_POST['email'] ?? '';
$firstname  = $_POST['firstname'] ?? '';
$lastname   = $_POST['lastname'] ?? '';
$password   = $_POST['password'] ?? '';
$confirm    = $_POST['confirm_password'] ?? '';

if (empty($email) || empty($firstname) || empty($lastname) || empty($password) || empty($confirm)) {
    header("Location: index.php?signup_status=error&signup_msg=All fields are required&tab=signup");
    exit;
}

if ($password !== $confirm) {
    header("Location: index.php?signup_status=error&signup_msg=Passwords do not match&tab=signup");
    exit;
}

// 🔎 Check if email already exists
$check = $conn->prepare("SELECT email FROM accounts WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    header("Location: index.php?signup_status=error&signup_msg=Account already exists&tab=signup");
    $check->close();
    $conn->close();
    exit;
}
$check->close();

// Insert new account
$stmt = $conn->prepare("INSERT INTO accounts (email, firstname, lastname, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $email, $firstname, $lastname, $password);

if ($stmt->execute()) {
    header("Location: index.php?signup_status=success&signup_msg=Account created successfully&tab=signup");
} else {
    header("Location: index.php?signup_status=error&signup_msg=Error creating account&tab=signup");
}

$stmt->close();
$conn->close();
?>
