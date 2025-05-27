<?php
session_start();
include 'koneksi.php';


$user = $_SESSION['UserID'];
$buku = $_POST['buku_id'];
$rating = $_POST['rating'];
$ulasan = $_POST['ulasan'];

$cek = mysqli_query($koneksi, "
SELECT * FROM ulasanbuku 
WHERE UserID = '$user' AND BukuID = '$buku'");
if (mysqli_num_rows($cek) > 0){
    header("location: detail-buku.php?id=$buku&pesan=duplikat");
}else{
// Simpan ke database
mysqli_query($koneksi, "
  INSERT INTO ulasanbuku (UserID, BukuID, Ulasan, Rating) 
        VALUES ('$user', '$buku', '$ulasan', '$rating')
");

header("Location: detail-buku.php?id=$buku");
exit;
}
?>
