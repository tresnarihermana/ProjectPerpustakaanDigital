<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("Location: login.php");
    exit;
} else {
    include 'layout/navbar.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman User</title>
    <style>
body {
    font-family: Arial, sans-serif;
}

.baris {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.card {
    width: 100%;
    max-width: 20rem;
    margin-top: 20px;
    cursor: pointer;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 2px 0 rgba(0, 0, 0, 0.19);
    transition: transform 0.5s ease;
}

.card:hover {
    transform: scale(1.05);
}

.card .card-img-top {
    width: 100%; /* Agar gambar memenuhi lebar card */
    height: 423px;
    margin-top: 10px;
}

.white-box {
    position: relative;
    z-index: 2;
    color: #000000;
    font-weight: 600;
    text-align: center;
    padding: 12px;
    font-size: 14px;
    font-family: "Oswald", sans-serif;
}

/* Media Queries */

@media (max-width: 1200px) {
    .col-lg-4 {
        width: 45%;
    }
}

@media (max-width: 768px) {
    .col-lg-4, .col-md-6 {
        width: 50%;
    }
    .card {
        width: 100%;
        max-width: none; /* Untuk memastikan card tidak melebihi lebar layar */
    }
}

@media (max-width: 576px) {
    .col-lg-4, .col-md-6, .col-sm-12 {
        width: 100%;
    }
    .carousel-item img {
        height: 200px; /* Ukuran gambar di carousel lebih kecil untuk layar kecil */
    }
    .white-box {
        font-size: 12px;
    }
}

    </style>
</head>
<body>
    <!-- carousel -->
    <div class="container">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" style="margin-top: 20px;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="#">
                        <img src="storage/img/carousel1.png" class="d-block w-100" alt="...">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img src="storage/img/carousel2.png" class="d-block w-100" alt="..."> 
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img src="storage/img/carousel3.png" class="d-block w-100" alt="...">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img src="storage/img/carousel4.png" class="d-block w-100" alt="...">
                    </a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- akhir carousel -->
    
    <div class="container mt-4">
        <div class="row baris">
            <h1>Kategori Populer</h1>
            <div class="col-lg-3 col-md-6 col-sm-12">    
                <div class="card">
                    <img src="storage/img/cover-pendidikan.png" class="card-img-top" alt=""> 
                    <span class="white-box">PENDIDIKAN</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/Cover-fiksi.png" class="card-img-top" alt="">
                    <span class="white-box">FIKSI</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/cover-Sains.png" class="card-img-top" alt="">
                    <span class="white-box">SAINS & TEKNOLOGI</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/cover-Kreativitas.png" class="card-img-top" alt="">
                    <span class="white-box">HOBI & KETERAMPILAN</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/cover-fiksi.png" class="card-img-top" alt="">
                    <span class="white-box">NON-FIKSI</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/cover-komik.png" class="card-img-top" alt="">
                    <span class="white-box">KOMIK</span>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'layout/footer.php';
    ?>
</body>
</html>
