<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: event.php");
    exit;
}

$id = $_GET['id'];

$query_event = mysqli_query($koneksi, "SELECT * FROM event WHERE id_event = '$id'");
$data_event = mysqli_fetch_assoc($query_event);

if (!$data_event) {
    header("Location: event.php");
    exit;
}

$klien_query = mysqli_query($koneksi, "SELECT * FROM klien ORDER BY nama_klien ASC");
$paket_query = mysqli_query($koneksi, "SELECT * FROM paket_event ORDER BY nama_paket ASC");

if (isset($_POST['update'])) {
    $id_klien = $_POST['id_klien'];
    $id_paket = $_POST['id_paket'];
    $nama_event = $_POST['nama_event'];
    $tanggal_event = $_POST['tanggal_event'];
    $lokasi = $_POST['lokasi'];
    $status = $_POST['status'];

    $sql = "UPDATE event SET 
    id_klien      = '$id_klien', 
    id_paket      = '$id_paket', 
    nama_event    = '$nama_event', 
    tanggal_event = '$tanggal_event', 
    lokasi        = '$lokasi', 
    status        = '$status' 
    WHERE id_event = '$id'";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: event.php");
        exit;
    }else {
        echo "Gagal mengupdate data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4 mb-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Data Event</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Nama Event</label>
                        <input type="text" name="nama_event" value="<?= htmlspecialchars($data_event['nama_event']); ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Klien (Pemesan)</label>
                        <select name="id_klien" class="form-select" required>
                            <option value="">-- Pilih Klien--</option>
                            <?php while ($k = mysqli_fetch_assoc($klien_query)) : ?>
                                <option value="<?= $k['id_klien']; ?>" <? ($k['id_klien'] == $data_event['id_klien']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialhars($k['nama_klien']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Paket Event</label>
                        <select name="id_paket" class="form-select" required>
                            <option value="">--Pilih Paket--</option>
                            <?php while ($p = mysqli_fetch_assoc($paket_query)) : ?>
                                <option value="<? $p['id_paket']; ?>" <?= ($p['id_paket'] == $data_event['id_paket']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($p['nama_paket']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Event</label>
                        <input type="date" name="tanggal_event" value="<?= $data_event['tanggal_event']; ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" value="<?= htmlspecialhars($data_event['lokasi']); ?>" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="event.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update" class="btn btn-warning">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>