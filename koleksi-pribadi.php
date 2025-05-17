<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: ../login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';
require 'layout/alert.php';

$user_id = $_SESSION['UserID'];

// Ambil semua data buku yang dimiliki user dari tabel koleksi_pribadi
$query = "
    SELECT buku.*, koleksipribadi.*, user.*  
    FROM koleksipribadi
    JOIN buku ON koleksipribadi.BukuID = buku.BukuID
    JOIN user ON koleksipribadi.UserID = user.UserID
    WHERE koleksipribadi.UserID = '$user_id'
    ORDER BY koleksiID DESC
";

$result = mysqli_query($koneksi, $query);
?>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Koleksi Pribadi</h2>
  <p>Hai, <?= htmlspecialchars($_SESSION['username']); ?>! Berikut buku yang kamu miliki di koleksi pribadimu:</p>

  <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($buku = mysqli_fetch_assoc($result)): ?>
      <div class="card mb-3 shadow-sm">
        <div class="row g-0">
          <div class="col-md-2 d-flex align-items-center justify-content-center">
            <img src="storage/upload/<?= htmlspecialchars($buku['imagecover']) ?>" class="img-fluid p-3" alt="<?= htmlspecialchars($buku['Judul']) ?>" style="max-height: 200px;">
          </div>
          <div class="col-md-10">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($buku['Judul']) ?></h5>
              <p class="card-text mb-2"><small class="text-muted">
                Penulis : <?= htmlspecialchars($buku['Penulis'])?> </br>
                Penerbit : <?= htmlspecialchars($buku['penerbit'])?> </br>
                Tahun Terbit : <?= htmlspecialchars($buku['TahunTerbit'])?> </br>
              </small></p>
              <a href="detail-buku.php?id=<?= $buku['BukuID'] ?>" class="btn btn-primary btn-sm me-2">Lihat Detail Buku</a>
              <a href="user/hapus-koleksi.php?id=<?=$buku['koleksiID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini dari koleksi?')">Hapus</a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>Kamu belum menambahkan buku apapun ke koleksi pribadi.</p>
  <?php endif; ?>

  <div class="text-center mt-4">
    <a href="beranda.php" class="btn btn-outline-secondary">Kembali ke Beranda</a>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
