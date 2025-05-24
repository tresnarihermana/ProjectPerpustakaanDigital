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

$bukuID     = $_POST['BukuID'];
$judul      = mysqli_real_escape_string($koneksi, $_POST['Judul']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['Deskripsi']);
$penulis    = $_POST['Penulis'];
$penerbit   = $_POST['penerbit'];
$tahun      = $_POST['TahunTerbit'];
$kategoriID = $_POST['kategori'];
$stok      = $_POST['stok'];
$ebook     = $_POST['ebook'];

$update_image = '';
$new_image_name = '';

// Jika ada file baru diupload
if (!empty($_FILES['image']['name'])) {
    $target_dir   = "../storage/upload/";
    $image_name   = basename($_FILES["image"]["name"]);
    $file_type    = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $image_size   = $_FILES["image"]["size"];
    $random_name  = generatorRandom(20);
    $new_image_name = $random_name . "." . $file_type;
    $target_file  = $target_dir . $new_image_name;

    // Validasi file
    if ($image_size > 50000000) {
        echo "File terlalu besar";
        exit;
    }
    if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Format file tidak valid";
        exit;
    }

    // Upload file baru
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Gagal mengunggah file.";
        exit;
    }

    // Tambahkan field imagecover ke query
    $update_image = ", imagecover = '$new_image_name'";
}

// Update data buku
$query = "UPDATE buku SET 
            Judul = '$judul',
            Deskripsi = '$deskripsi',
            Penulis = '$penulis',
            Penerbit = '$penerbit',
            TahunTerbit = '$tahun',
            stok = '$stok',
            ebook = '$ebook'
            $update_image
          WHERE BukuID = '$bukuID'";

$result = mysqli_query($koneksi, $query);
if (!$result) {
    echo "Gagal update buku: " . mysqli_error($koneksi);
    exit;
}

// Cek apakah kategori diisi (opsional)
if (!empty($kategoriID)) {
    // Cek apakah relasi sudah ada
    $cekRelasi = mysqli_query($koneksi, "SELECT * FROM Kategoribuku_relasi WHERE BukuID = '$bukuID'");
    if (mysqli_num_rows($cekRelasi) > 0) {
        // Update relasi
        mysqli_query($koneksi, "UPDATE Kategoribuku_relasi SET KategoriID = '$kategoriID' WHERE BukuID = '$bukuID'");
    } else {
        // Insert relasi baru
        mysqli_query($koneksi, "INSERT INTO Kategoribuku_relasi (BukuID, KategoriID) VALUES ('$bukuID', '$kategoriID')");
    }
}


header("location: buku.php?pesan=berhasil");
exit;
?>
