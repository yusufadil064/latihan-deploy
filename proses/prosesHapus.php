<?php
    session_start();
    require '../service/koneksi.php';
    $id = $_GET['id'];

    $query = "DELETE FROM mahasiswa WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../dashboardAdmin.php");
    }
?>