<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard Admin</title>
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4 p-2">
        <div class="container">
            <a href="admin.php" class="navbar-brand fw-bold">WEB ASPIRASI</a>
            <a href="admin.php?logout" class="btn btn-outline-danger btn-sm px-4">KELUAR</a>
        </div>
    </nav>

    <div class="container">
        <div class="card card-body">
            <form class="row" action="" method="GET">
                <div class="col-md-5">
                    <input type="date" name="tanggal" class="form-control" placeholder="Pilih Tanggal"
                        value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : ''; ?>">
                </div>
                <div class="col-md-5">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" <?php if (isset($_GET['status']) && $_GET['status'] == "Menunggu")
                            echo "selected"; ?>>Menunggu</option>
                        <option value="Proses" <?php if (isset($_GET['status']) && $_GET['status'] == "Proses")
                            echo "selected"; ?>>Proses</option>
                        <option value="Selesai" <?php if (isset($_GET['status']) && $_GET['status'] == "Selesai")
                            echo "selected"; ?>>Selesai</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">FILTER</button>
                </div>
            </form>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle m-0">
                    <tr class="table-light small fw-bold text-uppercase">
                        <th class="p-3">Tanggal</th>
                        <th>Siswa</th>
                        <th>Laporan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>

                    <?php
                    include 'koneksi.php';

                    if (isset($_GET['logout'])) {
                        session_destroy();
                        header("location:login.php");
                        exit();
                    }

                    if (!isset($_SESSION['status'])) {
                        header("location:login.php");
                    }

                    $sql = "SELECT aspirasi.*, siswa.nama_siswa FROM aspirasi JOIN siswa ON aspirasi.nis = siswa.nis WHERE 1=1";
                    if (!empty($_GET['tanggal']))
                        $sql .= " AND DATE(tanggal_input) = '" . $_GET['tanggal'] . "'";
                    if (!empty($_GET['status']))
                        $sql .= " AND status_aspirasi = '" . $_GET['status'] . "'";
                    $sqldata = mysqli_query($koneksi, $sql . " ORDER BY id_aspirasi DESC");

                    if (mysqli_num_rows($sqldata) > 0) {
                        while ($data = mysqli_fetch_assoc($sqldata)):
                            ?>

                            <tr>
                                <td class="p-4 text-muted small"><?php echo date('d/m/Y', strtotime($data['tanggal_input'])); ?>
                                </td>
                                <td>
                                    <div class="fw-bold"><?php echo $data['nama_siswa']; ?></div>
                                    <div class="small text-muted"><?php echo $data['nis']; ?></div>
                                </td>
                                <td>
                                    <div class="fw-bold text-primary"><?php echo $data['lokasi']; ?></div>
                                    <div class="small text-secondary"><?php echo $data['deskripsi_laporan']; ?></div>
                                </td>
                                <td class="text-center">
                                    <span class="badge rounded-pill <?php echo get_status($data['status_aspirasi']); ?>">
                                        <?php echo $data['status_aspirasi']; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="responaspirasi.php?aspirasi=<?php echo $data['id_aspirasi']; ?>"
                                        class="btn btn-sm btn-dark px-3 rounded-pill">RESPON</a>
                                </td>
                            </tr>

                            <?php
                        endwhile;
                    } else {
                        ?>

                        <tr>
                            <td colspan="5" class="p-4">
                                <div class="alert alert-warning text-center mb-0">
                                    <strong>Data tidak ditemukan</strong>
                                </div>
                            </td>
                        </tr>

                    <?php } ?>

                </table>
            </div>
        </div>
    </div>

</body>

</html>     