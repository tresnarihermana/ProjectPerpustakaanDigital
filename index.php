<?php
session_start();
if (!isset($_SESSION['status'])) {
    header("Location: login.php");
    exit;
} else {
    include 'layout/navbar.php';
    include 'layout/scrolltop.php';

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Perpustakaan Digital</title>


    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>

    <!-- jQuery, Bootstrap JS & Slick JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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
    .swiper {
            width: 100%;
            height: auto;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .swiper-slide img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .swiper-button-next, .swiper-button-prev {
            color: #000;
        }

        .swiper-pagination-bullet {
            background: #fff;
            opacity: 0.7;
            width: 10px;
            height: 10px;
        }

        .swiper-pagination-bullet-active {
            background: var(--primary-color);
            opacity: 1;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1rem;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 48px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        /* Responsive Breakpoints */
        @media (max-width: 1400px) {
            .card {
                min-height: 360px;
            }
        }

        @media (max-width: 1200px) {
            .col-xl-3 {
                flex: 0 0 33.333%;
                max-width: 33.333%;
            }
            
            .swiper-slide img {
                height: 350px;
            }
        }

        @media (max-width: 992px) {
            .col-xl-3, .col-lg-4 {
                flex: 0 0 50%;
                max-width: 50%;
            }
            
            .swiper-slide img {
                height: 300px;
            }
            
            .book-slider .card {
                min-height: 380px;
            }
                        .card{
                height: 100%;
                width: 100%;
                margin-left: auto;
                margin-right: auto;

            }
            .baris{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 0 !important;
            }
        }
        
        @media (max-width: 768px) {
            .col-xl-3, .col-lg-4, .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
            
            .swiper-slide img {
                height: 250px;
            }
            
            .book-slider .card {
                min-height: 360px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .col-xl-3, .col-lg-4, .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            
            .swiper-slide img {
                height: 200px;
            }
            
            .white-box {
                font-size: 13px;
                padding: 8px;
            }
            
            .card {
                min-height: 320px;
                max-width: 320px;
                margin-left: auto;
                margin-right: auto;
            }
            
            .book-slider .card {
                min-height: 340px;
            }
            
            .section-title {
                font-size: 1.3rem;
            }
            .baris{
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 0 !important;
            }
        }

        @media (max-width: 400px) {
            .swiper-slide img {
                height: 180px;
            }
            
            .card {
                min-height: 300px;
            }
            
            .book-slider .card {
                min-height: 320px;
            }
        }

        @media (max-width: 576px) {
            .swiper-slide img {
                height: 200px;
            }
        }
    </style>
</head>
<body>


<!-- Container untuk Swiper Carousel -->
<div class="container mt-5">

    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a href="#"><img src="storage/img/carousel1.png" alt="Banner 1"></a>
            </div>
            <div class="swiper-slide">
                <a href="#"><img src="storage/img/carousel2.png" alt="Banner 2"></a>
            </div>
            <div class="swiper-slide">
                <a href="#"><img src="storage/img/carousel3.png" alt="Banner 3"></a>
            </div>
            <div class="swiper-slide">
                <a href="#"><img src="storage/img/carousel4.png" alt="Banner 4"></a>
            </div>
        </div>

        <!-- Navigasi & Pagination -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>


<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Konfigurasi Swiper -->
<script>
    const swiper = new Swiper(".mySwiper", {
        loop: true,
        speed: 900,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>

    <!-- akhir carousel -->

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">📖 Jelajahi Kategori Buku</h2>
        <p class="text-muted">Temukan buku favoritmu berdasarkan kategori yang sudah kami sediakan.</p>
    </div>

    <div class="row baris">

        <?php
        include 'koneksi.php';

        $kategori = mysqli_query($koneksi, "SELECT * FROM kategoribuku ORDER BY KategoriID DESC LIMIT 6");

        while ($data = mysqli_fetch_assoc($kategori)) :
        ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
                <div class="card" style="cursor: pointer;" onclick="location.href='daftar-buku-kategori.php?id=<?= $data['KategoriID']; ?>'">
                    <img src="storage/upload/<?= htmlspecialchars($data['coverkategori']); ?>" class="card-img-top" alt="<?= htmlspecialchars($data['Namakategori']); ?>">
                    <span class="white-box"><?= strtoupper(htmlspecialchars($data['Namakategori'])); ?></span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>


<?php
$data = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY BukuID DESC LIMIT 12");
?>

<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">📚 Koleksi Buku Terbaru</h2>
        <p class="text-muted">Jelajahi berbagai  buku-buku yang tersedia di perpustakaan digital kami.</p>

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
<?php
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE ebook != ''  ORDER BY BukuID DESC LIMIT 12");
?>
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">📚 Ebook Gratis Siap Baca Di Tempat</h2>
        <p class="text-muted">Baca buku dimana saja dengan ebook-ebook pilihan kami.</p>

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
