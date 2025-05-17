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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Halaman User</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>

    <!-- jQuery, Bootstrap JS & Slick JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

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
            box-shadow: 0 1px 2px rgba(0,0,0,0.2);
            transition: transform 0.5s ease;
            height: 100%;
            min-height: 430px; /* Minimal tinggi card */
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
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

        .book-slider {
            padding: 0 15px;
        }

        .book-slider .card {
            transition: transform 0.3s ease;
            height: 100%;
            min-height: 430px;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
            border: none;
        }

        .book-slider .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        }

        /* Responsive */
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
                max-width: none;
            }
        }

        @media (max-width: 576px) {
            .col-lg-4, .col-md-6, .col-sm-12 {
                width: 100%;
            }
            .carousel-item img {
                height: 200px;
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
        <div id="carouselExampleAutoplaying" class="carousel slide mt-4" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="#"><img src="storage/img/carousel1.png" class="d-block w-100" alt="..."></a>
                </div>
                <div class="carousel-item">
                    <a href="#"><img src="storage/img/carousel2.png" class="d-block w-100" alt="..."></a>
                </div>
                <div class="carousel-item">
                    <a href="#"><img src="storage/img/carousel3.png" class="d-block w-100" alt="..."></a>
                </div>
                <div class="carousel-item">
                    <a href="#"><img src="storage/img/carousel4.png" class="d-block w-100" alt="..."></a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleAutoplaying" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleAutoplaying" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </div>
    <!-- akhir carousel -->

    <div class="container mt-4">
        <div class="row baris">
            <h1>Kategori Populer</h1>
            <div class="col-lg-3 col-md-6 col-sm-12">    
                <div class="card">
                    <img src="storage/img/cover-pendidikan.png" class="card-img-top" alt="Pendidikan"> 
                    <span class="white-box">PENDIDIKAN</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/Cover-fiksi.png" class="card-img-top" alt="Fiksi">
                    <span class="white-box">FIKSI</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/cover-Sains.png" class="card-img-top" alt="Sains & Teknologi">
                    <span class="white-box">SAINS & TEKNOLOGI</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/cover-Kreativitas.png" class="card-img-top" alt="Hobi & Keterampilan">
                    <span class="white-box">HOBI & KETERAMPILAN</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/cover-fiksi.png" class="card-img-top" alt="Non-Fiksi">
                    <span class="white-box">NON-FIKSI</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="storage/img/cover-komik.png" class="card-img-top" alt="Komik">
                    <span class="white-box">KOMIK</span>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'layout/footer.php';
    ?>

<?php
$data = mysqli_query($koneksi, "SELECT * FROM buku");
?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">📚 Koleksi Buku Terpopuler</h2>
        <p class="text-muted">Jelajahi berbagai kategori buku yang tersedia di perpustakaan digital kami.</p>
        <div class="btn-group" role="group">
            <button class="btn btn-danger">Best Seller</button>
            <button class="btn btn-outline-dark">E-Books</button>
            <button class="btn btn-outline-dark">Text-Books</button>
        </div>
    </div>

    <div class="book-slider">
        <?php while ($book = mysqli_fetch_assoc($data)): ?>
            <?php
                $image = !empty($book['imagecover']) && file_exists('storage/upload/' . $book['imagecover']) 
                    ? 'storage/upload/' . htmlspecialchars($book['imagecover']) 
                    : 'storage/img/default-cover.jpg';
            ?>
            <div class="px-2">
                <div class="card h-100 shadow-sm border-0"  style="cursor: pointer;" onclick="location.href='detail-buku.php?id=<?= $book['BukuID']; ?>'">
                    <div style="height: 300px; overflow: hidden;">
                        <img src="<?= $image; ?>" class="card-img-top rounded-top w-100 h-100" alt="cover buku" style="object-fit: contain;">
                    </div>
                    <div class="card-body text-center">
                        <h6 class="card-title text-dark fw-semibold mb-1"><?= htmlspecialchars($book['Judul']); ?></h6>
                        <p class="text-muted small mb-0"><?= htmlspecialchars($book['Penulis'] ?? 'Penulis tidak diketahui'); ?></p>
                        <a href="detail-buku.php?id=<?= $book['BukuID']; ?>" class="btn btn-sm btn-primary mt-3">Detail Buku</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.book-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: true,
        autoplay: false,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});
</script>

<?php include 'layout/footer.php'; ?>
</body>
</html>
