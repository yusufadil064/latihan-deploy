<?php
session_start();
require '../service/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telp = htmlspecialchars($_POST['telp']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE telp = '$telp'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah user ada
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verifikasi kecocokan password dengan hash di database
        if (password_verify($password, $row['password'])) {
            // Set Session
            $_SESSION['id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['role'] = $row['role'];

            // Logika Redirect berdasarkan Role
            if ($row['role'] == 'admin') {
                header("Location: ../dashboardAdmin.php");
            } else {
                header("Location: ../beranda.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Password salah!";
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "User tidak ditemukan!";
        header("Location: ../login.php");
        exit();
    }
}
?>