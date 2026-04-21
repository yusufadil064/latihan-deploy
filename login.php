<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Aplikasi</title>
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>
    <div class="auth-card">
        <h2>Login Sistem</h2>

        <?php if(isset($_SESSION['success'])) { echo "<div class='alert alert-success'>".$_SESSION['success']."</div>"; unset($_SESSION['success']); } ?>
        <?php if(isset($_SESSION['error'])) { echo "<div class='alert alert-error'>".$_SESSION['error']."</div>"; unset($_SESSION['error']); } ?>

        <form action="proses/prosesLogin.php" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="telp">Nomor Telpon</label>
                <input type="text" id="telp" name="telp" placeholder="Masukkan Nomor Telpon Anda" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>
            <button type="submit" class="btn">Login Sekarang</button>
        </form>
        
        <div class="auth-footer">
            Belum punya akun? <a href="register.php">Register di sini</a>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>