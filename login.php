<?php
session_start();
include 'koneksi.php';

$username = $_POST['Username'];
$password = $_POST['Password'];

$data = mysqli_query($koneksi,"SELECT * FROM user WHERE Username='$username' AND Password='$password'");
$cek = mysqli_num_rows($data);
$user = mysqli_fetch_assoc($data);
$role = $user['role'];

$_SESSION['username'] = $username;
$_SESSION['status'] = 'login';
$_SESSION['role'] = $role;

if($cek > 0){

    if($role == 'user'){
        header("location: index.php");
    } else if($role == 'admin' || $role == 'petugas'){
        header("location: admin/index.php");
    }
} else {
    header("location: login.html?pesan=gagal");
}
?>
