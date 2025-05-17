<?php
require 'config/session.php';

    include '../layout/sidebar-navbar-footbar.php';
    include '../koneksi.php';
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
    <form method="post" action="crud-edit-kategori.php" class="card p-5" style="width: 40rem; margin: 50px auto;" enctype="multipart/form-data">
            <div class="mb-3">
        <label for="formFile" class="form-label">Cover Kategori</label>
        <input class="form-control" type="file" id="formFile" name="image" accept="image/*">
        </div>   
         <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nama Kategori</label>
          <input type="text" class="form-control" id="exampleInputtext" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['Namakategori']); ?>" name="nama_kategori">
          <div id="nameHelp" class="form-text"></div>

          <!-- Disabled Input for ID Kategori (optional) -->

            <label for="hiddenTextInput" class="form-label"></label>
            <input type="hidden" class="form-control" id="hiddenTextInput" aria-describedby="nameHelp" required value="<?php echo htmlspecialchars($data['KategoriID']); ?>" name="kategoriID">
            <div id="nameHelp" class="form-text"></div>
        </div>

        <div class="mb-3">
        <label class="col-form-label">Gambar Cover Saat Ini</label>
        <div class="col-sm-10">
            <?php if (!empty($data['coverkategori'])): ?>
            <img 
                src="../storage/upload/<?php echo htmlspecialchars($data['coverkategori']); ?>" 
                alt="Cover Buku" 
                class="img-thumbnail" 
                style="max-height: 200px;"
            >
            <?php else: ?>
            <p><em>Tidak ada gambar cover</em></p>
            <?php endif; ?>
        </div>
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
