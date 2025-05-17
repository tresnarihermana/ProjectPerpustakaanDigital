<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("Location: login.php");
    exit;
} else {
    include 'layout/navbar.php';
    include 'koneksi.php';
}
$id_buku = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID = '$_GET[id]'");
$buku = mysqli_fetch_assoc($data);

$data_ulasan = mysqli_query($koneksi, "
  SELECT ulasanbuku.*, user.Username
  FROM ulasanbuku
  JOIN user ON ulasanbuku.UserID = user.UserID
  WHERE ulasanbuku.BukuID = '$id_buku'
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <style>

    </style>
</head>
<body>
<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Detail Buku</h2>
  <div class="card shadow-sm mb-4">
    <div class="card-body d-flex">
      <img src="storage/img/cover-kreativitas.png" alt="Cover Buku" class="me-4" style="width: 200px; height: auto;">
      <div>
        <h4 class="fw-bold"><?=htmlspecialchars($buku['Judul'])?></h4>
        <table class="table table-borderless">
          <tr>
            <th>Bahasa</th><td>: bahasa-buku</td>
            <th>Halaman</th><td>: ...pages</td>
          </tr>
          <tr>
            <th>Tahun Rilis</th><td>:<?=htmlspecialchars($buku['TahunTerbit'])?></td>
            <th>Penerbit</th><td>:<?=htmlspecialchars($buku['penerbit'])?></td>
          </tr>
          <tr>
            <th>Penulis</th><td>: nama-penulis</td>
            <th>Kategori</th><td>: kategori-buku</td>
          </tr>
        </table>
        <div class="mt-3">
          <a href="#" class="btn btn-primary me-2">Pinjam</a>
          <a href="#" class="btn btn-success">Simpan ke Koleksi</a>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="fw-bold mb-3">Deskripsi</h5>
     <?= htmlspecialchars($buku['Deskripsi']) ;
     ?>
    </div>
  </div>
  <div class="d-flex justify-content-end mb-3">
  <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalUlasan">
    <i class="bi bi-plus-circle me-1"></i> Tambah Ulasan
  </button>
</div>

  <div class="card shadow-sm">
  <div class="card-body">
    <h5 class="fw-bold mb-4 border-bottom pb-2">Ulasan Pengguna</h5>

    <?php
    if (mysqli_num_rows($data_ulasan) > 0) {
      while ($ulasan = mysqli_fetch_assoc($data_ulasan)) {
    ?>
      <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div>
            <h6 class="mb-0 fw-semibold"><?= htmlspecialchars($ulasan['Username']) ?></h6>
            <small class="text-muted"><?= date('d M Y', strtotime($ulasan['TanggalUlasan'] ?? 'now')) ?></small>
          </div>
          <div>
            <?php
              $rating = (int)$ulasan['Rating'];
              for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                  echo '<i class="bi bi-star-fill text-warning"></i>';
                } else {
                  echo '<i class="bi bi-star text-secondary"></i>';
                }
              }
            ?>
          </div>
        </div>
        <div class="bg-light p-3 rounded border">
          <p class="mb-0"><?= nl2br(htmlspecialchars($ulasan['Ulasan'])) ?></p>
        </div>
      </div>
    <?php
      }
    } else {
      echo "<p class='text-muted'>Belum ada ulasan untuk buku ini.</p>";
    }
    ?>
  </div>
</div>

    </div>
  </div>
</div>

    <?php
    include 'layout/footer.php';
    ?>

<div class="modal fade" id="modalUlasan" tabindex="-1" aria-labelledby="modalUlasanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="crud-tambah-ulasan.php" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUlasanLabel">Tulis Ulasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="buku_id" value="<?= htmlspecialchars($id_buku) ?>">

        <div class="mb-3">
          <label class="form-label">Rating</label>
          <select name="rating" id="rating" class="form-control bg-light" required>
              <option value="" disabled selected>-- Pilih Rating --</option>
              <option value="1">1 - Sangat Buruk</option>
              <option value="2">2 - Buruk</option>
              <option value="3">3 - Cukup</option>
              <option value="4">4 - Baik</option>
              <option value="5">5 - Sangat Baik</option>
            </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Ulasan</label>
          <textarea class="form-control" name="ulasan" rows="4" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Kirim</button>
      </div>
    </form>
  </div>
</div>
</body>
</html>