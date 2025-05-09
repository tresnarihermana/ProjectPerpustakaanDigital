<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header('Location: ../login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';

// Contoh data dummy, nanti bisa diganti dari database
$riwayat = [
    [
        'judul' => 'Kreativitas Pengolahan Kue & Roti',
        'cover' => '../assets/kue-roti.jpg',
        'tgl_pinjam' => '01-05-2025',
        'tgl_kembali' => '08-05-2025',
        'status' => 'hampir', // 'hampir', 'selesai', 'belum'
    ],
    [
        'judul' => 'Kreativitas Pengolahan Kue & Roti',
        'cover' => '../assets/kue-roti.jpg',
        'tgl_pinjam' => '22-04-2025',
        'tgl_kembali' => '29-04-2025',
        'status' => 'selesai',
    ],
    [
        'judul' => 'Kreativitas Pengolahan Kue & Roti',
        'cover' => '../assets/kue-roti.jpg',
        'tgl_pinjam' => '10-04-2025',
        'tgl_kembali' => '17-04-2025',
        'status' => 'belum',
    ],
];
?>

<style>
@media (min-width: 992px) {
    body { margin-left: 240px; }
}
</style>

<div class="mx-5 mt-4">
    <a href="javascript:history.back()" class="text-decoration-none mb-3 d-block">&lt; back</a>
    <h3 class="fw-bold">Riwayat Buku Dipinjam</h3>
    <p class="text-muted">Username</p>

    <?php foreach ($riwayat as $buku): ?>
        <div class="card shadow-sm mb-4 p-3">
            <div class="card-body d-flex align-items-start">
                <img src="storage/img/cover-kreativitas.png" alt="cover buku" class="me-3" style="width: 130px; height: auto;">
                <div class="flex-grow-1">
                    <h5 class="fw-bold"><?= $buku['judul'] ?></h5>
                    <div class="mb-2">
                       <label for="">Tanggal Peminjaman</label>
                       <input type="text" class="form-control" value="<?= $buku['tgl_pinjam'] ?>" readonly>
                    </div>
                    <div class="mb-2">
                       <label for="">Tanggal Pengembalian</label>
                       <input type="text" class="form-control" value="<?= $buku['tgl_kembali'] ?>" readonly>
                    </div>
                    <a href="#" class="btn btn-primary btn-sm me-2">Kunjungi Halaman</a>
                    <?php if ($buku['status'] == 'hampir'): ?>
                        <span class="btn btn-warning btn-sm">Hampir Tenggat Waktu ⚠️</span>
                    <?php elseif ($buku['status'] == 'selesai'): ?>
                        <span class="btn btn-success btn-sm">Sudah Dikembalikan ✔</span>
                    <?php elseif ($buku['status'] == 'belum'): ?>
                        <span class="btn btn-danger btn-sm">Belum Dikembalikan ⚠️</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="text-center mt-4">
        <a href="#" class="btn btn-outline-primary">Lihat Lebih Banyak</a>
    </div>
</div>
<?php
    include 'layout/footer.php';
    ?>
</body>
</html>