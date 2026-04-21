<?php
session_start();
require './service/koneksi.php';
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php"); exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda User</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        table, th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">Portal User</div>
        <ul class="sidebar-menu"><li><a href="#">Data Mahasiswa</a></li></ul>
    </div>
    <div class="main-content">
        <div class="navbar"><a href="logout.php" class="btn-logout">Logout</a></div>
        <div class="content">
            <div class="card">
                <h3>Daftar Mahasiswa (View Only)</h3>
                <table>
                    <tr><th>NIM</th><th>Nama</th><th>Jurusan</th></tr>
                    <?php while($row = mysqli_fetch_assoc($query)) : ?>
                    <tr>
                        <td><?= $row['nim']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['jurusan']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>