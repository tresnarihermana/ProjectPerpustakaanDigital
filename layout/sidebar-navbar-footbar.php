<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Dashboard Admin</title>
</head>
<style>
html {
  font-size: 12px; /* 75% dari default browser (16px) */
}

body {
  background-color: #fbfbfb;
}

@media (min-width: 991.98px) {
  main {
    padding-left: 20rem; /* 240px */
  }
}

.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 4.8rem 0 0; /* 58px */
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width: 20rem; /* 240px */
  z-index: 600;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: 100%;
  }
}

.sidebar .active {
  border-radius: 0.5rem;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 4.8rem);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto;
}

.navbar-brand span {
  font-size: 1.4rem;
  font-weight: bold;
  color: white;
}

</style>
<body>
    <!--Main Navigation-->
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4 ">
        <a
          href="index.php"
          class="list-group-item list-group-item-action py-2"
          aria-current="true"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
        </a>
        <a href="kategori.php" class="list-group-item list-group-item-action py-2">
          <i class="fas fa-table fa-fw me-3"></i><span>KATEGORI</span>
        </a>
        <a href="buku.php" class="list-group-item list-group-item-action py-2"
          ><i class="fas fa-book fa-fw me-3"></i><span>BUKU</span></a
        >
        <a href="koleksi-kategori.php" class="list-group-item list-group-item-action py-2"
          ><i class="fas fa-archive fa-fw me-3"></i><span>KOLEKSI</span></a
        >
        
        <a href="ulasan.php" class="list-group-item list-group-item-action py-2"
          ><i class="fas fa-comment fa-fw me-3"></i><span>ULASAN</span></a
        >
        <a href="peminjaman.php" class="list-group-item list-group-item-action py-2">
          <i class="fas fa-book-open-reader fa-fw me-3"></i><span>PEMINJAMAN</span>
        </a>
        <?php
        if (($_SESSION['role'] == 'admin')) {
            // echo '<a href="petugas.php" class="list-group-item list-group-item-action py-2"><i class="fas fa-user-shield fa-fw me-3"></i><span>PETUGAS</span></a>';
            echo '<a href="pengguna.php" class="list-group-item list-group-item-action py-2"><i class="fas fa-users fa-fw me-3"></i><span>USER</span></a>';
          } else {
        }
        
        ?>
        
      </div>
    </div>
  </nav>
  <!-- AkhitSidebar -->

  <!-- Navbar -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Brand -->
    <a class="navbar-brand" href="index.php">
      <img src="../storage/img/logo.svg" height="50px" alt="PD Logo" loading="lazy" />
      <span style="color: white;">Perpustakaan Digital</span>
    </a>

    <!-- Right links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto d-flex flex-row">
        <!-- Avatar -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../storage/img/user.png" class="rounded-circle" height="22" alt="Avatar" loading="lazy" />
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="../index.php">Halaman Utama</a></li>
            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px;">
  <div class="container pt-4"></div>
</main>
<!--Main layout-->
<footer class="bg-body-tertiary text-center text-lg-start fixed-bottom">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2025 Copyright:
      <a class="text-dark" href="#">Perpustakaan Digital</a>
</footer>
    
</div>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>