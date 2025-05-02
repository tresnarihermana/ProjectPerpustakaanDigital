<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
} else {
    include '../layout/sidebar-navbar-footbar.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard Admin</title>
</head>
<body>
    <div class="container-fluid justify-content-center col-4">
        <h1 class="mt-4">Dashboard Admin</h1>
        <p>Selamat datang di dashboard admin perpustakaan digital.</p>
        <p>Anda dapat mengelola data buku, anggota, dan transaksi peminjaman di sini.</p>
        <p>Silakan pilih menu di sidebar untuk mulai mengelola data.</p>
    </div>
</body>
</html>