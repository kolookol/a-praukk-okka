<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aspirasi Siswa</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary shadow-sm mb-5 p-2">
        <div class="container">
            <a href="index.php" class="navbar-brand fw-bold">WEB ASPIRASI</a>
            <a href="login.php" class="btn btn-sm btn-outline-light fw-bold px-2 shadow-sm">LOGIN ADMIN</a>
        </div>
    </nav>

    <div class="container d-flex justify-content-center">
        <div class="card w-50 shadow-sm border-0">

            <?php
            if (isset($_POST['kirimlaporan'])) {

                $nis = $_POST['nis'];
                $kategori = $_POST['kategori'];
                $lokasi = $_POST['lokasi'];
                $laporan = $_POST['laporan'];

                $ceknis = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");

                if (mysqli_num_rows($ceknis) > 0) {

                    mysqli_query($koneksi, "INSERT INTO aspirasi (nis, id_kategori, lokasi, deskripsi_laporan) 
                                VALUES ('$nis','$kategori','$lokasi','$laporan')");

                    echo "<script>alert('Laporan Terkirim!'); window.location='index.php';</script>";

                } else {

                    echo "<script>alert('NIS Tidak Terdaftar!');</script>";

                }
            }
            ?>

            <div class="card-header bg-primary py-3 text-white text-center">
                <h5 class="fw-bold">BUAT LAPORAN</h5>
            </div>

            <div class="card-body">
                <form action="" method="POST">

                    <input type="number" name="nis" class="form-control mb-3" placeholder="Masukan Nomor Induk Siswa"
                        required>

                    <select name="kategori" class="form-select mb-3" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        $ambilkategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while ($kategori = mysqli_fetch_assoc($ambilkategori)):
                            ?>
                            <option value="<?php echo $kategori['id_kategori']; ?>">
                                <?php echo $kategori['nama_kategori']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                    <input type="text" name="lokasi" class="form-control mb-3" placeholder="Masukan Lokasi Kejadian"
                        required>

                    <textarea name="laporan" class="form-control mb-3" rows="4" placeholder="Apa yang ingin dilaporkan"
                        required></textarea>

                    <button type="submit" name="kirimlaporan" class="btn btn-primary w-100">KIRIM</button>

                </form>
            </div>

            <a href="ceklaporan.php" class="text-center small text-decoration-none py-3 d-block">
                Cek Status Laporan →
            </a>

        </div>
    </div>

</body>

</html>