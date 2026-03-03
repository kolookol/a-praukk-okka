<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="vh-100 d-flex align-items-center bg-light">
    <div class="container" style="max-width: 400px;">
        <div class="card card-body shadow-sm border-0 rounded-4">
            <div class="text-center mb-4">
                <h5 class="fw-bold">LOGIN</h5>
                <small class="text-muted">Silahkan Login Administrator</small>
            </div>

            <?php
            include 'koneksi.php';

            if (isset($_SESSION['status']) && ($_SESSION['status']) == "login") {
                echo "<script>location.href='admin.php';</script>";
            }

            if (isset($_POST['login'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                $cekuser = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");

                if (mysqli_num_rows($cekuser) > 0) {
                    $_SESSION["status"] = "login";
                    echo "<script>alert('Login Berhasil!'); location.href='admin.php';</script>";
                } else {
                    echo "<script>alert('User dan Password Salah!');</script>";
                }
            }
            ?>

            <form action="" method="POST">
                <input type="text" name="user" class="form-control mb-3" placeholder="Username" required>
                <input type="password" name="pass" class="form-control mb-3" placeholder="Password" required>
                <button name="login" class="btn btn-primary w-100 mb-3">MASUK</button>
            </form>

            <a href="index.php" class="small text-decoration-none text-center py-2">Kembali ke Beranda</a>
        </div>
    </div>
</body>

</html>