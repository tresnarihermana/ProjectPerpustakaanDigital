<?php
require 'config/session.php';

require '../koneksi.php';
require '../layout/sidebar-navbar-footbar.php';


?>

<style>
@media (min-width: 992px) { body { margin-left: 240px; } }
#drop-area.highlight {
  background-color: #e0f7ff;
  border-color: #007bff;
}
</style>

<div class="mx-5 mt-4">
  <h2 class="mb-3 fw-bold">Buku</h2>
  <div class="card shadow-sm">
    <div class="card-body">
      <form method="post" action="crud-add-buku.php" class="p-4" enctype="multipart/form-data">
          <!-- <div class="mb-3 row">
            <label for="BukuID" class="col-sm-2 col-form-label">BukuID</label>
            <div class="col-sm-10">
              <input type="number" class="form-control bg-light" id="BukuID" name="BukuID" required>
            </div>
          </div> -->
          
        <div class="mb-3 row">
          <label for="Judul" class="col-sm-2 col-form-label">Judul</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="Judul" name="Judul" required>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="Deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="Deskripsi" name="Deskripsi" required>
          </div>
        </div>

       <div class="mb-3 row">
          <label for="user" class="col-sm-2 col-form-label">Nama Kategori</label>
          <div class="col-sm-10">
            <select name="kategori" id="kategori" class="form-control bg-light" required>
              <option value="" selected>-- Pilih kategori --</option>
              <?php
              $data = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
              while ($k = mysqli_fetch_array($data)) {
                  echo "<option value='$k[KategoriID]'>$k[Namakategori]</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="mb-3 row">
          <label for="Penulis" class="col-sm-2 col-form-label">Penulis</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="Penulis" name="Penulis" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="Penerbit" class="col-sm-2 col-form-label">Penerbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="Penerbit" name="Penerbit" required>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="TahunTerbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control bg-light" id="TahunTerbit" name="TahunTerbit" required>
          </div>
        </div>
        
        <div class="mb-3 row">
          <label for="stok" class="col-sm-2 col-form-label">Stok buku</label>
          <div class="col-sm-10">
            <input type="number" class="form-control bg-light" id="stok" name="stok" required>
          </div>
        </div>
        <div class="mb-3 row">
  <label for="image" class="col-sm-2 col-form-label">Upload Image</label>
  <div class="col-sm-10">
    <div id="drop-area" class="border border-2 border-secondary rounded bg-light p-4 text-center" style="cursor: pointer;">
      <p class="mb-2">Drag & drop gambar di sini atau klik untuk memilih</p>
      <input type="file" name="image" id="image" class="form-control d-none" accept="image/*" required>
      <img id="preview" src="#" alt="Preview" style="max-width: 200px; display: none; margin-top: 10px;">
    </div>
  </div>
</div>
        <div class="text-end">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
          <a href="buku.php" class="btn btn-danger">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
const dropArea = document.getElementById("drop-area");
const fileInput = document.getElementById("image");
const preview = document.getElementById("preview");

// Klik area = buka file input
dropArea.addEventListener("click", () => fileInput.click());

// Drag over & enter
["dragenter", "dragover"].forEach(eventName => {
  dropArea.addEventListener(eventName, e => {
    e.preventDefault();
    e.stopPropagation();
    dropArea.classList.add("highlight");
  });
});

// Drag leave & drop
["dragleave", "drop"].forEach(eventName => {
  dropArea.addEventListener(eventName, e => {
    e.preventDefault();
    e.stopPropagation();
    dropArea.classList.remove("highlight");
  });
});

// Saat file dijatuhkan
dropArea.addEventListener("drop", e => {
  const files = e.dataTransfer.files;
  if (files.length > 0) {
    fileInput.files = files; // Set file ke input hidden
    showPreview(files[0]);
  }
});

// Saat file dipilih manual
fileInput.addEventListener("change", () => {
  if (fileInput.files.length > 0) {
    showPreview(fileInput.files[0]);
  }
});

function showPreview(file) {
  const reader = new FileReader();
  reader.onload = function(e) {
    preview.src = e.target.result;
    preview.style.display = "block";
  };
  reader.readAsDataURL(file);
}
</script>

</body>
</html>