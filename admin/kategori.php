<?php
require 'config/session.php';
require '../koneksi.php';


// Ambil data kategori
$result = mysqli_query(
    $koneksi,
    "SELECT KategoriID, Namakategori FROM kategoribuku"
) or die("Query gagal: " . mysqli_error($koneksi));

// Include layout (sidebar + navbar)
include '../layout/sidebar-navbar-footbar.php';
include '../layout/alert.php';
?>
<style>
  @media (min-width: 992px) {
    body { margin-left: 240px; }
  }
</style>

<div class="mx-5 mt-4">
  <!-- Judul -->
  <h1 class="mb-3">Kategori Buku</h1>
  <!-- Tombol di bawah judul -->
  <a href="kategori-add.php" class="btn btn-success mb-4">+ Tambah Data</a>

  <!-- Tabel dalam card -->
  <div class="card shadow-sm mb-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th>Nama Kategori</th>
              <th style="width:20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result) === 0): ?>
              <tr>
                <td colspan="3" class="text-center">Belum ada kategori.</td>
              </tr>
            <?php else: 
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= htmlspecialchars($row['Namakategori']) ?></td>
                  <td>
                    <a href="kategori-edit.php?id=<?= $row['KategoriID'] ?>"
                       class="btn btn-info btn-sm me-1">Ubah</a>
                       <?php $buttonId = 'hapusbutton_' . $row['KategoriID']; ?>
                    <button type="button" class="btn btn-danger btn-sm" id="<?= $buttonId ?>">Hapus</button>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                      document.getElementById('<?= $buttonId ?>').addEventListener('click', function() {
                        Swal.fire({
                          title: 'Hapus Kategori?',
                          text: "Kamu yakin ingin menghapus kategori ini?",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#d33',
                          cancelButtonColor: '#3085d6',
                          confirmButtonText: 'Hapus',
                          cancelButtonText: 'Batal'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            window.location.href = 'crud-delete-kategori.php?id=<?= $row['KategoriID'] ?>';
                          }
                        });
                      });
                    </script>
                  </td>
                </tr>
            <?php endwhile; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
include '../layout/admin-footer.php';
?>
</body>
</html>
