<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Akun - Perpustakaan Digital</title>
  <link rel="icon" href="/storage/img/logo.svg" type="image/x-icon" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
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
          <h4 class="mb-0"> Daftar Akun Baru</h4>
          <small>Perpustakaan Digital</small>
        </div>
        <div class="card-body">
          <form action="register.php" method="post">
            <div class="mb-3">
              <label for="Username" class="form-label">Username</label>
              <input type="text" class="form-control" id="Username" name="Username" placeholder="Masukkan username" required>
            </div>

            <div class="mb-3">
              <label for="Email" class="form-label">Email</label>
             <input type="email" class="form-control" id="Email" name="Email"
             pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$" required>

            </div>

            <div class="mb-3">
              <label for="Alamat" class="form-label">Alamat</label>
              <textarea class="form-control" id="Alamat" name="Alamat" rows="3" placeholder="Masukkan alamat" required></textarea>
            </div>

            <div class="mb-3">
              <label for="NamaLengkap" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="NamaLengkap" name="NamaLengkap" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
              <label for="Password" class="form-label">Password</label>
              <input type="password" class="form-control" id="Password" name="Password" placeholder="Masukkan password" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <button type="submit" class="btn btn-primary w-50 me-2">Daftar</button>
              <button type="button" class="btn btn-danger w-50 ms-2" onclick="window.location.href='login.html'">Sudah Punya Akun</button>
            </div>
          </form>
        </div>
        <div class="card-footer">
          © 2025 Perpustakaan Digital.
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
