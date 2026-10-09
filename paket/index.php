<?php

include "../config/koneksi.php";

$query = "SELECT * FROM Paket_Event ORDER BY id_paket DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Kelola Paket - Event Entertaiment</title>

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

    <!-- CSS -->
    <link
        rel="stylesheet"
        href="../assets/css/style.css"
    >

</head>

<body class="admin-body">


<!-- ==========================================
     SIDEBAR ADMIN
========================================== -->

<aside class="admin-sidebar">

    <!-- BRAND -->

    <div class="admin-brand">

        <i class="bi bi-stars"></i>

        <span>
            Event<br>
            Entertaiment
        </span>

    </div>


    <!-- MENU -->

    <div class="admin-menu">

        <!-- DASHBOARD -->

        <a
            href="../admin/index.php"
            class="admin-menu-item"
        >
            <i class="bi bi-grid-1x2-fill"></i>
            Dashboard
        </a>


        <!-- PAKET -->

        <a
            href="index.php"
            class="admin-menu-item active"
        >
            <i class="bi bi-box-seam"></i>
            Kelola Paket
        </a>


        <!-- EVENT -->

        <a
            href="#"
            class="admin-menu-item disabled"
            onclick="return false;"
        >
            <i class="bi bi-calendar-event"></i>
            Kelola Event
        </a>


        <!-- KLIEN -->

        <a
            href="#"
            class="admin-menu-item disabled"
            onclick="return false;"
        >
            <i class="bi bi-people"></i>
            Kelola Klien
        </a>


        <!-- VENDOR -->

        <a
            href="#"
            class="admin-menu-item disabled"
            onclick="return false;"
        >
            <i class="bi bi-shop"></i>
            Kelola Vendor
        </a>


        <!-- LAPORAN -->

        <a
            href="#"
            class="admin-menu-item disabled"
            onclick="return false;"
        >
            <i class="bi bi-bar-chart"></i>
            Laporan
        </a>

    </div>


    <!-- KEMBALI KE USER -->

    <div class="admin-sidebar-bottom">

        <a
            href="../index.php"
            class="admin-menu-item"
        >
            <i class="bi bi-box-arrow-left"></i>
            Kembali ke User
        </a>

    </div>

</aside>

<main class="admin-main">
    <div class="admin-topbar">
        <div>
            <h1>
                Kelola Paket
            </h1>

            <p>
                Kelola paket event yang tersedia
                di Event Entertaiment.
            </p>
        </div>

        <div class="admin-profile">
            <i class="bi bi-person-circle"></i>
            <span>
                Admin
            </span>
        </div>
    </div>

    <!-- ===================
         DATA PAKET
    ========================== -->

    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h3>
                    <i class="bi bi-box-seam"></i>
                    Data Paket
                </h3>
                <p>
                    Tambah, lihat, edit, atau hapus
                    paket event.
                </p>
            </div>

            <a
                href="tambah.php"
                class="admin-button"
            >

                <i class="bi bi-plus-circle"></i>
                Tambah Paket
            </a>
        </div>

        <!-- =============
             TABEL
        =================== -->

        <div class="table-responsive">
            <table class="table admin-table align-middle">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>

                        <th>
                            Nama Paket
                        </th>

                        <th>
                            Harga
                        </th>

                        <th>
                            Fasilitas
                        </th>

                        <th>
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>

<?php

$no = 1;
if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
?>
    <tr>
        <!-- NO -->
        <td>
            <?= $no++; ?>
        </td>

        <!-- NAMA PAKET -->
        <td>
            <strong>
                <?= htmlspecialchars(
                    $data['nama_paket']
                ); ?>
            </strong>
        </td>

        <td>
            Rp
            <?= number_format(
                $data['harga'],
                0,
                ',',
                '.'
            ); ?>
        </td>

        <td>
            <?php
            $fasilitas = preg_split(
                '/\r\n|\r|\n/',
                $data['deskripsi']
            );

            foreach ($fasilitas as $item) {
                $item = trim($item);
                if ($item == '') {
                    continue;
                }
            ?>
                <div class="admin-fasilitas">
                    <i class="bi bi-check-circle-fill"></i>
                    <?= htmlspecialchars($item); ?>
                </div>
            <?php
            }
            ?>
        </td>

        <td>
            <div class="d-flex gap-1 flex-nowrap">
                <a
                    href="detail.php?id=<?= $data['id_paket']; ?>"
                    class="btn btn-sm btn-outline-info"
                    title="Lihat Detail"
                >
                    <i class="bi bi-eye"></i>
                </a>

                <a
                    href="edit.php?id=<?= $data['id_paket']; ?>"
                    class="btn btn-sm btn-outline-warning"
                    title="Edit Paket"
                >
                    <i class="bi bi-pencil"></i>
                </a>

                <a
                    href="hapus.php?id=<?= $data['id_paket']; ?>"
                    class="btn btn-sm btn-outline-danger"
                    title="Hapus Paket"
                    onclick="return confirm('Yakin ingin menghapus paket ini?');"
                >
                    <i class="bi bi-trash"></i>
                </a>
            </div>
        </td>
    </tr>

<?php
    } 
} else {

?>
    <!-- JIKA DATA KOSONG -->
    <tr>
        <td
            colspan="5"
            class="text-center py-5"
        >
            <i
                class="bi bi-inbox"
                style="font-size: 45px;"
            ></i>

            <p class="mt-3 mb-0">
                Belum ada data paket
            </p>
        </td>
    </tr>
<?php
} // tutup if
?>
</tbody>