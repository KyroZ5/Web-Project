<?php
session_start();

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "webproject";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    header("Location: index.php?login_status=error&login_msg=Database connection failed&tab=login");
    exit;
}

$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    header("Location: index.php?login_status=error&login_msg=Email and password required&tab=login");
    exit;
}

if ($email === "admin@gmail.com" && $password === "admin") {
    $_SESSION['email']     = $email;
    $_SESSION['firstname'] = "Admin";   
    $_SESSION['lastname']  = "";
    header("Location: admin.php");
    exit;
}

$stmt = $conn->prepare("SELECT email, firstname, lastname FROM accounts WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['email']     = $user['email'];
    $_SESSION['firstname'] = $user['firstname'];
    $_SESSION['lastname']  = $user['lastname'];

    header("Location: home.php?login_status=success&login_msg=Login successful");
} else {
    header("Location: index.php?login_status=error&login_msg=Invalid email or password&tab=login");
}

$stmt->close();
$conn->close();
?>
