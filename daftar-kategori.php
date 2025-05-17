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
    <title>Daftar Kategori</title>
</head>
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
</style>
<body>
    <div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">📖 Jelajahi Kategori Buku</h2>
        <p class="text-muted">Temukan buku favoritmu berdasarkan kategori yang telah kami sediakan.</p>
    </div>

    <div class="row baris">

        <?php
        include 'koneksi.php';

        $kategori = mysqli_query($koneksi, "SELECT * FROM kategoribuku");

        while ($data = mysqli_fetch_assoc($kategori)) :
        ?>
            <div class="col-lg-3 col-md-4 col-sm-12 mb-3">
                <div class="card" style="cursor: pointer;" onclick="location.href='daftar-buku-kategori.php?id=<?= $data['KategoriID']; ?>'">
                    <img src="storage/upload/<?= htmlspecialchars($data['coverkategori']); ?>" class="card-img-top" alt="<?= htmlspecialchars($data['Namakategori']); ?>">
                    <span class="white-box"><?= strtoupper(htmlspecialchars($data['Namakategori'])); ?></span>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include 'layout/footer.php'?>
</body>
</html>