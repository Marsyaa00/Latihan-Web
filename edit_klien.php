<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM klien WHERE id_klien='$id'"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama_klien'];
    $telepon = $_POST['no_telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $sql = "UPDATE klien SET nama_klien='$nama', no_telepon='$telepon', email='$email', alamat='$alamat' WHERE id_klien='$id'";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: klien.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Klien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Edit Data Klien</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Klien</label>
            <input type="text" name="nama_klien" value="<?= $data['nama_klien']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No Telepon</label>
            <input type="text" name="no_telepon" value="<?= $data['no_telepon']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="<?= $data['email']; ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
        <a href="klien.php" class="btn btn-secondary">Batal</a>
    </from>
</body>
</html>