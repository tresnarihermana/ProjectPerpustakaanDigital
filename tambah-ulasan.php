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
    <title>Document</title>
</head>
<body>
<div class="modal fade" id="modalUlasan" tabindex="-1" aria-labelledby="modalUlasanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="proses-ulasan.php" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUlasanLabel">Tulis Ulasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="buku_id" value="<?= htmlspecialchars($id_buku) ?>">

        <div class="mb-3">
          <label class="form-label">Rating</label>
          <select class="form-select" name="rating" required>
            <option value="">Pilih rating</option>
            <?php for ($i = 5; $i >= 1; $i--): ?>
              <option value="<?= $i ?>"><?= $i ?> Bintang</option>
            <?php endfor; ?>
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

