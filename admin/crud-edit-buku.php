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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bukuid = $_POST['BukuID'];
    $judul = $_POST['Judul'];
    $deskripsi = $_POST['Deskripsi'];
    $penulis = $_POST['Penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['TahunTerbit'];

    // Ambil data buku lama dulu untuk cek gambar lama
    $result = mysqli_query($koneksi, "SELECT imagecover FROM buku WHERE BukuID = '$bukuid'");
    $dataLama = mysqli_fetch_assoc($result);
    $oldImage = $dataLama['imagecover'];

    $target_dir = "../storage/upload/";

    // Cek apakah ada file baru yang diupload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES["image"]["name"]);
        $file_type = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $image_size = $_FILES["image"]["size"];
        $random_name = generatorRandom(20);
        $new_image_name = $random_name . "." . $file_type;

        // Validasi ukuran & tipe file
        if ($image_size > 50000000) {
            die("File terlalu besar, maksimal 5MB.");
        }
        if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
            die("Format file tidak valid. Harus jpg, jpeg, png, atau gif.");
        }

        // Upload file baru
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $new_image_name)) {
            // Hapus file lama jika ada
            if (!empty($oldImage) && file_exists($target_dir . $oldImage)) {
                unlink($target_dir . $oldImage);
            }

            // Update data dengan gambar baru
            $query = "UPDATE buku SET 
                Judul='$judul', 
                Deskripsi='$deskripsi', 
                Penulis='$penulis', 
                Penerbit='$penerbit', 
                TahunTerbit='$tahun', 
                imagecover='$new_image_name' 
                WHERE BukuID='$bukuid'";
        } else {
            die("Gagal mengunggah file.");
        }
    } else {
        // Jika tidak upload gambar baru, update tanpa mengganti imagecover
        $query = "UPDATE buku SET 
            Judul='$judul', 
            Deskripsi='$deskripsi', 
            Penulis='$penulis', 
            Penerbit='$penerbit', 
            TahunTerbit='$tahun' 
            WHERE BukuID='$bukuid'";
    }

    $update = mysqli_query($koneksi, $query);

    if ($update) {
        header("Location: buku.php?pesan=berhasil");
        exit;
    } else {
        header("Location: buku.php?pesan=gagal");
        exit;
    }
} else {
    // Jika bukan POST, redirect ke halaman buku
    header("Location: buku.php");
    exit;
}
?>
