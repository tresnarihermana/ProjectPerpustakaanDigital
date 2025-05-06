<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header("Location: ../login.php");
    exit;
} else {
    include '../layout/sidebar-navbar-footbar.php';
    include '../koneksi.php';
}


?>
<style>
@media (min-width: 992px) { body { margin-left: 240px; } }
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Pengguna Baru</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-add-pengguna.php" class="p-4">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control bg-light" id="username" name="username" placeholder="Masukkan nama baru..." required>
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control bg-light" id="password" name="password" placeholder="Masukkan Password..." required>
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control bg-light" id="email" name="email" placeholder="Masukkan email..." required>
            <label for="namalengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control bg-light" id="namalengkap" name="namalengkap" placeholder="Masukkan nama lengkap..." required>
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control bg-light" id="alamat" name="alamat" placeholder="Masukkan alamat..." required>
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
              <option value="" disabled selected>Pilih role...</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
              <option value="petugas">Petugas</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <button type="reset" class="btn btn-light">Reset</button>
        <a href="kategori.php" class="btn btn-danger">Kembali</a>
      </form>
    </div>
  </div>
</div>

</body>
</html>
