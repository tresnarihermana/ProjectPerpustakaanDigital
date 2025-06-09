<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('Location: login.php');
    exit;
}

require 'koneksi.php';
include 'layout/alert.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['check_status']) && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $query = mysqli_query($koneksi, "SELECT StatusPeminjaman FROM peminjaman WHERE peminjamanID = '$id'");
    $result = mysqli_fetch_assoc($query);
    echo json_encode(['status' => $result['StatusPeminjaman']]);
    exit;
}

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
if ($buku['StatusPeminjaman'] == 'dikembalikan') {
    header("Location: daftar-peminjaman.php?pesan=berhasil");
    exit;
}
require 'layout/navbar.php';
?>
<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Kembalikan "<?= htmlspecialchars($buku['Judul']) ?>"</h2>
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
          <input type="text" class="form-control" name="tanggal_kembali" value="<?= date('m/d/Y') ?>" readonly>

        </div>

        <p class="text-muted">
          <span style="color:black;"> Dengan menekan tombol "<strong>Kembalikan Buku</strong>",<br>
          <span style="color:grey;">Anda menyatakan bahwa Anda akan mengembalikan buku ini sesuai dengan informasi yang tertera</span>
          <a href="syarat-dan-ketentuan.php" class="text-danger">baca lengkap S&K</a>.
        </p>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="setuju" required>
          <label class="form-check-label" for="setuju">
            Saya sudah memahami S&K yang ada.
          </label>
        </div>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalBarcode">Kembalikan Buku</button>
        <a href="daftar-peminjaman.php" class="btn btn-danger" style="float: right;">Kembali</a>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalBarcode" tabindex="-1" aria-labelledby="ModalBarcodeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- Tengah secara vertikal -->
    <div class="modal-content shadow-lg rounded-4 border-0">
      <div class="modal-header bg-primary text-white rounded-top">
        <h5 class="modal-title d-flex align-items-center gap-2" id="ModalBarcodeLabel">
          <i class="fa-solid fa-qrcode fa-lg"></i> Barcode Peminjaman
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <div class="mb-4">
          <svg id="barcode" class="mx-auto" style="width: 220px; height: 80px;"></svg>
        </div>
        <p class="fs-5 fw-semibold mb-1">ID Peminjaman:</p>
        <p class="fs-4 text-primary fw-bold mb-3"><?= htmlspecialchars($buku['peminjamanID']) ?></p>
        <div class="alert alert-info d-flex align-items-center justify-content-center gap-2 py-3">
          <i class="fa-solid fa-info-circle fa-xl"></i>
          <span class="fs-6">Tunggu petugas untuk memindai barcode ini.</span>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-outline-primary px-4" data-bs-dismiss="modal">
          <i class="fa-solid fa-xmark me-2"></i> Tutup
        </button>
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

<script>
  const peminjamanID = "<?= $buku['peminjamanID'] ?>";

  // Cek status pengembalian setiap 3 detik
  const intervalID = setInterval(() => {
    fetch("", {
      method: "POST",
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `check_status=1&id=${peminjamanID}`
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'dikembalikan') {
        clearInterval(intervalID);

        window.location.href = "daftar-peminjaman.php?pesan=berhasil";
      }
    });
  }, 3000);
</script>
<?php include 'layout/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

</body>
</html>
