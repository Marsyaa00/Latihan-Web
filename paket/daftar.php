<?php
include "../config/koneksi.php";

$query = "SELECT * FROM Paket_Event ORDER BY id_paket ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Event - Event Entertaiment</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
<main class="paket-page">
    <div class="container-evofest">
        <div class="paket-title">
            <p class="paket-subtitle">
                OUR PACKAGE
            </p>

            <h1>
                Paket
            </h1>

            <p>
                Pilih Paket Terbaik Untuk Membantu Mewujudkan
                Acara Yang Sesuai Dengan Kebutuhan Anda
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="paket-card-user">
                            <div class="paket-card-header">
                                <i class="bi bi-stars"></i>

                                <h3>
                                    <?= htmlspecialchars($data['nama_paket']); ?>
                                </h3>

                            </div>

                            <div class="paket-card-body">
                                <div class="harga-label">
                                    Mulai dari
                                </div>

                                <div class="harga-paket">
                                    <span>Rp</span>
                                    <?= number_format(
                                        $data['harga'],
                                        0,
                                        ',',
                                        '.'
                                    ); ?>
                                </div>

                                <div class="garis-paket"></div>
                                <div class="fasilitas-paket">
                                    <?php
                                    $fasilitas = preg_split(
                                        '/\r\n|\r|\n/',
                                        $data['deskripsi']
                                    );

                                    foreach ($fasilitas as $item) {

                                        if (trim($item) != '') {

                                    ?>

                                        <div class="fasilitas-item">
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
                                
                                <a
                                    href="../event/tambah.php?id_paket=<?= $data['id_paket']; ?>"
                                    class="btn-beli-paket"
                                >
                                    <i class="bi bi-cart-check"></i>
                                    BELI PAKET
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <div class="paket-kosong">
                        <i class="bi bi-inbox"></i>
                        <h4>
                            Belum Ada Paket
                        </h4>
                        <p>
                            Paket Event Belum Tersedia!!
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
</body>
</html>