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

$judul = mysqli_real_escape_string($koneksi, $_POST['Judul']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['Deskripsi']);
$penulis = $_POST['Penulis'];
$penerbit = $_POST['Penerbit'];
$tahun = $_POST['TahunTerbit'];
$stok = $_POST['stok'];
$ebook =$_POST['ebook'];
$kategoriID = $_POST['kategori'];
$target_dir = "../storage/upload/";
$image_name = basename($_FILES["image"]["name"]);
$file_type = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
$image_size = $_FILES["image"]["size"];
$random_name = generatorRandom(20);
$new_image_name = $random_name . "." . $file_type;
$target_file = $target_dir . $new_image_name;

// Validasi file
if ($image_size > 50000000) { // 50MB
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

// Simpan ke tabel buku
mysqli_report(MYSQLI_REPORT_OFF);
$query = mysqli_query($koneksi, "INSERT INTO buku (Judul, Deskripsi, Penulis, Penerbit, TahunTerbit, stok, ebook, imagecover) 
    VALUES ('$judul', '$deskripsi', '$penulis', '$penerbit', '$tahun', '$stok','$ebook', '$new_image_name')");

if (!$query) {
    // Jika gagal insert karena duplikat atau lainnya
    if (mysqli_errno($koneksi) == 1062) {
        header("location: buku.php?pesan=duplikat");
    } else {
        echo "Gagal menambah buku: " . mysqli_error($koneksi);
    }
    exit;
}

// Ambil ID buku terakhir yang di-insert
$bukuid = mysqli_insert_id($koneksi);

// Tambahkan ke tabel relasi
$kategori = mysqli_query($koneksi, "INSERT INTO Kategoribuku_relasi (BukuID, KategoriID) 
    VALUES ('$bukuid', '$kategoriID')");

if ($kategori) {
    header("location: buku.php?pesan=berhasil");
} else {
    echo "Gagal menambah relasi kategori: " . mysqli_error($koneksi);
}
exit;
?>
