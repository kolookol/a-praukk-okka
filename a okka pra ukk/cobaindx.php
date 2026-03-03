<?php include 'koneksi.php' ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary shadow-sm mb-5 p-2">
        <div class="container">
            <a href="index.php" class="navbar-brand fw-bold">WEB ASPIRASI</a>
            <a href="login.php" class="btn btn-sm btn-outline-light fw-bold px-2 shadow-sm">LOGIN ADMIN</a>
        </div>
    </nav>

    <div class="container d-flex justify-content-center" >
        <div class=" card w-50 shadow-sm border-0"></div>
        
        <?php 
        if(isset($_POST['kirimlaporan'])){
            $nis = $_POST['nis'];
            $kategori = $_POST['kategori'];
            $lokasi = $_POST['lokasi'];
            $laporan =$_POST['laporan'];

            $ceknis = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis");
        }
        ?>
    </div>
</body>

</html>