<?php
include 'config/session.php'
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Scan Barcode Buku</title>
    <link rel="icon" href="../storage/img/logo.svg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .scanner-container {
            max-width: 600px;
            margin: 50px auto;
        }
        .scanner-box {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            background: white;
            padding: 25px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        #reader {
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
</head>
<body>

<?php 
    $id = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        $id = htmlspecialchars($_POST["id"]);
        header("Location: peminjaman-edit.php?id=" . urlencode($id));
        exit;
    }
?>

<div class="container scanner-container">
    <div class="scanner-box">
        <h3 class="text-center mb-4"><i class="fa-solid fa-barcode"></i> Scan Barcode Peminjam</h3>

        <!-- Tempat Kamera -->
        <div id="reader" class="mb-4"></div>

        <!-- Hasil Scan dan Form -->
        <form action="" method="post">
            <div class="mb-3">
                <label for="scan-result" class="form-label fw-semibold">Hasil Scan:</label>
                <input type="text" id="scan-result" name="id" class="form-control form-control-lg text-center"  placeholder="Scan kode peminjaman atau Masukan secara manual...">
            </div>
            <button type="submit" class="btn btn-success w-100">
                <i class="fa-solid fa-search"></i> Cari Buku
            </button>
            <button type="button" id="reset-scan" class="btn btn-secondary w-100 mt-2 d-none">
                <i class="fa-solid fa-arrows-rotate"></i> Ulangi Scan
            </button>
        </form>
    </div>
</div>

<!-- Script QR Scanner -->
<script>
    let html5QrcodeScanner;

    function onScanSuccess(decodedText, decodedResult) {
        document.getElementById('scan-result').value = decodedText;

        // Hentikan scanner setelah berhasil scan
        html5QrcodeScanner.clear().then(() => {
            // Tampilkan tombol reset
            document.getElementById('reset-scan').classList.remove('d-none');
        }).catch(error => {
            console.error('Gagal menghentikan scanner:', error);
        });
    }

    // Inisialisasi scanner
    html5QrcodeScanner = new Html5QrcodeScanner("reader", {
        fps: 10,
        qrbox: { width: 300, height: 300 }
    }, false);

    html5QrcodeScanner.render(onScanSuccess);

    // Logika tombol reset
    document.getElementById('reset-scan').addEventListener('click', function() {
        document.getElementById('scan-result').value = '';
        this.classList.add('d-none');

        // Mulai ulang scanner
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>


</body>
</html>
