<?php
session_start();

if (!isset($_SESSION['status'])) {
    header("Location: login.php");
    exit;
} else {
    include 'koneksi.php';
    include 'layout/alert.php';
}
$id_buku = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID = '$_GET[id]'");
$buku = mysqli_fetch_assoc($data);
// proses tambah koleksi
$user = $_SESSION['UserID'];

if(isset($_POST['proses'])){
  $cekk = mysqli_query($koneksi, "SELECT * FROM koleksipribadi WHERE UserID = '$user' && BukuID = '$id_buku'");
  $cekkk= mysqli_fetch_assoc($cekk);
 if($cekkk > 0){
    header('Location: koleksi-pribadi.php?pesan=duplikat');
    exit;
 } else{
   $koleksi = mysqli_query($koneksi, "INSERT INTO koleksipribadi (KoleksiID, BukuID, UserID) VALUES ('','$id_buku','$user')");
 } if($koleksi){
  header('Location: koleksi-pribadi.php?pesan=berhasil');
 }
}

$data_ulasan = mysqli_query($koneksi, "
  SELECT ulasanbuku.*, user.Username
  FROM ulasanbuku
  JOIN user ON ulasanbuku.UserID = user.UserID
  WHERE ulasanbuku.BukuID = '$id_buku'
");
$data_kategori = mysqli_query($koneksi,"SELECT kategoribuku.*, kategoribuku_relasi.*
FROM kategoribuku_relasi
JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID
WHERE kategoribuku_relasi.BukuID = '$id_buku'
");
$kategori = mysqli_fetch_assoc($data_kategori);
include 'layout/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <style>
      a {
        text-decoration: none;
        color: black;
      }

    </style>
</head>
<body>
<div class="mx-5 mt-4">
      <style>
        .breadcrumb {
        font-size : 1.2rem;
      }
      .breadcrumb-item a{
        color :rgb(0, 136, 255);
        text-decoration: none;
      }
          .pdf-frame {
      width: 100%;
      height: 70vh;
      border: none;
      border-radius: 10px;
    }
    </style>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a href="daftar-buku.php">Books</a></li>
    <li class="breadcrumb-item"><a href="daftar-buku-kategori.php?id=<?=htmlspecialchars($kategori['KategoriID'])?>"><?=htmlspecialchars($kategori['Namakategori'])?></a></li>
    <li class="breadcrumb-item active"><?=htmlspecialchars($buku['Judul'])?></li>
  </ol>
</nav>
  <h2 class="mb-3 fw-bold">Detail Buku</h2>
  <div class="card shadow-sm mb-4">
  <div class="card-body d-flex flex-wrap align-items-start">
  <div class="me-4 mb-3" style="max-width: 200px;">
    <img 
      src="storage/upload/<?= htmlspecialchars($buku['imagecover']) ?>" 
      alt="Cover Buku" 
      class="img-fluid rounded shadow-sm"
    >
  </div>

  <div class="flex-grow-1">
    <h3 class="fw-bold mb-3"><?= htmlspecialchars($buku['Judul']) ?></h3>
    
    <table class="table table-sm table-borderless mb-4">
      <tr>
        <th class="text-muted" style="width: 120px;">Penulis</th>
        <td><a href="pencarian.php?keyword=<?=$buku['Penulis']?>">: <?= htmlspecialchars($buku['Penulis']) ?></a></td>
        <th class="text-muted" style="width: 120px;">Kategori</th>
<td>:
  <?php
    $kategori_list = [];
    mysqli_data_seek($data_kategori, 0); // reset pointer ke awal
    while ($k = mysqli_fetch_assoc($data_kategori)) {
      $kategori_list[] = '<a href="daftar-buku-kategori.php?id=' . $k['KategoriID'] . '">' . htmlspecialchars($k['Namakategori']) . '</a>';
    }
    echo implode(', ', $kategori_list);
  ?>
</td>
      </tr>
      <tr>
        <th class="text-muted">Tahun Terbit</th>
        <td>: <?= htmlspecialchars($buku['TahunTerbit']) ?></td>
        <th class="text-muted">Penerbit</th>
        <td><a href="pencarian.php?keyword=<?=$buku['penerbit']?>">: <?= htmlspecialchars($buku['penerbit']) ?></a></td>
      </tr>
      </tr>
      <tr>
        <th class="text-muted">Stok buku</th>
        <td>: <?php if($buku['stok'] <= 0){
         echo '<span class="text-danger">Tidak Tersedia</span>'; 
        }else{
         echo htmlspecialchars($buku['stok']);
        }
        ?></td>
       <th class="text-muted">Ebook</th>
        <td>: <?php
        echo $buku['ebook']? "Tersedia" : "Tidak Tersedia";
        ?></td>  
    </tr>
    </table>

    <div class="d-flex gap-2">
     <?php if ($buku['stok'] <= 0): ?>
      <a href="#" class="btn btn-secondary disabled" aria-disabled="true" tabindex="-1">
        <i class="bi bi-x-circle"></i> Stok Habis
      </a>
    <?php else: ?>
      <a href="pinjam-buku.php?id=<?= $buku['BukuID'] ?>" class="btn btn-outline-primary">
        <i class="bi bi-book"></i> Pinjam
      </a>
    <?php endif; ?>

      <form action="" method="post">
      <button type="submit" name="proses" class="btn btn-outline-success"><i class="bi bi-bookmark-heart"></i> Simpan ke Koleksi</button>
      <?php
      if($buku['ebook']){
    echo '<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#pdfModal">
      📚 Baca eBook
    </button>';
      };
      ?>
      </form>
    </div>
  </div>
</div>

  </div>

  <div class="card shadow-sm mb-4 border-0">
  <div class="card-body bg-light rounded-3">
    <div class="d-flex align-items-center mb-3">
      <i class="bi bi-book text-primary fs-3 me-2"></i>
      <h5 class="fw-bold mb-0">Deskripsi Buku</h5>
    </div>
    <p class="text-secondary fs-6" style="line-height: 1.7;">
      <?= nl2br(htmlspecialchars($buku['Deskripsi'])) ?>
    </p>
  </div>
</div>
  <div class="d-flex justify-content-end mb-3">
  <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalUlasan">
    <i class="bi bi-plus-circle me-1"></i> Tambah Ulasan
  </button>
</div>

  <div class="card shadow-sm">
  <div class="card-body">
    <h5 class="fw-bold mb-4 border-bottom pb-2">Ulasan Pengguna</h5>

    <?php
    if (mysqli_num_rows($data_ulasan) > 0) {
      while ($ulasan = mysqli_fetch_assoc($data_ulasan)) {
    ?>
      <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div>
            <h6 class="mb-0 fw-semibold"><?= htmlspecialchars($ulasan['Username']) ?></h6>
            <small class="text-muted"><?= date('d M Y', strtotime($ulasan['TanggalUlasan'] ?? 'now')) ?></small>
          </div>
          <div>
            <?php
              $rating = (int)$ulasan['Rating'];
              for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                  echo '<i class="bi bi-star-fill text-warning"></i>';
                } else {
                  echo '<i class="bi bi-star text-secondary"></i>';
                }
              }
            ?>
          </div>
        </div>
        <div class="bg-light p-3 rounded border">
          <p class="mb-0"><?= nl2br(htmlspecialchars($ulasan['Ulasan'])) ?></p>
        </div>
      </div>
    <?php
      }
    } else {
      echo "<p class='text-muted'>Belum ada ulasan untuk buku ini.</p>";
    }
    ?>
  </div>
</div>

    </div>
  </div>
</div>

    <?php
    include 'layout/footer.php';
    ?>

<div class="modal fade" id="modalUlasan" tabindex="-1" aria-labelledby="modalUlasanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="crud-tambah-ulasan.php" method="POST" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalUlasanLabel">Tulis Ulasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="buku_id" value="<?= htmlspecialchars($id_buku) ?>">

        <div class="mb-3">
          <label class="form-label">Rating</label>
          <select name="rating" id="rating" class="form-control bg-light" required>
              <option value="" disabled selected>-- Pilih Rating --</option>
              <option value="1">1 - Sangat Buruk</option>
              <option value="2">2 - Buruk</option>
              <option value="3">3 - Cukup</option>
              <option value="4">4 - Baik</option>
              <option value="5">5 - Sangat Baik</option>
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
<!-- Modal untuk ebook -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pdfModalLabel">Baca eBook: <?= htmlspecialchars($buku['Judul'])?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <iframe src="<?= htmlspecialchars($buku['ebook'])?>" class="pdf-frame"></iframe>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

</body>
</html>