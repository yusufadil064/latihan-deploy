<?php
session_start();
require '../service/koneksi.php'; // Naik satu folder ke file koneksi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi Server-Side: Anti SQL Injection & XSS
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $telp = htmlspecialchars($_POST['telp']);
    $password = $_POST['password'];
    
    // Cek apakah email sudah terdaftar
    $cek_email = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($cek_email) > 0) {
        $_SESSION['error'] = "Email sudah digunakan!";
        header("Location: ../register.php");
        exit();
    }

    // Hashing Password (Praktik Keamanan yang wajib diajarkan)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data (Role default adalah 'user')
    $query = "INSERT INTO users (nama, email, telp, password, role) VALUES ('$nama', '$email', '$telp', '$hashed_password', 'user')";
    
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan Login.";
        header("Location: ../login.php");
    } else {
        $_SESSION['error'] = "Terjadi kesalahan sistem.";
        header("Location: ../register.php");
    }
}
?>