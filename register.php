<?php 
    session_start(); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Aplikasi</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-card">
        <h2>Buat Akun Baru</h2>
        
        <?php if(isset($_SESSION['error'])) { echo "<div class='alert alert-error'>".$_SESSION['error']."</div>"; unset($_SESSION['error']); } ?>

        <form action="proses/prosesRegister.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label for="telp">Nomor Telpon</label>
                <input type="text" id="telp" name="telp" placeholder="Masukkan No Telp">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Buat password" required>
            </div>
            <button type="submit" class="btn btn-register">Daftar Sekarang</button>
        </form>
        
        <div class="auth-footer">
            Sudah punya akun? <a href="login.php">Login di sini</a>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>