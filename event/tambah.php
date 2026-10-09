<?php

include "../config/koneksi.php";

/* =========================
   CEK PAKET
========================= */

if (!isset($_GET['id_paket'])) {
    header("Location: ../paket/daftar.php");
    exit;
}

$id_paket = $_GET['id_paket'];

$query_paket = mysqli_query(
    $conn,
    "SELECT * FROM Paket_Event WHERE id_paket = '$id_paket'"
);

$paket = mysqli_fetch_assoc($query_paket);

if (!$paket) {
    die("Maaf, paket tidak ditemukan.");
}


/* =========================
   PROSES BOOKING
========================= */

if (isset($_POST['simpan'])) {

    // Data customer
    $nama_klien = mysqli_real_escape_string(
        $conn,
        trim($_POST['nama_klien'])
    );

    $no_telepon = trim($_POST['no_telepon']);

    if (!ctype_digit($no_telepon)) {
        die("Nomor telepon hanya boleh berisi angka!");
    }

    $no_telepon = mysqli_real_escape_string(
        $conn,
        $no_telepon
    );

    $email = mysqli_real_escape_string(
        $conn,
        trim($_POST['email'])
    );

    $alamat = mysqli_real_escape_string(
        $conn,
        trim($_POST['alamat'])
    );


    // Data event
    $nama_event = mysqli_real_escape_string(
        $conn,
        trim($_POST['nama_event'])
    );

    $tanggal_event = mysqli_real_escape_string(
        $conn,
        $_POST['tanggal_event']
    );


    // Validasi tanggal
    if ($tanggal_event < date('Y-m-d')) {
        die("Tanggal event tidak boleh kurang dari hari ini!");
    }


    // Lokasi event
    $jenis_lokasi = $_POST['jenis_lokasi'] ?? '';

    if ($jenis_lokasi == 'evofest') {

        $lokasi = mysqli_real_escape_string(
            $conn,
            $_POST['gedung_evofest']
        );

    } elseif ($jenis_lokasi == 'sendiri') {

        $lokasi = mysqli_real_escape_string(
            $conn,
            trim($_POST['lokasi_sendiri'])
        );

    } else {

        die("Silakan pilih lokasi event.");
    }


    // Status awal
    $status = "Proses";


    /* =========================
       SIMPAN CUSTOMER
    ========================= */

    $query_klien = "
        INSERT INTO Klien
        (nama_klien, no_telepon, email, alamat)
        VALUES
        ('$nama_klien', '$no_telepon', '$email', '$alamat')
    ";

    if (mysqli_query($conn, $query_klien)) {

        $id_klien = mysqli_insert_id($conn);


        /* =========================
           SIMPAN EVENT
        ========================= */

        $query_event = "
            INSERT INTO Event
            (
                id_klien,
                id_paket,
                nama_event,
                tanggal_event,
                lokasi,
                status
            )
            VALUES
            (
                '$id_klien',
                '$id_paket',
                '$nama_event',
                '$tanggal_event',
                '$lokasi',
                '$status'
            )
        ";

        if (mysqli_query($conn, $query_event)) {

            echo "<script>
                    alert('Booking paket berhasil!');
                    window.location='../paket/daftar.php';
                  </script>";

        } else {

            echo "Data event gagal disimpan: "
                . mysqli_error($conn);
        }

    } else {

        echo "Data customer gagal disimpan: "
            . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Booking Paket - Event Entertaiment</title>

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

<body>

    <!-- Navbar -->
    <nav class="navbar-evofest">

        <div class="container-evofest">

            <a
                href="../index.php"
                class="brand"
            >
                <i class="bi bi-stars"></i>
                Event Entertaiment
            </a>

        </div>

    </nav>


    <!-- Booking -->
    <main class="booking-page">

        <div class="container-evofest">

            <div class="booking-card">

                <!-- Judul -->
                <div class="booking-title">

                    <div class="detail-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>

                    <h1>Booking Paket</h1>

                    <p>
                        Lengkapi data berikut untuk melakukan pemesanan
                    </p>

                </div>


                <!-- Paket -->
                <div class="selected-package">

                    <p>Paket yang dipilih</p>

                    <h3>
                        <?= htmlspecialchars($paket['nama_paket']); ?>
                    </h3>

                    <strong>
                        Rp
                        <?= number_format(
                            $paket['harga'],
                            0,
                            ',',
                            '.'
                        ); ?>
                    </strong>

                </div>


                <div class="detail-garis"></div>


                <!-- Form -->
                <form
                    method="POST"
                    action="tambah.php?id_paket=<?= $id_paket; ?>"
                    autocomplete="off"
                >

                    <!-- Data Customer -->
                    <h4 class="form-section-title">
                        <i class="bi bi-person"></i>
                        Data Pemesan
                    </h4>


                    <div class="mb-3">

                        <label class="form-label">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="nama_klien"
                            class="form-control"
                            placeholder="Masukkan nama lengkap"
                            maxlength="50"
                            autocomplete="off"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            No. Telepon
                        </label>

                        <input
                            type="tel"
                            name="no_telepon"
                            class="form-control"
                            placeholder="Contoh: 081234567890"
                            maxlength="20"
                            autocomplete="off"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Contoh: nama@email.com"
                            maxlength="100"
                            autocomplete="off"
                            required
                        >

                    </div>


                    <div class="mb-4">

                        <label class="form-label">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan alamat"
                            autocomplete="off"
                            required
                        ></textarea>

                    </div>


                    <!-- Data Event -->
                    <h4 class="form-section-title">

                        <i class="bi bi-calendar-event"></i>
                        Data Event

                    </h4>


                    <div class="mb-3">

                        <label class="form-label">
                            Nama Event
                        </label>

                        <input
                            type="text"
                            name="nama_event"
                            class="form-control"
                            placeholder="Contoh: Konser Musik Sekolah"
                            maxlength="100"
                            autocomplete="off"
                            required
                        >

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Tanggal Event
                        </label>

                        <input
                            type="date"
                            name="tanggal_event"
                            class="form-control"
                            min="<?= date('Y-m-d'); ?>"
                            required
                        >

                    </div>


                    <!-- Lokasi -->
                    <div class="mb-4">

                        <label class="form-label">
                            Lokasi Event
                        </label>


                        <div class="location-option">

                            <div class="location-choice">

                                <input
                                    type="radio"
                                    name="jenis_lokasi"
                                    id="lokasi_evofest"
                                    value="evofest"
                                    onchange="pilihLokasi()"
                                    required
                                >

                                <label for="lokasi_evofest">

                                    <i class="bi bi-building"></i>

                                    Gedung yang disediakan Event Entertaiment

                                </label>

                            </div>


                            <div class="location-choice">

                                <input
                                    type="radio"
                                    name="jenis_lokasi"
                                    id="lokasi_sendiri"
                                    value="sendiri"
                                    onchange="pilihLokasi()"
                                >

                                <label for="lokasi_sendiri">

                                    <i class="bi bi-geo-alt"></i>

                                    Tempat pilihan sendiri

                                </label>

                            </div>

                        </div>


                        <!-- Pilihan Gedung -->
                        <div
                            id="pilihanGedung"
                            class="mt-3"
                            style="display: none;"
                        >

                            <label class="form-label">
                                Pilih Gedung
                            </label>

                            <select
                                name="gedung_evofest"
                                id="gedung_evofest"
                                class="form-control"
                            >

                                <option value="">
                                    -- Pilih Gedung --
                                </option>

                                <option value="Gedung Serbaguna Event Entertaiment">
                                    Gedung Serbaguna Event Entertaiment
                                </option>

                                <option value="Ballroom Event Entertaiment">
                                    Ballroom Event Entertaiment
                                </option>

                                <option value="Hall Festival Event Entertaiment">
                                    Hall Festival Event Entertaiment
                                </option>

                            </select>

                        </div>


                        <!-- Lokasi Sendiri -->
                        <div
                            id="lokasiSendiri"
                            class="mt-3"
                            style="display: none;"
                        >

                            <label class="form-label">
                                Masukkan Lokasi yang Diinginkan
                            </label>

                            <input
                                type="text"
                                name="lokasi_sendiri"
                                id="lokasi_sendiri_input"
                                class="form-control"
                                placeholder="Contoh: Gedung sekolah, hotel, rumah, lapangan, dll."
                                maxlength="100"
                                autocomplete="off"
                            >

                        </div>

                    </div>


                    <!-- Tombol -->
                    <div class="detail-button-group">

                        <a
                            href="../paket/daftar.php"
                            class="btn-detail-kembali"
                        >
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>


                        <button
                            type="submit"
                            name="simpan"
                            class="btn-detail-beli"
                        >
                            <i class="bi bi-check-circle"></i>
                            Konfirmasi Booking
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>


    <script>

        function pilihLokasi() {

            const evofest =
                document.getElementById("lokasi_evofest");

            const sendiri =
                document.getElementById("lokasi_sendiri");

            const pilihanGedung =
                document.getElementById("pilihanGedung");

            const lokasiSendiri =
                document.getElementById("lokasiSendiri");

            const gedung =
                document.getElementById("gedung_evofest");

            const lokasiInput =
                document.getElementById("lokasi_sendiri_input");


            if (evofest.checked) {

                pilihanGedung.style.display = "block";
                lokasiSendiri.style.display = "none";

                gedung.required = true;
                lokasiInput.required = false;

                lokasiInput.value = "";

            } else if (sendiri.checked) {

                pilihanGedung.style.display = "none";
                lokasiSendiri.style.display = "block";
                gedung.required = false;
                lokasiInput.required = true;
                gedung.value = "";
            }
        }
    </script>
</body>
</html>