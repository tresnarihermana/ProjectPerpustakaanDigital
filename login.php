<?php
session_start();
include 'koneksi.php';
$username = $_GET['Username'];
$password = $_GET['Password'];
$data = mysqli_query($koneksi,"select * from user where Username ='$username'and Password='$password'");
$cek = mysqli_num_rows($data);
$role = mysqli_fetch_array($data)['role'];
if($cek > 0 && $role == 'user'){
    $_SESSION['username']= $username;
    $_SESSION['status'] = "login";
    header ("location: index.html");
}else if($cek > 0 && $role == 'admin' or $role == 'petugas'){
    header ("location: admin/index.html");
}else{
    header ("location: login.html?pesan=gagal");
}

?>