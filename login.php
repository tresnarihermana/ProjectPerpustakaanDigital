<?php
session_start();
include 'koneksi.php';
$username = $_GET['Username'];
$password = $_GET['Password'];

$data = mysqli_query($koneksi,"select * from user where Username ='$username'and Password='$password'");
$cek = mysqli_num_rows($data);

if($cek > 0){
    $_SESSION['username']= $username;
    $_SESSION['status'] = "login";
    header ("location: index.html");
}else{
    header ("location: index.php?pesan=gagal");
}
?>