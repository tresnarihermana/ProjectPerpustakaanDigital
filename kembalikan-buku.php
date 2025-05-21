<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.html');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';
include 'layout/alert.php';
$user_id = $_SESSION['UserID'];
$id_buku = $_GET['id'];
$data = mysqli_query($koneksi, 
"SELECT buku.*, peminjaman.*, user.* FROM peminjaman
JOIN buku ON peminjaman.BukuID = buku.BukuID
JOIN user ON peminjaman.UserID = user.userID
WHERE peminjaman.peminjamanID = '$id_buku'
"

);
$buku = mysqli_fetch_assoc($data);
$hari_ini = date('Y-m-d');
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
          <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="<?= htmlspecialchars($buku['TanggalPeminjaman'])?>" readonly>
        </div>

        <div class="mb-3">
          <label for="tanggal_kembali" class="form-label">Tanggal Pengembalian</label>
          <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" min ="<?=htmlspecialchars($hari_ini)?>" required>
        </div>

        <p class="text-muted">
          <span style="color:black;">Apakah anda ingin mengembalikan buku ini yang a<i>tanggal_kembali</i>?<br>
          <span style="color:grey;">Penjelasan singkat tentang S&K peminjaman buku dan penalti jika tidak mengembalikan,</span>
          <a href="#" class="text-danger">baca lengkap S&K</a>.
        </p>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="setuju" required>
          <label class="form-check-label" for="setuju">
            Saya sudah memahami S&K yang ada.
          </label>
        </div>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalBarcode">Kembalikan Buku</button>
        <a href="koleksi.php" class="btn btn-danger" style="float: right;">Kembali</a>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalBarcode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Barcode Peminjaman</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <svg id="barcode"></svg>
        <p class="mt-3">ID Peminjaman: <strong><?= $buku['peminjamanID'] ?></strong></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
  const modal = document.getElementById('ModalBarcode');
  modal.addEventListener('shown.bs.modal', function () {
    JsBarcode("#barcode", "<?= $buku['peminjamanID'] ?>", {
      format: "CODE128",
      lineColor: "#000",
      width: 2,
      height: 60,
      displayValue: true
    });
  });
</script>


<?php include 'layout/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

</body>
</html>
