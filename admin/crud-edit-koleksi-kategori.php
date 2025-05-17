<?php
include '../koneksi.php';

$kategoribukuid = $_POST['KategoribukuID'];
$kategoriID = $_POST['kategori'];
$bukuDipilih = isset($_POST['buku']) ? $_POST['buku'] : [];

// Hapus relasi lama berdasarkan kategori ID
$hapus = mysqli_query($koneksi, "DELETE FROM Kategoribuku_relasi WHERE KategoriID = '$kategoriID'");

// Tambahkan kembali relasi yang baru dipilih dari checkbox
$berhasil = true;
foreach ($bukuDipilih as $bukuid) {
    $insert = mysqli_query($koneksi, "INSERT INTO Kategoribuku_relasi (KategoriID, BukuID) VALUES ('$kategoriID', '$bukuid')");
    if (!$insert) {
        $berhasil = false;
        break;
    }
}

// Redirect sesuai hasil
if ($berhasil) {
    header("Location: koleksi-kategori.php?pesan=berhasil");
} else {
    header("Location: koleksi-kategori.php?pesan=gagal");
}
?>
