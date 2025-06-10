<?php
include '../koneksi.php';

function generatorRandom($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$namakategori = trim($_POST['nama_kategori']);
$target_dir = "../storage/upload/";
$image_name = basename($_FILES["image"]["name"]);
$file_type = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
$image_size = $_FILES["image"]["size"];
$random_name = generatorRandom(20);
$new_image_name = $random_name . "." . $file_type;
$target_file = $target_dir . $new_image_name;

// Cek apakah kategori sudah ada
$cek_duplikat = mysqli_query($koneksi, "SELECT * FROM kategoribuku WHERE Namakategori = '$namakategori'");
if (mysqli_num_rows($cek_duplikat) > 0) {
    header("location: kategori.php?pesan=duplikat");
    exit;
}

// Validasi file
if ($image_size > 5000000) { // 5MB
    echo "File terlalu besar";
    exit;
}
if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
    echo "Format file tidak valid";
    exit;
}
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
    echo "File bukan gambar valid.";
    exit;
}

// Upload gambar
if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "Gagal mengunggah file.";
    exit;
}

// Simpan ke tabel kategori buku
mysqli_report(MYSQLI_REPORT_OFF);
$query = mysqli_query($koneksi, "INSERT INTO kategoribuku (KategoriID, Namakategori, coverkategori)
VALUES ('','$namakategori','$new_image_name')");

if (!$query) {
    echo "Gagal menambah kategori buku: " . mysqli_error($koneksi);
    exit;
} else {
    header("location: kategori.php?pesan=berhasil");
}
exit;
?>
