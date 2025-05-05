<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
      .searchbar {
    width: 100%;
    height: 50px;
    max-width: 650px;
}
.nav-item{
    margin :5px 5px 5px 5px;
  }

.search-icon{
    width: 50px;
    height: 50px;
    cursor: pointer;
    position: relative;
    right: 56px;
}
.dropdown{
    position: relative;
    right: 20px;
}
.dropdown-menu{
  margin-left: 10px;
}
.btn-profile{
    border-radius: 50px;
    background-color: #8EAEFF;
    padding: 10px 20px;
    border: none;
  }
    </style>
    <title>Homepage</title>
</head>
<body>
   <!-- awal navbar -->
    <div class="navbar-container d-flex flex-column">
   <nav class="navbar navbar-expand-lg bg-body-tertiary " data-bs-theme = "dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="storage/img/logo.svg" alt="" width="50" height="51" class="d-inline-block">
        Perpustakaan Digital
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
        </ul>
        <form class="searchbar d-flex justify-content-center mx-auto" role="search">
            <input class="form-control me-2 " data-bs-theme="light" type="search" placeholder="Cari..." aria-label="Search" style="border-radius: 50px;">
            <button class="search-icon btn btn-success" type="submit" style="border-radius: 50px; "><i class="fa-solid fa-magnifying-glass"></i></button>
          </form>
      </div>
      <div class="dropdown">
        <button class="btn-profile dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fa-regular fa-circle-user"></i> Account profile
        </button>
        <ul class="dropdown-menu">
          <?php
          if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'petugas')) {
            echo '<li><a class="dropdown-item" href="admin/index.php">Dashboard Admin</a></li>';
          }else{

          };
          ?>
          <li><a class="dropdown-item" href="#">edit profil</a></li>
          <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">Log out</a></li>
        </ul>
      </div>
    </div>
  </nav>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #8EAEFF; color: white;">
        <h1 class="modal-title fs-5 " id="exampleModalLabel"><i class="fa-solid fa-right-from-bracket color-black"></i> Log Out</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="my-2"> <i class="fa-solid fa-triangle-exclamation" style="color: #ff0000;"></i> Do you really wish to leave and logout?</h1>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, Cancel</button>
        <a href="logout.php" class="btn btn-danger">Yes, Logout</a>
      </div>
    </div>
  </div>
</div>
<!-- akhir modal -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="grey" style="height: 52px;">
    <div class="container-fluid justify-content-center">
        <ul class="navbar-nav" style=" display: flex ; flex-direction: row; flex-wrap: nowrap;;" >
            <li class="nav-item">
                <a class="nav-link" href="#">Home
                    <span class="sr-only"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Books</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Peminjaman</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">Koleksi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About us</a>
            </li>
        </ul>
    </div>
  </nav>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>    
</body>
</html>