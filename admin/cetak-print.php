<?php
require '../vendor/autoload.php'; // Dompdf via Composer
use Dompdf\Dompdf;
use Dompdf\Options;

session_start();
if ($_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
    exit;
}

include '../koneksi.php';

if (!isset($_GET['id'])) {
    die("ID tidak tersedia.");
}

$id = intval($_GET['id']);
$query = mysqli_query($koneksi, "
    SELECT * FROM peminjaman 
    LEFT JOIN user ON user.UserID = peminjaman.UserID
    LEFT JOIN buku ON buku.BukuID = peminjaman.BukuID
    WHERE PeminjamanID = '$id'
");

if (mysqli_num_rows($query) < 1) {
    die("Data tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

// Fungsi badgeStatus yang pakai kelas CSS
function badgeStatusPdf($status) {
    if ($status === "dipinjam") {
        return "<span class='badge badge-warning'>DIPINJAM</span>";
    } elseif ($status === "dikembalikan") {
        return "<span class='badge badge-success'>DIKEMBALIKAN</span>";
    }
    return "<span class='badge badge-secondary'>TIDAK DIKETAHUI</span>";
}

// Baca file gambar logo dan convert ke base64
$logoPath = realpath(__DIR__ . '/../storage/img/logo.jpg'); // sesuaikan ekstensi dan pathnya
$type = pathinfo($logoPath, PATHINFO_EXTENSION);
$dataLogo = file_get_contents($logoPath);
$base64Logo = 'data:image/' . $type . ';base64,' . base64_encode($dataLogo);

// HTML untuk PDF dengan logo base64 embed
$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            font-size: 12px;
            color: #333;
        }
        .invoice-box {
            max-width: 700px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            background: #fff;
        }
        .header-text {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            width: 125px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px 12px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f7f7f7;
            text-align: left;
            width: 35%;
            color: #555;
        }
        td {
            background-color: #fafafa;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-style: italic;
            color: #777;
        }
        /* Badge style */
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .badge-success {
            background-color: #198754;
        }
        .badge-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <div class="header-text">
        <img src="' . $base64Logo . '" class="logo" alt="Logo Perpustakaan" />
        <h3>PERPUSTAKAAN DIGITAL SMKN 7 BALEENDAH</h3>
        <h5 style="color:#555;">LAPORAN PEMINJAMAN</h5>
    </div>
    <table>
        <tr>
            <th>Nama Peminjam</th>
            <td>' . htmlspecialchars($data["Username"]) . '</td>
        </tr>
        <tr>
            <th>Judul Buku</th>
            <td>' . htmlspecialchars($data["Judul"]) . '</td>
        </tr>
        <tr>
            <th>Tanggal Peminjaman</th>
            <td>' . $data["TanggalPeminjaman"] . '</td>
        </tr>
        <tr>
            <th>Tanggal Pengembalian</th>
            <td>' . $data["TanggalPengembalian"] . '</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>' . badgeStatusPdf($data["StatusPeminjaman"]) . '</td>
        </tr>
    </table>
    <div class="footer">
        "Terima kasih telah menggunakan layanan perpustakaan kami."
    </div>
</div>
</body>
</html>
';

// Dompdf setup
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output PDF ke browser (buka langsung)
$dompdf->stream("laporan_peminjaman_{$id}.pdf", ["Attachment" => false]);
exit;
?>
