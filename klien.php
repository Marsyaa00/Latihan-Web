<?php
include 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM klien WHERE id_klien='$id'");
    header("Location: klien.php");
    exit;
}
$query = mysqli_query($koneksi,"SELECT * FROM klien ORDER BY id_klien ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Klien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Daftar Data Klien</h2>

    <div class="d-flex justify-content-between mb-3">
       <a href="index.php" class="btn btn-secondary mb-3">Kembali Ke Dashboard</a>
       <a href="tambah_klien.php" class="btn btn-primary">+ Tambah Klien</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Klien</th>
                <th>No Telepon</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= $row['id_klien'];?></td>
                    <td><?= $row['nama_klien'];?></td>
                    <td><?= $row['no_telepon'];?></td>
                    <td><?= $row['email'];?></td>
                    <td><?= $row['alamat'];?></td>
                    <td>
                        <a href="edit_klien.php?id=<?= $row['id_klien']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="klien.php?hapus=<?= $row['id_klien']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>