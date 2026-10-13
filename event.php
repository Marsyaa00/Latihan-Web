<?php
include 'koneksi.php';

if (isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM event WHERE id_event='$id'");
    header("Location: event.php");
    exit;
}

$sql = "SELECT event.*, klien.nama_klien, paket_event.nama_paket
FROM event
LEFT JOIN klien ON event.id_klien = klien.id_klien
LEFT JOIN paket_event ON event.id_paket = paket_event.id_paket";

$query = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Daftar Data Event</h2>
    <div class="d-flex justify-content-between mb-3">
       <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
       <a href="tambah_event.php" class="btn btn-primary">+ Tambah Event</a>
    </div>
<table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Event</th>
                <th>Klien</th>
                <th>Paket</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $row['id_event']; ?></td>
                <td><?= $row['nama_event']; ?></td>
                <td><?= $row['nama_klien']; ?></td>
                <td><?= $row['nama_paket']; ?></td>
                <td><?= $row['tanggal_event']; ?></td>
                <td><?= $row['lokasi']; ?></td>
                <td><span class="badge bg-warning"><?= $row['status']; ?></span></td>
                <td>
                    <a href="edit_event.php?id=<?= $row['id_event']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="event.php?hapus=<?= $row['id_event']; ?>" onclick="return confirm('Hapus event ini?')" class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>