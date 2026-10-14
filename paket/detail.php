<?php
include "../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: daftar.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM Paket_Event WHERE id_paket = '$id'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data paket tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Paket - EvoFest</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <!-- CSS EvoFest -->
    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

</head>

<body>


<!-- DETAIL PAKET -->

<main class="detail-paket-page">

    <div class="container-evofest">

        <div class="detail-paket-card">

            <!-- ICON -->

            <div class="detail-icon">

                <i class="bi bi-ticket-perforated"></i>

            </div>

            <!-- NAMA PAKET -->

            <h1>

                <?= htmlspecialchars($data['nama_paket']); ?>

            </h1>

            <p class="detail-label">

                PAKET EVENT

            </p>

            <!-- HARGA -->

            <div class="detail-harga">

                <span>Rp</span>

                <?= number_format(
                    $data['harga'],
                    0,
                    ',',
                    '.'
                ); ?>

            </div>

            <div class="detail-garis"></div>

            <!-- FASILITAS -->

            <div class="detail-fasilitas">

                <h4>

                    <i class="bi bi-stars"></i>

                    Fasilitas Paket

                </h4>

                <?php

                $fasilitas = preg_split(
                    '/\r\n|\r|\n/',
                    $data['deskripsi']
                );

                foreach ($fasilitas as $item) {

                    if (trim($item) != '') {

                ?>

                    <div class="detail-fasilitas-item">

                        <i class="bi bi-check-circle-fill"></i>

                        <span>

                            <?= htmlspecialchars(trim($item)); ?>

                        </span>

                    </div>

                <?php

                    }

                }

                ?>

            </div>

            <!-- TOMBOL -->

            <div class="detail-button-group">
                <a
                    href="daftar.php"
                    class="btn-detail-kembali"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

                <a
                    href="../event/tambah.php?id_paket=<?=$data['id_paket']; ?>"
                    class="btn-detail-beli"
                >
                    <i class="bi bi-cart-check"></i>
                    Beli Paket
                </a>

            </div>

        </div>

    </div>

</main>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
</body>
</html>