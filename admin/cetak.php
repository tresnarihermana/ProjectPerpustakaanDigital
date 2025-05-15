<h2 align="center">Laporan Peminjaman Buku</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <tr>
        <th>No</th>
        <th>User</th>
        <th>Buku</th>
        <th>Tanggal Peminjaman</th>
        <th>Tanggal Pengembalian</th>
        <th>Status Peminjaman</th>
    </tr>
    <?php
    include '../koneksi.php';
    $i = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
            LEFT JOIN user ON user.UserID = peminjaman.UserID
            LEFT JOIN buku ON buku.BukuID = peminjaman.BukuID");
        while ($row= mysqli_fetch_assoc($query)) {
             ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['Username']; ?></td>
                <td><?php echo $row['Judul']; ?></td>
                <td><?php echo $row['TanggalPeminjaman']; ?></td>
                <td><?php echo $row['TanggalPengembalian']; ?></td>
                <td><?php echo $row['StatusPeminjaman']; ?></td>
            </tr>
            <?php
        }
    ?>
</table>
<script>
    window.print();
    setTimeout(function() {
        window.close();
    }, 100);
</script>
