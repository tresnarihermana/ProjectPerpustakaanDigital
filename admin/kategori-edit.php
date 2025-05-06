<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] == 'user') {
    header("Location: ../login.php");
    exit;
} else {
    include '../layout/sidebar-navbar-footbar.php';
    include '../koneksi.php';
}
// Ambil KategoriID dari URL
if (isset($_GET['id'])) {
    $kategoriID = $_GET['id']; // Mengambil ID kategori dari parameter URL
} else {
    echo "<h1 class='mt-4' style='margin-left:249px;'>Kategori ID tidak ditemukan!</h1>";
    exit;
}

// Ambil data kategori berdasarkan KategoriID
$query = mysqli_query($koneksi, "SELECT * FROM kategoribuku WHERE KategoriID = '$kategoriID'");
$data = mysqli_fetch_assoc($query);

// Jika kategori tidak ditemukan
if (!$data) {
    echo "Kategori tidak ditemukan!";
    exit;
}

?>
<head>
    <title>Edit kategori</title>
</head>
<body>
    <h1 class="mt-4 ms-5">Ubah Kategori</h1>
    <form method="post" action="crud-edit-kategori.php" class="card p-5" style="width: 40rem; margin: 50px auto;">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
          <input type="text" class="form-control" id="exampleInputtext" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['Namakategori']); ?>" name="namakategori">
          <div id="nameHelp" class="form-text"></div>

          <!-- Disabled Input for ID Kategori (optional) -->

            <label for="hiddenTextInput" class="form-label"></label>
            <input type="hidden" class="form-control" id="hiddenTextInput" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['KategoriID']); ?>" name="kategoriID">
            <div id="nameHelp" class="form-text"></div>
        </div>

        <div class="d-flex gap-2">
            <!-- Tombol Simpan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <!-- Tombol Reset -->
            <button type="reset" class="btn btn-secondary">Reset</button>
            <!-- Tombol Kembali -->
            <a href="kategori.php" class="btn btn-danger">Kembali</a>
        </div>
    </form>
</body>
</html>
