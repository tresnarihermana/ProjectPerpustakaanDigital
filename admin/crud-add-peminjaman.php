<?php
include '../koneksi.php';

$id_user = $_POST['id_user'];
$id_buku = $_POST['id_buku'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$status = $_POST['status'];

// Validasi duplikat (opsional, contoh: user tidak bisa pinjam buku yang sama dua kali saat masih dipinjam)
$cek = mysqli_query($koneksi, 
    "SELECT * FROM peminjaman 
     WHERE id_user = '$id_user' AND id_buku = '$id_buku' AND status = 'Dipinjam'"
);

if (mysqli_num_rows($cek) > 0) {
    header("location: peminjaman.php?pesan=duplikat");
    exit;
} else {
    $query = mysqli_query($koneksi, 
        "INSERT INTO peminjaman (id_user, id_buku, tanggal_pinjam, tanggal_kembali, status) 
         VALUES ('$id_user', '$id_buku', '$tgl_pinjam', '$tgl_kembali', '$status')"
    );

    if ($query) {
        header("location: peminjaman.php?pesan=berhasil");
    } else {
        header("location: peminjaman.php?pesan=gagal");
    }
}
?>
