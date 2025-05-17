<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
} else {
    include '../layout/sidebar-navbar-footbar.php';
    include '../koneksi.php';
}

// Ambil PenggunaID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Mengambil ID Pengguna dari parameter URL
} else {
    echo "Pengguna ID tidak ditemukan!";
    exit;
}

// Ambil data Pengguna berdasarkan PenggunaID
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE UserID = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika Pengguna tidak ditemukan
if (!$data) {
    echo "Pengguna tidak ditemukan!";
    exit;
}

?>

<head>
    <title>Edit Pengguna</title>
</head>
<body>
    <h1 style="margin-left:33rem;">Ubah Pengguna</h1>
    <form method="post" action="crud-edit-pengguna.php" class="card p-5" style="width: 40rem; margin: 30px auto;">
        <div class="mb-3">
          <label for="exampleInputusername" class="form-label">Username</label>
          <input type="text" class="form-control" id="exampleInputtext" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['Username']); ?>" name="username">
          <div id="nameHelp" class="form-text"></div>
          <label for="exampelInputPassword" class="form-label">Password</label>
          <input type="text" class="form-control" id="exampleInputtext" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['Password']); ?>" name="password">
            <div id="nameHelp" class="form-text"></div>
            <label for="exampleInputEmail" class="form-label">Email</label>
            <input type="text" class="form-control" id="exampleInputtext" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['Email']); ?>" name="email">
            <div id="nameHelp" class="form-text"></div>
            <label for="exampleInputnamalengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="exampleInputtext" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['NamaLengkap']); ?>" name="namalengkap">
            <div id="nameHelp" class="form-text"></div>
            <label for="exampleInputalamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="exampleInputtext" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['Alamat']); ?>" name="alamat">
            <div id="nameHelp" class="form-text"></div>
            <label for="exampleInputrole" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="" disabled selected>Pilih role...</option>
                <option value="admin" <?php if ($data['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="user" <?php if ($data['role'] == 'user') echo 'selected'; ?>>User</option>
                <option value="petugas" <?php if ($data['role'] == 'petugas') echo 'selected'; ?>>Petugas</option>
            </select>

          <!-- Disabled Input for ID Pengguna (optional) -->

            <label for="hiddenTextInput" class="form-label"></label>
            <input type="hidden" class="form-control" id="hiddenTextInput" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['UserID']); ?>" name="userID">
            <div id="nameHelp" class="form-text"></div>
        </div>

        <div class="d-flex gap-2">
            <!-- Tombol Simpan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <!-- Tombol Reset -->
            <button type="reset" class="btn btn-secondary">Reset</button>
            <!-- Tombol Kembali -->
            <a href="pengguna.php" class="btn btn-danger">Kembali</a>
        </div>
    </form>
</body>
</html>
