
<?php
if (isset($_GET['pesan'])) {
    $pesan = $_GET['pesan'];

    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    switch ($pesan) {
        case 'berhasil':
            echo "<script>
            Swal.fire({
            title: 'Success!',
            text: 'Operasi berhasil dilakukan!',
            icon: 'success'});
            </script>";
            break;
        case 'gagal':
            echo "<script>
            Swal.fire({
            title: 'Gagal!',
            text: 'Terjadi kesalahan. Coba lagi.',
            icon: 'error'});
            </script>";
            break;
        case 'duplikat':
            // echo "Swal.fire('Duplikat!', 'Duplikasi data terdeteksi. Coba lagi.', 'warning');";
            echo "<script>
            Swal.fire({
            title: 'Duplikat!',
            text: 'Duplikasi data terdeteksi. Coba lagi.',
            icon: 'warning'});
            </script>";
            break;
        case 'maxpinjam':
            // echo "Swal.fire('Batas Peminjaman!', 'Anda sudah mencapai batas maksimal 3 buku.', 'warning');";
            echo "<script>
            Swal.fire({
            title: 'Batas Peminjaman!',
            text: 'Anda sudah mencapai batas maksimal 3 buku.',
            icon: 'warning'});
            </script>";
            break;
        case 'harimaksimal':
            echo "<script>
            Swal.fire({
            title: 'Tanggal Tidak Valid!',
            text: 'Tanggal Pengembalian tidak boleh lebih dari 7 hari.',
            icon: 'error'});
            </script>";
            break;
        case 'sudahdipinjam':
            // echo "Swal.fire('Sudah Dipinjam!', 'Buku ini sudah Anda pinjam dan belum dikembalikan.', 'error');";
            echo "<script>
            Swal.fire({
            title: 'Sudah Dipinjam!',
            text: 'Buku ini sudah Anda pinjam dan belum dikembalikan.',
            icon: 'error'});
            </script>";
            break;
        case 'stokhabis';
             echo "<script>
            Swal.fire({
            title: 'Stok Habis!',
            text: 'Tampaknya stok buku ini sedang kosong. Coba lain kali',
            icon: 'error'});
            </script>";
            break;
        case 'komenduplikasi';
             echo "<script>
            Swal.fire({
            title: 'Duplikasi data terdeteksi!',
            text: 'Anda hanya dapat komen satu kali',
            icon: 'warning'});
            </script>";
            break;
        case 'gagallogin':
            echo "<script>
            Swal.fire({
            title: 'Gagal Login!',
            text: 'Username atau password salah.',
            icon: 'error'});
            </script>";
            break;
        case 'berhasildaftar':
            echo "<script>
            Swal.fire({
            title: 'Berhasil Daftar!',
            text: 'Akun Anda telah berhasil dibuat.',
            icon: 'success'});
            </script>";
            break;
        case 'datainvalid':
            echo "<script>
            Swal.fire({
            title: 'Data Tidak Valid!',
            text: 'Pastikan semua field terisi dengan benar.',
            icon: 'warning'});
            </script>";
            break;
        case 'password_salah':
            echo "<script>
            Swal.fire({
            title: 'Password Salah!',
            text: 'Pastikan semua password terisi dengan benar.',
            icon: 'warning'});
            </script>";
            break;
        case 'konfirmasi_gagal':
            echo "<script>
            Swal.fire({
            title: 'Konfirmasi Password Gagal',
            text: 'Pastikan password konfirmasi terisi dengan benar.',
            icon: 'warning'});
            </script>";
            break;
            
    }
}

// if (isset($_GET['pesan'])) {
//     // Cek pesan di URL dan tampilkan pesan yang sesuai
//     if ($_GET['pesan'] == 'berhasil') {
//         echo '<div class="alert alert-success"><i class="fa-solid fa-check"></i> Operasi berhasil dilakukan!</div>';
//     } elseif ($_GET['pesan'] == 'gagal') {
//         echo '<div class="alert alert-danger"><i class="fa-solid fa-triangle-exclamation" style="color: #ff0f0f;"></i> Terjadi kesalahan, coba lagi.</div>';
//     } elseif ($_GET['pesan'] == 'duplikat') {
//         echo '<div class="alert alert-warning"><i class="fa-solid fa-clone"></i> Duplikasi data Terdeteksi! coba lagi</div>';
//     }
    
// }
// if (isset($_GET['pesan'])) {
//     if ($_GET['pesan'] == 'maxpinjam') {
//         echo "<div class='alert alert-warning'>Anda sudah mencapai batas maksimal 3 buku yang sedang dipinjam.</div>";
//     } else if ($_GET['pesan'] == 'harimaksimal') {
//         echo "<div class='alert alert-warning'>Tanggal pengembalian tidak boleh lebih dari 7 hari.</div>";
//     } else if ($_GET['pesan'] == 'duplikat') {
//         echo "<div class='alert alert-danger'>Buku ini sudah Anda pinjam dan belum dikembalikan.</div>";
//     }
// }
?>