<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header('Location: ../login.php');
    exit;
}

require 'koneksi.php';
require 'layout/navbar.php';
?>


<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Pinjam "judulbuku"</h2>
  <div class="card shadow-sm p-4 d-flex flex-row">
    
    <!-- Gambar Buku -->
    <div class="me-4">
      <img src="../assets/img/buku-kue.jpg" alt="Kreativitas Pengolahan Kue & Roti" class="img-fluid" style="max-width: 200px;">
    </div>

    <!-- Formulir Peminjaman -->
    <div class="flex-grow-1">
      <form action="proses-peminjaman.php" method="post">
        <div class="mb-3">
          <label for="judul_buku" class="form-label">Judul Buku</label>
          <input type="text" class="form-control bg-light" id="judul_buku" name="judul_buku" value="Novel" readonly>
        </div>

        <div class="mb-3">
          <label for="tanggal_pinjam" class="form-label">Tanggal Peminjaman</label>
          <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" required>
        </div>

        <div class="mb-3">
          <label for="tanggal_kembali" class="form-label">Tanggal Pengembalian</label>
          <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" required>
        </div>

        <p class="text-muted">
          Apakah anda ingin meminjam buku ini dari <i>ddd-mmm-yyyy</i> sampai <i>ddd-mmm-yyyy</i>?<br>
          Penjelasan singkat tentang S&K peminjaman buku dan penalti jika tidak mengembalikan, 
          <a href="#" class="text-danger">baca lengkap S&K</a>.
        </p>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="setuju" required>
          <label class="form-check-label" for="setuju">
            Saya sudah memahami S&K yang ada.
          </label>
        </div>

        <button type="submit" class="btn btn-primary">Pinjam Buku</button>
        <a href="koleksi.php" class="btn btn-danger">Kembali</a>
      </form>
    </div>
  </div>
</div>
<?php
include 'layout/footer.php';
?>
</body>
</html>
