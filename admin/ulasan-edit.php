<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header('Location: ../login.php');
    exit;
}

require '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "Pengguna ID tidak ditemukan!";
    exit;
}

// Ambil data ulasan berdasarkan ID
$query = mysqli_query($koneksi, "
    SELECT 
        ulasanbuku.UlasanID,
        ulasanbuku.UserID,
        ulasanbuku.BukuID,
        user.namalengkap AS NamaUser,
        buku.Judul AS JudulBuku,
        ulasanbuku.Ulasan,
        ulasanbuku.Rating
    FROM ulasanbuku
    JOIN user ON ulasanbuku.UserID = user.UserID
    JOIN buku ON ulasanbuku.BukuID = buku.BukuID
    WHERE ulasanbuku.UlasanID = '$id'
") or die("Query gagal: " . mysqli_error($koneksi));

$data = mysqli_fetch_assoc($query);

include '../layout/sidebar-navbar-footbar.php';
include '../layout/alert.php';
?>

<style>
@media (min-width: 992px) { body { margin-left: 240px; } }
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Ulasan Buku</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-edit-ulasan.php" class="p-4">

        <div class="mb-3 row">
          <label for="user" class="col-sm-2 col-form-label">Nama User</label>
          <div class="col-sm-10">
            <select name="user" id="user" class="form-control bg-light" required>
              <option value="" disabled>-- Pilih User --</option>
              <?php
              $user = mysqli_query($koneksi, "SELECT * FROM user WHERE role = 'user'");
              while ($u = mysqli_fetch_array($user)) {
                  $selected = ($u['UserID'] == $data['UserID']) ? 'selected' : '';
                  echo "<option value='{$u['UserID']}' $selected>{$u['Username']}</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="buku" class="col-sm-2 col-form-label">Judul Buku</label>
          <div class="col-sm-10">
            <select name="buku" id="buku" class="form-control bg-light" required>
              <option value="" disabled>-- Pilih Buku --</option>
              <?php
              $buku = mysqli_query($koneksi, "SELECT * FROM buku");
              while ($b = mysqli_fetch_array($buku)) {
                  $selected = ($b['BukuID'] == $data['BukuID']) ? 'selected' : '';
                  echo "<option value='{$b['BukuID']}' $selected>{$b['Judul']}</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="ulasan" class="col-sm-2 col-form-label">Ulasan</label>
          <div class="col-sm-10">
            <textarea class="form-control bg-light" name="ulasan" id="ulasan" rows="4" required><?php echo htmlspecialchars($data['Ulasan']); ?></textarea>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="rating" class="col-sm-2 col-form-label">Rating</label>
          <div class="col-sm-10">
            <select name="rating" id="rating" class="form-control bg-light" required>
              <option value="" disabled>-- Pilih Rating --</option>
              <?php
              $ratingOptions = [
                  1 => "1 - Sangat Buruk",
                  2 => "2 - Buruk",
                  3 => "3 - Cukup",
                  4 => "4 - Baik",
                  5 => "5 - Sangat Baik"
              ];
              foreach ($ratingOptions as $value => $label) {
                  $selected = ($data['Rating'] == $value) ? 'selected' : '';
                  echo "<option value='$value' $selected>$label</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <input type="hidden" name="UlasanID" value="<?php echo htmlspecialchars($data['UlasanID']); ?>">

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <a href="ulasan.php" class="btn btn-danger">Kembali</a>
        </div>

      </form>
    </div>
  </div>
</div>

</body>
</html>
