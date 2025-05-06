<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header("Location: ../login.php");
    exit;
} else {
    include '../layout/sidebar-navbar-footbar.php';
    include '../koneksi.php';
}


$result = mysqli_query(
    $koneksi,
    "SELECT * FROM User"
) or die("Query gagal: " . mysqli_error($koneksi));

?>
<style>
  @media (min-width: 992px) {
    body { margin-left: 240px; }
  }
</style>

<div class="mx-5 mt-4">
  <!-- Judul -->
  <h1 class="mb-3">Daftar Pengguna</h1>
  <!-- Tombol di bawah judul -->
  <a href="pengguna-add.php" class="btn btn-primary mb-4">+ Tambah Data</a>

  <!-- Tabel dalam card -->
  <div class="card shadow-sm mb-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered mb-0" style="width: 110%;">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th style ="width:15%">Username</th>
              <th style ="width:15%">Password</th>
              <th style ="width:15%">Email</th>
              <th style ="width:15%">Nama Lengkap</th>
              <th style ="width:15%">Alamat</th>
              <th style ="width:10%">Role</th>
              <th style ="width:15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result) === 0): ?>
              <tr>
                <td colspan="8" class="text-center">Belum ada kategori.</td>
              </tr>
            <?php else: 
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['Username']) ?></td>
                  <td><?= htmlspecialchars($row['Password']) ?></td>
                  <td><?= htmlspecialchars($row['Email']) ?></td>
                  <td><?= htmlspecialchars($row['NamaLengkap']) ?></td>
                  <td><?= htmlspecialchars($row['Alamat']) ?></td>
                  <td><?= htmlspecialchars($row['role']) ?></td>
                  <td>
                    <a href="pengguna-edit.php?id=<?= $row['UserID'] ?>"
                       class="btn btn-info btn-sm me-1">Ubah</a>
                    <a href="crud-pengguna-edit.php?id=<?= $row['UserID'] ?>"
                       onclick="return confirm('Yakin ingin menghapus?')"
                       class="btn btn-danger btn-sm">Hapus</a>
                  </td>
                </tr>
            <?php endwhile; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</body>
</html>