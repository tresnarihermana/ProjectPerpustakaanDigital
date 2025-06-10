<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
    exit;
}

include 'koneksi.php';
include 'layout/navbar.php';

// Ambil data buku berdasarkan ID dari URL

$id_buku = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID = '$id_buku'");
$buku = mysqli_fetch_assoc($data);
$min_date = date('Y-m-d');
$max_date = date('Y-m-d', strtotime($min_date . ' +7 days'));


if ($buku['stok'] <= 0) {
    echo "<h2 class='mx-5 mt-4'>Buku ini tidak tersedia untuk dipinjam!</h2>";
    exit;
}
?>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Pinjam "<?= htmlspecialchars($buku['Judul']) ?>"</h2>
  <div class="card shadow-sm p-4 d-flex flex-row flex-wrap">
    
    <!-- Gambar Buku -->
    <div class="me-4 mb-3" style="max-width: 200px;">
      <img 
        src="storage/upload/<?= htmlspecialchars($buku['imagecover']) ?>" 
        alt="<?= htmlspecialchars($buku['Judul']) ?>" 
        class="img-fluid rounded shadow-sm"
      >
    </div>

    <!-- Formulir Peminjaman -->
    <div class="flex-grow-1">
      <form action="user/proses-peminjaman.php" method="post">
        <input type="hidden" name="buku_id" value="<?= $buku['BukuID'] ?>">

        <div class="mb-3">
          <label for="judul_buku" class="form-label">Judul Buku</label>
          <input type="text" class="form-control bg-light" id="judul_buku" name="judul_buku" value="<?= htmlspecialchars($buku['Judul']) ?>" readonly>
        </div>

        <div class="mb-3">
          <label for="tanggal_pinjam" class="form-label">Tanggal Peminjaman</label>
          <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" min="<?= $min_date?>" max="<?=$max_date?>" required>
        </div>

        <div class="mb-3">
          <label for="tanggal_kembali" class="form-label">Tanggal Pengembalian</label>
          <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" min="<?= $min_date?>" max="<?=$max_date?>" required>
        </div>

        <p class="text-muted">
          <span style="color:black;">Apakah anda ingin meminjam buku ini dari <i>tanggal_pinjam</i> sampai <i>tanggal_kembali</i>?<br>
          <span style="color:grey;">Penjelasan singkat tentang S&K peminjaman buku dan penalti jika tidak mengembalikan,</span>
        </p>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="setuju" required>
          <label class="form-check-label" for="setuju">
            Saya sudah memahami S&K yang ada.
          </label>
        </div>

        <button type="submit" class="btn btn-primary">Pinjam Buku</button>
        <a href="detail-buku.php?id=<?= $buku['BukuID']?>"  class="btn btn-danger">Kembali</a>
      </form>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
