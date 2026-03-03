<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aspirasi Siswa</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4 p-2">
        <div class="container">
            <a href="admin.php" class="navbar-brand fw-bold">WEB ASPIRASI</a>
        </div>
    </nav>

    <?php
    include 'koneksi.php';
    $id = $_GET['aspirasi'];

    if (!isset($_SESSION['status'])) {
        header("Location: login.php");
    }

    if (!isset($_GET['aspirasi']) || empty($_GET['aspirasi'])) {
        header("Location: admin.php");
        exit;
    }

    if (isset($_POST['kirimtanggapan'])) {
        $status = $_POST['status'];
        $tanggapan = $_POST['tanggapan_admin'];

        $updateaspirasi = mysqli_query($koneksi, "UPDATE aspirasi SET status_aspirasi='$status', tanggapan_admin='$tanggapan' WHERE id_aspirasi='$id'");

        if ($updateaspirasi) {
            echo "<script>alert('Tanggapan Berhasil dikirim!');location.href='admin.php';</script>";
        } else {
            echo "<script>alert('Tanggapan Gagal dikirim!');</script>";
        }
    }

    $ambildata = mysqli_query($koneksi, "SELECT * FROM aspirasi WHERE id_aspirasi = '$id'");
    $data = mysqli_fetch_assoc($ambildata);
    ?>

    <div class="container d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-body">
                <h5 class="fw-bold mb-3">TANGGAPI ASPIRASI</h5>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold mt-2">Status</label>
                        <select name="status" class="form-select">
                            <option value="Menunggu" <?php if ($data['status_aspirasi'] == "Menunggu")
                                echo 'selected'; ?>>
                                Menunggu</option>
                            <option value="Proses" <?php if ($data['status_aspirasi'] == "Proses")
                                echo 'selected'; ?>>
                                Proses</option>
                            <option value="Selesai" <?php if ($data['status_aspirasi'] == "Selesai")
                                echo 'selected'; ?>>
                                Selesai</option>
                        </select>

                        <label class="form-label fw-bold mt-2">Tanggapan</label>
                        <textarea class="form-control" rows="4"
                            name="tanggapan_admin"><?php echo $data['tanggapan_admin'] ?></textarea>
                        <button type="submit" class="form-control btn btn-primary mt-3 fw-bold"
                            name="kirimtanggapan">SIMPAN DATA</button>
                    </div>
                </form>
                <a href="admin.php" class="btn btn-danger form-control">BATAL</a>
            </div>
        </div>
    </div>

</body>

</html>