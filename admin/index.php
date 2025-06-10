<?php
    require 'config/session.php';
    include '../layout/sidebar-navbar-footbar.php';
    include '../koneksi.php';

?>
<style>
    @media (min-width: 992px) {
  body {
    margin-left: 240px; /* Lebar sidebar */
  }
    }
.stat-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.progress {
    height: 8px;
}

.trend-badge {
    position: absolute;
    top: 20px;
    right: 20px;
}

.stat-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
}

.dropdown-toggle::after {
    display: none;
}

</style>
<body>
    <div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Dashboard Overview, Selamat datang <?php echo $_SESSION['username']?></h4>
       
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4">
        <!-- book Card -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body" onclick="window.location.href='buku.php'">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-book"></i>
                        </div>
                        <span class="badge bg-success trend-badge">
                                <i class="fas fa-arrow-up me-1"></i>buku
                            </span>
                    </div>
                    <h6 class="text-muted mb-2">Total Buku</h6>
                    <h4 class="mb-3"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));?></h4>
                    <div class="progress">
                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body" onclick="window.location.href='pengguna.php'">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="badge bg-success trend-badge">
                                <i class="fas fa-arrow-up me-1"></i>user
                            </span>
                    </div>
                    <h6 class="text-muted mb-2">Total User</h6>
                    <h4 class="mb-3"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user"));?></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- peminjaman Card -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body" onclick="window.location.href='peminjaman.php'">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fas fa-box"></i>
                        </div>
                        <span class="badge bg-success trend-badge">
                                <i class="fas fa-arrow-up me-1"></i>Peminjaman
                            </span>
                    </div>
                    <h6 class="text-muted mb-2">Total Peminjaman</h6>
                    <h4 class="mb-3"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman"));?></h4>
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ulasan Card -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body" onclick="window.location.href='ulasan.php'">
                    <div class="d-flex align-items-center mb-3">
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="fas fa-comment"></i>
                        </div>
                        <span class="badge bg-success trend-badge">
                                <i class="fas fa-arrow-up me-1"></i>Ulasan
                            </span>
                    </div>
                    <h6 class="text-muted mb-2">Ulasan Buku</h6>
                    <h4 class="mb-3"><?= mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ulasanbuku"));?></h4>
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Section -->
   <?php

// Ambil data jumlah peminjaman per minggu (6 minggu terakhir)
// Header chart
$data = [['Minggu', 'Peminjaman', 'Pengembalian']];

for ($i = 5; $i >= 0; $i--) {
  $start = date('Y-m-d', strtotime("monday -$i week"));
  $end   = date('Y-m-d', strtotime("sunday -$i week"));

  $label = date('d M', strtotime($start)) . ' - ' . date('d M', strtotime($end));

  // Hitung jumlah peminjaman
  $peminjamanQuery = "SELECT COUNT(*) AS total FROM peminjaman 
                      WHERE DATE(TanggalPeminjaman) BETWEEN '$start' AND '$end'";
  $peminjamanResult = mysqli_query($koneksi, $peminjamanQuery);
  $peminjamanRow = mysqli_fetch_assoc($peminjamanResult);
  $jumlahPeminjaman = (int)$peminjamanRow['total'];

  // Hitung jumlah pengembalian
  $pengembalianQuery = "SELECT COUNT(*) AS total FROM peminjaman 
                        WHERE DATE(TanggalPengembalian) BETWEEN '$start' AND '$end' AND StatusPeminjaman='dikembalikan'";
  $pengembalianResult = mysqli_query($koneksi, $pengembalianQuery);
  $pengembalianRow = mysqli_fetch_assoc($pengembalianResult);
  $jumlahPengembalian = (int)$pengembalianRow['total'];

  $data[] = [$label, $jumlahPeminjaman, $jumlahPengembalian];
}
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    const data = google.visualization.arrayToDataTable(<?= json_encode($data); ?>);

    const options = {
      title: 'Peminjaman & Pengembalian Buku per Minggu',
      legend: { position: 'bottom' },
hAxis: {
  title: 'Periode Mingguan',
  slantedText: true,
  slantedTextAngle: 30,
  textStyle: { fontSize: 12 }
}
,
      vAxis: {
        title: 'Jumlah',
        minValue: 0
      },
      colors: ['#4285F4', '#0F9D58'] // Biru & Hijau
    };

    const chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>

<div id="chart_div" class="chart-container mt-4 d-none d-lg-block"  style="width: 100%; min-width: 700px; height: 400px;"></div>

<?php
include '../layout/admin-footer.php';
?>
</body>
</html>