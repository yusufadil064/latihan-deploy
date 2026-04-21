<?php
    session_start();
    require '../service/koneksi.php';
    
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    
    // Tangkap nama provinsi (dari input hidden) dan nama kabupaten
    $nama_provinsi = $_POST['nama_provinsi'];
    $nama_kabupaten = $_POST['kabupaten'];

    // Gabungkan menjadi satu string untuk kolom alamat
    $alamat_lengkap = $nama_kabupaten . ", " . $nama_provinsi;

    $query = "INSERT INTO mahasiswa (nim, nama, jurusan, alamat) VALUES ('$nim', '$nama', '$jurusan', '$alamat_lengkap')";
    
    if(mysqli_query($koneksi, $query)) {
        header("Location: ../dashboardAdmin.php");
    }
?>