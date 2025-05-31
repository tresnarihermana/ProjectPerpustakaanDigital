<?php
include 'koneksi.php';

// Pastikan session username sudah ada sebelum query
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Atau halaman lain jika belum login
    exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM user WHERE Username = '{$_SESSION['username']}'");
$cek = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PerpustakaanDigital</title>
    <link rel="icon" href="storage/img/logo.svg" type="image/x-icon" sizes="32x32" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Ancizar+Serif:ital,wght@0,300..900;1,300..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .nunito-sans {
            font-family: "Nunito Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
            font-variation-settings:
                "wdth" 100,
                "YTLC" 500;
        }

        .searchbar {
            width: 100%;
            height: 50px;
            max-width: 650px;
        }

        .nav-item {
            margin: 5px;
        }

        .search-icon {
            width: 50px;
            height: 50px;
            cursor: pointer;
            position: relative;
            right: 56px;
        }

        .dropdown {
            position: relative;
            right: 20px;
            z-index: 1;
        }

        .dropdown-menu {
            margin-left: 10px;
        }

        .btn-profile {
            border-radius: 50px;
            background-color: #8EAEFF;
            padding: 10px 20px;
            border: none;
        }

        .nav-item a:hover {
            color: #8EAEFF;
            cursor: pointer;
        }

        /* Default hidden mobile search bar */
        #searchbar-mobile {
            display: none;
        }

        /* Show search bar mobile when active */
        #searchbar-mobile.active {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 25px 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            max-width: 90%;
            margin: 30px auto;
        }

        @media (max-width: 991px) {
            .library-search-form {
                width: 100%;
                max-width: 500px;
            }

            .search-input {
                flex: 1;
                border-radius: 30px 0 0 30px;
                border: 1px solid #ced4da;
                padding: 10px 20px;
                font-size: 16px;
                transition: all 0.3s ease;
            }

            .search-input:focus {
                outline: none;
                border-color: #28a745;
                box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
            }

            .search-btn {
                border-radius: 0 30px 30px 0;
                background-color: #28a745;
                color: white;
                padding: 10px 20px;
                border: none;
                transition: background-color 0.3s ease;
            }

            .search-btn:hover {
                background-color: #218838;
            }

            .search-info {
                color: #6c757d;
            }
            #mobile-search-btn{
                position: absolute;
                right: 225px;
                border: none;
                border-radius: 100px;
                color: white;
                width: 45px;
                height: 45px;
                cursor: pointer;
            }
}

    </style>
</head>
<body>
    <!-- Awal navbar -->
    <div class="navbar-container d-flex flex-column">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid flex-nowrap">
                <a class="navbar-brand" href="index.php">
                    <img src="storage/img/logo.svg" alt="Logo" width="50" height="51" class="d-inline-block" />
                    Perpustakaan Digital
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Form pencarian hanya tampil di desktop -->
                    <form class="searchbar d-flex justify-content-center mx-auto d-none d-lg-flex" role="search" action="pencarian.php" method="GET">
                        <input class="form-control me-2" type="search" name="keyword" placeholder="Cari..." aria-label="Search" style="border-radius: 50px;" />
                        <button class="search-icon btn btn-success" type="submit" style="border-radius: 50px;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>


                <div class="dropdown">
                    <button class="btn-profile dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-circle-user"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>'s profile
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        if (isset($_SESSION['role']) && ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'petugas')) {
                            echo '<li><a class="dropdown-item" href="admin/index.php">Dashboard Admin</a></li>';
                        }
                        ?>
                        <li><a class="dropdown-item" href="edit-profile.php">Edit Profil</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal">Log out</a></li>
                    </ul>
                </div>
                                <!-- Tombol ikon search hanya tampil di layar kecil -->
                <button class="btn text-white d-lg-none btn-success" id="mobile-search-btn" aria-label="Cari">
                    <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                </button>
            </div>
        </nav>

        <!-- Modal Log Out -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #8EAEFF; color: white;">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-right-from-bracket"></i> Log Out</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="my-2"><i class="fa-solid fa-triangle-exclamation" style="color: #ff0000;"></i> Do you really wish to leave and logout?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No, Cancel</button>
                        <a href="logout.php" class="btn btn-danger">Yes, Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar bawah -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="grey" style="height: 52px;">
            <div class="container-fluid justify-content-center">
                <ul class="navbar-nav d-flex flex-row flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar-buku.php">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="daftar-peminjaman.php">Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="koleksi-pribadi.php">Koleksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang-kami.php">About us</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Search Bar Mobile - Hidden by default -->
    <div class="library-search-wrapper" id="searchbar-mobile">
        <div class="search-info text-center mb-3">
            <span class="fs-5 fw-semibold text-muted">Cari koleksi buku digital kami</span>
        </div>
        <form class="library-search-form d-flex" role="search" action="pencarian.php" method="GET">
            <input
                class="form-control search-input"
                type="search"
                name="keyword"
                placeholder="Judul buku, penulis, atau kategori..."
                aria-label="Search"
            />
            <button class="btn search-btn" type="submit" aria-label="Cari">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    <script>
        document.getElementById('mobile-search-btn').addEventListener('click', function () {
            const searchBar = document.getElementById('searchbar-mobile');
            // toggle class active untuk tampil/simpan search bar mobile
            searchBar.classList.toggle('active');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
</body>
</html>
