<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

session_start();
if ($_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
    exit;
}

include '../koneksi.php';

if (!isset($_GET['id'])) {
    die("ID peminjaman tidak ditemukan.");
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

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Judul laporan
$sheet->mergeCells('A1:B1');
$sheet->setCellValue('A1', 'LAPORAN PEMINJAMAN BUKU');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Data tabel
$labels = [
    'Nama Peminjam' => $data['Username'],
    'Judul Buku' => $data['Judul'],
    'Tanggal Peminjaman' => $data['TanggalPeminjaman'],
    'Tanggal Pengembalian' => $data['TanggalPengembalian'],
    'Status' => $data['StatusPeminjaman']
];

// Header tabel
$sheet->setCellValue('A3', 'Keterangan');
$sheet->setCellValue('B3', 'Isi');
$sheet->getStyle('A3:B3')->getFont()->setBold(true);
$sheet->getStyle('A3:B3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFE5E5E5');
$sheet->getStyle('A3:B3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Isi tabel
$row = 4;
foreach ($labels as $key => $value) {
    $sheet->setCellValue('A' . $row, $key);
    $sheet->setCellValue('B' . $row, $value);
    $row++;
}

// Auto width
foreach (range('A', 'B') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Border tabel
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'],
        ],
    ],
];
$sheet->getStyle('A3:B' . ($row - 1))->applyFromArray($styleArray);

// Output
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="laporan_peminjaman_' . $id . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
