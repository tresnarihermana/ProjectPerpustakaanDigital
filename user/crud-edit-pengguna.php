<?php
session_start();
include '../koneksi.php';
$id = $_POST['UserID'];
$username = $_POST['Username'];
$password = md5($_POST['Password']);
$email = $_POST['Email'];
$namalengkap = $_POST['NamaLengkap'];
$alamat = $_POST['Alamat'];
$email = $_POST['Email'] ?? '';

if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/', $email)) {
    header("location:../edit-profile.php?pesan=gagal");
    die;
}else{

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE Username = '$username' AND UserID != '$id'");
$cek = mysqli_fetch_assoc($data);

if (mysqli_num_rows($data) > 0) {
    header("location:../edit-profile.php?pesan=duplikat");
} else {
    $query = "UPDATE user SET Username = '$username', Password = '$password', Email = '$email', NamaLengkap = '$namalengkap', Alamat = '$alamat' WHERE UserID = '$id'";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['username'] = $username;
        header("location:../edit-profile.php?pesan=berhasil");
    } else {
        header("location:../edit-profile.php?pesan=gagal");
    }
}


}
?>