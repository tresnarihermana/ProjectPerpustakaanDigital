<?php
session_start();
include 'koneksi.php';
include 'layout/navbar.php';
include 'layout/alert.php';
$id = $_SESSION['UserID'];
// Ambil data Pengguna berdasarkan PenggunaID
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE UserID = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika Pengguna tidak ditemukan
if (!$data) {
    echo "Pengguna tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
<div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header mb-0">
                        <h5 class="text-center">Selamat Datang di<br/><span class="navbar-brand">Perpustakaan Digital</span></h5>
                    </div>
            <div class="card-body">
                <form action="user/crud-edit-pengguna.php" method="post">
                    <div class="mb-3">
                        <label for="Username" class="form-label">Username</label>
                        <input type="Username" class="form-control" id="Username"  value="<?php echo htmlspecialchars($data['Username']); ?>" name="Username" required>
                    </div>
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="Email" value="<?php echo htmlspecialchars($data['Email'])?>" name="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="Alamat" class="form-label">Alamat</label>
                        <input type="Alamat" class="form-control" id="" value="<?php echo htmlspecialchars($data['Alamat'])?>" name="Alamat" style="height: 100px;" required>
                    </div>
                    <div class="mb-3">
                        <label for="NamaLengkap" class="form-label">Nama Lengkap</label>
                        <input type="NamaLengkap" class="form-control" id="NamaLengkap" value="<?php echo htmlspecialchars($data['NamaLengkap'])?>" name="NamaLengkap" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" value="<?php echo htmlspecialchars($data['Password'])?>" id="exampleInputPassword1" name="Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputID1" class="form-label"></label>
                        <input type="hidden" class="form-control" value="<?php echo htmlspecialchars($data['UserID'])?>" id="exampleInputID" name="UserID" required>
                    </div>
                    
                    <div class="button justify-content-between d-flex">
                        <input type="submit" class="btn btn-primary" value="Edit Profile" style="width: 105px;">
                        <input type="button" class="btn btn-danger" value="Kembali" onclick="window.location.href='login.html'" style="width: 105px;">
                    </div>
                </form>
                </div>
                <div class="card-footer mb-0">
                    <h5 class="text-center">© 2025 <span style="color: #888;">Perpustakaan Digital.</span></h5>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'layout/footer.php'
?>
</body>
</html>