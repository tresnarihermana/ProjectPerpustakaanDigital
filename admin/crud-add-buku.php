<?php
include '../koneksi.php';

function generatorRandom($length = 10){
    $characters ='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for($i = 0; $i < $length; $i++){
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;

}

$judul = $_POST['Judul'];
$deskripsi = $_POST['Deskripsi'];
$penulis = $_POST['Penulis'];
$penerbit = $_POST['Penerbit'];
$tahun = $_POST['TahunTerbit'];
$kategori = $_POST['kategori'];
$target_dir = "../storage/upload/";
$image_name = basename($_FILES["image"]["name"]);
$target_file = $target_dir . $image_name;
$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$image_size = $_FILES["image"]["size"];
$random_name = generatorRandom(20);
$new_image_name = $random_name . "." . $file_type;

// Cek apakah buku dengan judul yang sama sudah ada
$cek = mysqli_query($koneksi, "SELECT * FROM buku WHERE Judul = '$judul'");

// if (mysqli_num_rows($cek) > 0) {
//     header("location: buku.php?pesan=duplikat");
//     exit;
// } else {
//     // Sesuaikan dengan jumlah dan urutan kolom di tabel buku
//     $query = mysqli_query($koneksi, 
//         "INSERT INTO buku (BukuID, Judul, Deskripsi, Penulis, Penerbit, TahunTerbit) 
//         VALUES ('$bukuid', '$judul', '$deskripsi', '$penulis', '$penerbit', '$tahun')"
//     );

//     if ($query) {
//         header("location: buku.php?pesan=berhasil");
//     } else {
//         header("location: buku.php?pesan=gagal");
//     }
// }

if ($image_size > 50000000) { //50MB
    echo "file terlalu besar";
} elseif (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
    echo "format file tidak valid";
} else {
if (mysqli_num_rows($cek) > 0) {
    header("location: buku.php?pesan=duplikat");
}elseif (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $new_image_name)) {
          $query = mysqli_query($koneksi, "INSERT INTO buku (BukuID, Judul, Deskripsi, Penulis, Penerbit, TahunTerbit, imagecover, KategoriID) 
        VALUES ('$bukuid', '$judul', '$deskripsi', '$penulis', '$penerbit', '$tahun', '$new_image_name', '$kategori')");
        if ($query) {
            header("location: buku.php?pesan=berhasil");
            exit;
        } else {
            header("location: buku.php?pesan=gagal");
            exit;
        }
    } else {
        echo "Gagal mengunggah file.";
    }
}
?>
