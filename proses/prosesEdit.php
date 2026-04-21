<?php
    session_start();
    require '../service/koneksi.php';
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];

    $query = "UPDATE mahasiswa SET nim='$nim', nama='$nama', jurusan='$jurusan' WHERE id='$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../dashboardAdmin.php");
    }
?>