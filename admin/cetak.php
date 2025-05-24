<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .logo {
            width: 100px;
            margin-bottom: 10px;
        }
        .header-text {
            margin-bottom: 30px;
        }
        .table th {
            width: 30%;
        }
        .card {
            padding: 20px;
            margin-top: 30px;
        }
        .btn-print {
            float: right;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php 
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
    exit;
}
include '../koneksi.php';
?>

<div class="container">
    <div class="card shadow">
        <?php 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                LEFT JOIN user ON user.UserID = peminjaman.UserID
                LEFT JOIN buku ON buku.BukuID = peminjaman.BukuID
                WHERE PeminjamanID='$id'");

            if (mysqli_num_rows($query) > 0) {
                $data = mysqli_fetch_array($query);
        ?>


        <!-- Header -->
        <div class="text-center header-text">
            <img src="../storage/img/logo.svg" class="logo" alt="Logo Perpustakaan">
            <h3 class="mb-0">PERPUSTAKAAN DIGITAL</h3>
            <small class="text-muted">LAPORAN PEMINJAMAN</small>
        </div>

        <!-- Tombol Cetak -->
        <div class="top-bar">
            <a href="cetak-print.php?id=<?= $id ?>" target="_blank" class="btn btn-primary btn-print ms-2">
                <i class="fa fa-print"></i> CETAK PDF
            </a>
            <a href="cetak-excel.php?id=<?= $id ?>" target="_blank" class="btn btn-success btn-print">
                <i class="fa fa-print"></i> CETAK XLSX
            </a>
        </div>

        <!-- Tabel Informasi -->
        <table class="table table-bordered">
            <tr>
                <th>Nama Peminjam</th>
                <td><?= $data["Username"]; ?></td>
            </tr>
            <tr>
                <th>Judul Buku</th>
                <td><?= $data["Judul"]; ?></td>
            </tr>
            <tr>
                <th>Tanggal Peminjaman</th>
                <td><?= $data["TanggalPeminjaman"]; ?></td>
            </tr>
            <tr>
                <th>Tanggal Pengembalian</th>
                <td><?= $data["TanggalPengembalian"]; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?php
                        if ($data["StatusPeminjaman"] === "Dipinjam") {
                            echo "<span class='badge bg-warning text-dark'>DIPINJAM</span>";
                        } else if ($data["StatusPeminjaman"] === "dikembalikan") {
                            echo "<span class='badge bg-success'>DIKEMBALIKAN</span>";
                        } else {
                            echo "<span class='badge bg-secondary'>TIDAK DIKETAHUI</span>";
                        }
                    ?>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <p class="text-center mt-4"><i>"Terima kasih telah menggunakan layanan perpustakaan kami."</i></p>

        <?php
            } else {
                echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>ID tidak tersedia.</div>";
        }
        ?>
    </div>
</div>

</body>
</html>
