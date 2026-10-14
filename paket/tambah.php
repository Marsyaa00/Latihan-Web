<?php

include "../koneksi.php";

if (isset($_POST['simpan'])) {

    $nama_paket = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_paket']
    );

    $harga = mysqli_real_escape_string(
        $koneksi,
        $_POST['harga']
    );

    $deskripsi = mysqli_real_escape_string(
        $koneksi,
        $_POST['deskripsi']
    );

    $query = "
        INSERT INTO Paket_Event
        (
            nama_paket,
            harga,
            deskripsi
        )
        VALUES
        (
            '$nama_paket',
            '$harga',
            '$deskripsi'
        )
    ";

    if (mysqli_query($koneksi, $query)) {

        echo "<script>
                alert('Paket berhasil ditambahkan!');
                window.location='index.php';
              </script>";

    } else {

        echo "Data gagal ditambahkan: "
             . mysqli_error($koneksi);

    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Paket - Event Entertaiment</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >
</head>
<body>

<main class="container-evofest">
    <div class="card-evofest">
        <div class="mb-4">
            <h1>
                <i class="bi bi-plus-circle"></i>
                Tambah Paket
            </h1>

            <p class="text-secondary mb-0">
                Tambahkan paket event baru ke dalam sistem
            </p>
        </div>

        <form method="POST">
            <!-- Nama Paket -->
            <div class="mb-3">
                <label class="form-label">
                    Nama Paket
                </label>

                <input
                    type="text"
                    name="nama_paket"
                    class="form-control"
                    placeholder="Contoh: Standart"
                    required
                >
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label class="form-label">
                    Harga
                </label>

                <input
                    type="number"
                    name="harga"
                    class="form-control"
                    placeholder="Contoh: 12000000"
                    min="0"
                    required
                >
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="form-label">
                    Fasilitas 
                </label>

                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="5"
                    placeholder="Contoh :
                    Sound System
                    Panggung
                    Lighting
                    Dokumentasi"
                    required
                ></textarea>
                <small class="text-secondary">
                    Tulis setiap fasilitas pada baris yang berbeda
                </small>
            </div>

            <!-- Tombol -->
            <div class="d-flex gap-2">

                <a
                    href="index.php"
                    class="btn btn-secondary"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

                <button
                    type="submit"
                    name="simpan"
                    class="btn-evofest"
                >
                    <i class="bi bi-save"></i>
                    Simpan Paket
                </button>
            </div>
        </form>
    </div>
</main>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
</body>
</html>