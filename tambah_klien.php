<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_klien'];
    $telepon = $_POST['no_telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $sql = " INSERT INTO klien (nama_klien, no_telepon, email, alamat) VALUES ('$nama', '$telepon', '$email', '$alamat')";
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
    <title>Tambah Klien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Tambah Data Klien</h2>
    <form method="POST">
        <div calss="mb-3">
            <label>Nama Klien</label>
            <input type="text" name="nama_klien" class="form-control" required>
        <div>
        <div class="mb-3">
            <label>No Telepon</label>
            <input type="text" name="no_telepon" class="form_control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="klien.php" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>