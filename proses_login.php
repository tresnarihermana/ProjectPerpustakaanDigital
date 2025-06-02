<?php
session_start();
include 'koneksi.php';

$username = $_POST['Username'];
$password = md5($_POST['Password']);

$stmt = $koneksi->prepare("SELECT UserID, role FROM user WHERE Username = ? AND Password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    $_SESSION['username'] = $username;
    $_SESSION['status'] = 'login';
    $_SESSION['role'] = $user['role'];
    $_SESSION['UserID'] = $user['UserID'];

    if ($user['role'] == 'user') {
        header("Location: index.php");
        exit();
    } else if ($user['role'] == 'admin' || $user['role'] == 'petugas') {
        header("Location: admin/index.php");
        exit();
    }
} else {
    header("Location: login.php?pesan=gagallogin");
    exit();
}
?>
