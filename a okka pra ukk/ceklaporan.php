<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Aspirasi</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary shadow-sm mb-5 p-2">
    <div class="container">
        <a href="index.php" class="navbar-brand fw-bold">WEB ASPIRASI</a>
        <a href="login.php" class="btn btn-sm btn-outline-light fw-bold px-2 shadow-sm">LOGIN ADMIN</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">STATUS ASPIRASI</h5>
                    <form>
                        <div class="input-group">
                            <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS Anda..." required>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">CARI</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if(isset($_GET['nis'])) : ?>
            <?php
                $nis = $_GET['nis'];
                $carinis = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
                $hasilnis = mysqli_fetch_assoc($carinis);

                if($hasilnis) : ?>
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <div class="alert alert-primary">
                            Menampilkan laporan untuk: <strong><?php echo $hasilnis['nama_siswa']; ?></strong>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover small align-middle">
                                <thead>
                                    <tr class="table-light text-uppercase fw-bold">
                                        <th class="py-3">Tgl</th>
                                        <th>Laporan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ceklaporan = mysqli_query($koneksi, "SELECT * FROM aspirasi WHERE nis='$nis' ORDER BY id_aspirasi DESC");
                                    while($cekdata = mysqli_fetch_assoc($ceklaporan)) : ?>
                                    <tr class="border-bottom">
                                        <td class="text-muted"><?php echo date('d/m/Y', strtotime($cekdata['tanggal_input'])); ?></td>
                                        <td class="py-3">
                                            <div class="fw-bold"><?php echo $cekdata['lokasi']; ?></div>
                                            <div class="text-secondary"><?php echo $cekdata['deskripsi_laporan']; ?></div>
                                            
                                            <?php if($cekdata['tanggapan_admin']) : ?>
                                                <div class="mt-2 p-2 bg-light border-start border-3 border-primary small fst-italic">
                                                    Umpan balik: <?php echo $cekdata['tanggapan_admin']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge rounded-pill <?php echo get_status($cekdata['status_aspirasi']); ?>">
                                                <?php echo $cekdata['status_aspirasi']; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php else : ?>
                <div class="alert alert-danger text-center">
                    NIS TIDAK DITEMUKAN
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>