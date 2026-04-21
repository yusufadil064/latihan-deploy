<?php
session_start();
require './service/koneksi.php';

// Validasi: Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Menangkap 'id' dari parameter URL (menggunakan $_GET)
$id = $_GET['id'];

// Mengambil data mahasiswa spesifik berdasarkan ID
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data mahasiswa tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/auth.css"> 
</head>
<body>
    <div class="auth-card">
        <h2>Edit Data Mahasiswa</h2>
        
        <form action="proses/prosesEdit.php" method="POST">
            
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" id="nim" value="<?php echo $data['nim']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="<?php echo $data['nama']; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" name="jurusan" id="jurusan" value="<?php echo $data['jurusan']; ?>" required>
            </div>
            
            <button type="submit" class="btn">Update Data</button>
        </form>
        
        <div class="auth-footer">
            <br>
            <a href="dashboardAdmin.php" style="color: #667eea;">&larr; Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html> 