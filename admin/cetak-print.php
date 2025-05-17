<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 40px;
            font-size: 14px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            border: 1px solid #eee;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,.15);
        }
        .header-text {
            text-align: center;
            margin-bottom: 40px;
        }
        .logo {
        width: 80px; 
        height: auto;
        margin-bottom: 10px;
        }
        .table th {
            width: 30%;
        }
        .badge {
            font-size: 12px;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

<?php 
session_start();
if ($_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
    exit;
}
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
        LEFT JOIN user ON user.UserID = peminjaman.UserID
        LEFT JOIN buku ON buku.BukuID = peminjaman.BukuID
        WHERE PeminjamanID='$id'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);
?>

<div class="invoice-box">
    <!-- Header -->
    <div class="header-text">
        <img src="../storage/img/logo.svg" class="logo" alt="Logo Perpustakaan">
        <h4 class="mb-1">PERPUSTAKAAN DIGITAL SMKN 7 BALEENDAH</h4>
        <h6 class="text-muted">LAPORAN PEMINJAMAN</h6>
    </div>

    <!-- Informasi Utama -->
    <table class="table table-borderless mb-0">
        <tr>
            <th>Nama Peminjam</th>
            <td>: <?= $data["Username"]; ?></td>
        </tr>
        <tr>
            <th>Judul Buku</th>
            <td>: <?= $data["Judul"]; ?></td>
        </tr>
        <tr>
            <th>Tanggal Peminjaman</th>
            <td>: <?= $data["TanggalPeminjaman"]; ?></td>
        </tr>
        <tr>
            <th>Tanggal Pengembalian</th>
            <td>: <?= $data["TanggalPengembalian"]; ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td>:
                <?php
                    if ($data["StatusPeminjaman"] === "Dipinjam") {
                        echo "<span class='badge bg-warning text-dark'>DIPINJAM</span>";
                    } else if ($data["StatusPeminjaman"] === "Dikembalikan") {
                        echo "<span class='badge bg-success'>DIKEMBALIKAN</span>";
                    } else {
                        echo "<span class='badge bg-secondary'>TIDAK DIKETAHUI</span>";
                    }
                ?>
            </td>
        </tr>
    </table>

    <!-- Spacer
    <div class="my-3">
        <strong>Detail Tambahan:</strong>
        <table class="table table-bordered mt-2">
            <thead class="table-light">
                <tr>
                    <th>Jenis Informasi</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kategori Buku</td>
                    <td><?= $data["Kategori"] ?? "-"; ?></td>
                </tr>
                <tr>
                    <td>Penulis</td>
                    <td><?= $data["Penulis"] ?? "-"; ?></td>
                </tr>
            </tbody>
        </table>
    </div> -->

    <!-- Footer -->
    <p class="text-center mt-4"><i>"Terima kasih telah menggunakan layanan perpustakaan kami."</i></p>
</div>

<?php 
    } else {
        echo "<div class='alert alert-danger'>Data tidak ditemukan.</div>";
    }
} else {
    echo "<div class='alert alert-warning'>ID tidak tersedia.</div>";
}
?>

</body>
</html>
