<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
} else {
    include '../layout/sidebar-navbar-footbar.php';
    include '../koneksi.php';
}
?>
<style>
    @media (min-width: 992px) {
  body {
    margin-left: 240px; /* Lebar sidebar */
  }
}

</style>
<body>
<h1 class="mt-4 ms-5">Dashboard</h1>
    <div class="row mx-5">
        <div class="col-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                <?php
                    echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
                ?>
                Total Buku</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretche-link" href="#"> View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                <?php
                    echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM user"));
                ?>    
                Total User</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretche-link" href="#"> View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                <?php
                    echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman"));
                ?>    
                Total Peminjaman</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretche-link" href="#"> View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>