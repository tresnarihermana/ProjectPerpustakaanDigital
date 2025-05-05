<?php
if (isset($_GET['pesan'])) {
    // Cek pesan di URL dan tampilkan pesan yang sesuai
    if ($_GET['pesan'] == 'berhasil') {
        echo '<div class="alert alert-success"><i class="fa-solid fa-check"></i> Operasi berhasil dilakukan!</div>';
    } elseif ($_GET['pesan'] == 'gagal') {
        echo '<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation" style="color: #ff0f0f;"></i> Terjadi kesalahan, coba lagi.</div>';
    } elseif ($_GET['pesan'] == 'duplikat') {
        echo '<div class="alert alert-warning"><i class="fa-solid fa-clone"></i> Duplikasi data Terdeteksi! coba lagi</div>';
    }
}
?>