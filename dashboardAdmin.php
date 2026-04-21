<?php
session_start();
require './service/koneksi.php';
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php"); exit();
}
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        table, th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .btn-add { background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
        .btn-edit { color: blue; text-decoration: none; margin-right: 10px; }
        .btn-delete { color: red; text-decoration: none; }
    </style>
</head>
<body>
    <div class="sidebar admin-theme">
        <div class="sidebar-header">Admin Panel</div>
        <ul class="sidebar-menu"><li><a href="#">Kelola Mahasiswa</a></li></ul>
    </div>
    <div class="main-content">
        <div class="navbar"><a href="logout.php" class="btn-logout">Logout</a></div>
        <div class="content">
            <div class="card">
                <h3>Manajemen Data Mahasiswa</h3>
                <a href="tambah_data.php" class="btn-add">+ Tambah Mahasiswa</a>
                <br><br>
                <table>
                    <tr><th>NIM</th><th>Nama</th><th>Jurusan</th><th>Aksi</th></tr>
                    <?php while($row = mysqli_fetch_assoc($query)) : ?>
                    <tr>
                        <td><?= $row['nim']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['jurusan']; ?></td>
                        <td>
                            <a href="edit_data.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                            <a href="proses/prosesHapus.php?id=<?= $row['id']; ?>" class="btn-delete" onclick="return confirm('Yakin hapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>