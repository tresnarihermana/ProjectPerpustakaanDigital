<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';
require 'layout/alert.php';
$user_id = $_SESSION['UserID'];

// Ambil data peminjaman user (hanya yang masih dipinjam)
$query = "
    SELECT 
        b.BukuID,
        b.Judul AS judul,
        b.imagecover,
        p.peminjamanID AS pinjamid,
        p.TanggalPeminjaman AS tgl_pinjam,
        p.TanggalPengembalian AS tgl_kembali,
        p.StatusPeminjaman
    FROM peminjaman p
    JOIN buku b ON p.BukuID = b.BukuID
    WHERE p.UserID = '$user_id' AND StatusPeminjaman != 'dikembalikan'
    ORDER BY p.peminjamanID DESC
";



$result = mysqli_query($koneksi, $query);
$riwayat = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Hitung status di PHP
    $today = date('Y-m-d');
    $tgl_kembali = $row['tgl_kembali'];

    if ($row['StatusPeminjaman'] == 'dikembalikan') {
        $row['status'] = 'selesai';
    } elseif ($today > $tgl_kembali) {
        $row['status'] = 'belum';
    } elseif ((strtotime($tgl_kembali) - strtotime($today)) / (60 * 60 * 24) <= 2) {
        $row['status'] = 'hampir';
    } else {
        $row['status'] = 'belum';
    }

    $riwayat[] = $row;
}
?>

<div class="mx-5 mt-4">
    <h2 class="mb-3 fw-bold">Riwayat Peminjaman</h2>
    <p>Hai, <?= htmlspecialchars($_SESSION['username']); ?>! Berikut buku yang sedang kamu pinjam:</p>

    <?php if (count($riwayat) > 0): ?>
        <?php foreach ($riwayat as $buku): ?>
            <div class="card shadow-sm mb-4 p-3">
                <div class="card-body d-flex align-items-start">
                    <img src="storage/upload/<?= htmlspecialchars($buku['imagecover']) ?>" alt="cover buku" class="me-3" style="width: 130px; height: auto;">
                    <div class="flex-grow-1">
                        <h5 class="fw-bold"><?= htmlspecialchars($buku['judul']) ?></h5>
                        <div class="mb-2">
                           <label for="">Tanggal Peminjaman</label>
                           <input type="text" class="form-control" value="<?= date('d M Y', strtotime($buku['tgl_pinjam'])) ?>" readonly>
                        </div>
                        <div class="mb-2">
                        <label for="">Tanggal Pengembalian</label>
                        <input type="text" class="form-control" value="<?= date('d M Y', strtotime($buku['tgl_kembali'])) ?>" readonly>
                        
                                
                        </div>
                        <a href="detail-buku.php?id=<?= $buku['BukuID'] ?>" class="btn btn-primary btn-sm me-2">Kunjungi Halaman</a>
                        <?php if ($buku['status'] == 'hampir'): ?>
                            <span class="btn btn-warning btn-sm">Hampir Tenggat Waktu ⚠️</span>
                        <?php elseif ($buku['status'] == 'selesai'): ?>
                            <span class="btn btn-success btn-sm">Sudah Dikembalikan ✔</span>
                        <?php elseif ($buku['status'] == 'belum'): ?>
                            <span class="btn btn-danger btn-sm">Belum Dikembalikan ⚠️</span>
                        <?php endif; ?>
                        <a href="kembalikan-buku.php?id=<?=$buku['pinjamid']?>" class="btn btn-success btn-sm ms-2">Kembalikan Buku</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">Kamu belum meminjam buku apapun saat ini.</div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="daftar-buku.php" class="btn btn-primary">Lihat Semua Koleksi Buku</a>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
