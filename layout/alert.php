<?php
if (isset($_GET['pesan'])) {
    // Cek pesan di URL dan tampilkan pesan yang sesuai
    if ($_GET['pesan'] == 'berhasil') {
        echo '<div class="alert alert-success">Operasi berhasil dilakukan!</div>';
    } elseif ($_GET['pesan'] == 'gagal') {
        echo '<div class="alert alert-danger">Terjadi kesalahan, coba lagi.</div>';
    } elseif ($_GET['pesan'] == 'duplikat') {
        echo '<div class="alert alert-warning">Duplikasi data Terdeteksi! coba lagi</div>';
    }
}
?>