<?php
session_start();
include 'koneksi.php';
include 'layout/navbar.php';
include 'layout/alert.php';

$id = $_SESSION['UserID'];

// Ambil data Pengguna berdasarkan UserID
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE UserID = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    echo "Pengguna tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profil</title>

  <style>
    body {
      background: #f5f6fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      border: none;
      border-radius: 1rem;
    }

    .card-header {
      background-color: #6581ff;
      color: white;
      border-top-left-radius: 1rem;
      border-top-right-radius: 1rem;
      text-align: center;
      padding: 1.5rem 1rem;
    }

    .card-body {
      background-color: #ffffff;
      padding: 2rem;
    }

    .form-control {
      border-radius: 0.5rem;
      padding: 0.75rem;
    }

    .btn-primary, .btn-danger {
      padding: 0.6rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
    }

    .btn-primary {
      background-color: #6581ff;
      border: none;
    }

    .btn-danger {
      background-color: #ff4d4d;
      border: none;
    }

    .btn:hover {
      opacity: 0.9;
    }

    .card-footer {
      text-align: center;
      background: transparent;
      font-size: 0.9rem;
      padding: 1rem;
      color: #888;
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4 class="mb-0">Edit Profil</h4>
          <small>Perpustakaan Digital</small>
        </div>
        <div class="card-body">
          <form action="user/crud-edit-pengguna.php" method="post">
            <div class="mb-3">
              <label for="Username" class="form-label">Username</label>
              <input type="text" class="form-control" id="Username" name="Username" value="<?= htmlspecialchars($data['Username']); ?>" required>
            </div>

            <div class="mb-3">
              <label for="Email" class="form-label">Email</label>
              <input type="email" class="form-control" id="Email" name="Email" value="<?= htmlspecialchars($data['Email']); ?>" required>
            </div>

            <div class="mb-3">
              <label for="Alamat" class="form-label">Alamat</label>
              <textarea class="form-control" id="Alamat" name="Alamat" rows="3" required><?= htmlspecialchars($data['Alamat']); ?></textarea>
            </div>

            <div class="mb-3">
              <label for="NamaLengkap" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="NamaLengkap" name="NamaLengkap" value="<?= htmlspecialchars($data['NamaLengkap']); ?>" required>
            </div>

            <div class="mb-3">
              <label for="Password" class="form-label">Password</label>
              <input type="password" class="form-control" id="Password" name="Password" value="<?= htmlspecialchars($data['Password']); ?>" required>
            </div>

            <input type="hidden" name="UserID" value="<?= htmlspecialchars($data['UserID']); ?>">

            <div class="d-flex justify-content-between mt-4">
              <button type="submit" class="btn btn-primary w-50 me-2">Simpan</button>
              <button type="button" class="btn btn-danger w-50 ms-2" onclick="window.location.href='index.php'">Kembali</button>
            </div>
          </form>
        </div>
        <div class="card-footer">
          © 2025 <span style="color: #888;">Perpustakaan Digital</span>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
</body>
</html>
