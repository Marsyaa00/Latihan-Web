<?php
include "../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM Paket_Event WHERE id_paket = '$id'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data Paket Tidak Ditemukan!!");
}

if (isset($_POST['update'])) {

    $nama_paket = mysqli_real_escape_string($koneksi, $_POST['nama_paket']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $sql_update = "UPDATE Paket_Event SET
                    nama_paket = '$nama_paket',
                    harga = '$harga',
                    deskripsi = '$deskripsi'
                   WHERE id_paket = '$id'";

    $update = mysqli_query($koneksi, $sql_update);

    if ($update) {
        echo "<script>
                alert('Paket Berhasil Diubah');
                window.location='index.php';
              </script>";
    } else {
        echo "DATA GAGAL DIUBAH!! : " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.8">

    <title>Edit Paket - EvoFest</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
    <main class="container-evofest">
        <div class="card-evofest">
            <div class="mb-4">
                <h1>
                    <i class="bi bi-pencil-square"></i>
                    Edit Paket
                </h1>

                <p class="text-secondary">
                    Ubah Data Paket Yang Dipilih!
                </p>
            </div>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">
                        Nama Paket
                    </label>

                    <input
                        type="text"
                        name="nama_paket"
                        class="form-control"
                        value="<?= htmlspecialchars($data['nama_paket']); ?>" 
                        required
                    >

                </div>

                <dic class="mb-3">
                    <label class="form-label">
                        Harga
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            Rp 
                        </span>

                        <input
                            type="number"
                            name="harga"
                            class="form-control"
                            value="<?= $data['harga']; ?>"
                            min="0"
                            required
                        >

                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        class="form-control"
                        rows="4"
                        required
                    ><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button
                        type="submit"
                        name="update"
                        class="btn-evofest"
                    >
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>

                    <a
                        href="index.php"
                        class="btn btn-outline-secondary"
                    >

                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>