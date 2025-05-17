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

$kategoriID = $_POST['kategoriID'];
$namakategori = $_POST['nama_kategori'];
$target_dir = "../storage/upload/";
$image_uploaded = isset($_FILES["image"]) && $_FILES["image"]["error"] === 0;

$new_image_name = null;

// Ambil data lama untuk mengetahui nama file cover sebelumnya
$data_lama = mysqli_query($koneksi, "SELECT coverkategori FROM kategoribuku WHERE KategoriID = '$kategoriID'");
$lama = mysqli_fetch_assoc($data_lama);
$cover_lama = $lama['coverkategori'] ?? null;

if ($image_uploaded) {
    $image_name = basename($_FILES["image"]["name"]);
    $file_type = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $image_size = $_FILES["image"]["size"];
    $random_name = generatorRandom(20);
    $new_image_name = $random_name . "." . $file_type;
    $target_file = $target_dir . $new_image_name;

    // Validasi file
    if ($image_size > 50000000) {
        echo "File terlalu besar";
        exit;
    }
    if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Format file tidak valid";
        exit;
    }

    // Upload gambar
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Gagal mengunggah file.";
        exit;
    }

    // Hapus file lama jika ada dan bukan default
    if (!empty($cover_lama) && file_exists($target_dir . $cover_lama)) {
        unlink($target_dir . $cover_lama);
    }
}

// Buat query update
if ($image_uploaded) {
    $query = mysqli_query($koneksi, "UPDATE kategoribuku 
        SET Namakategori = '$namakategori', coverkategori = '$new_image_name' 
        WHERE KategoriID = '$kategoriID'");
} else {
    $query = mysqli_query($koneksi, "UPDATE kategoribuku 
        SET Namakategori = '$namakategori' 
        WHERE KategoriID = '$kategoriID'");
}

// Cek hasil
if (!$query) {
    echo "Gagal mengupdate kategori buku: " . mysqli_error($koneksi);
    exit;
} else {
    header("location: kategori.php?pesan=berhasil");
    exit;
}
?>
