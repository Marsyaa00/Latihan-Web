<?php
include 'koneksi.php';

$event_query = mysqli_query($koneksi, "SELECT event.id_event, event.nama_event, klien.nama_klien
                                       FROM event
                                       LEFT JOIN klien ON event.id_klien = klien.id_klien
                                       ORDER BY event.id_event DESC");
if (isset($_POST['simpan'])) {
    $id_event = $_POST['id_event'];
    $tanggal_bayar = $_POST['tanggal_bayar'];
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $status_pembayaran = $_POST['status_pembayaran'];

    $sql = "INSERT  INTO pembayaran (id_event, tanggal_bayar, jumlah_bayar, metode_pembayaran, status_pembayaran)
            VALUES ('$id_event', '$tanggal_bayar', '$jumlah_bayar', '$metode_pembayaran', '$status_pembayaran')";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: pembayaran.php");
        exit;
    }else {
        echo "Gagal menyimpan pembayaran: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5" style="max-width: 700px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0 font-weight-bold">Form Input Pembayaran</h5>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="">
                    
                    <!-- Dropdown Pilih Event -->
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Pilih Event</label>
                        <select name="id_event" class="form-select" required>
                            <option value="">-- Pilih Event --</option>
                            <?php while ($e = mysqli_fetch_assoc($event_query)) : ?>
                                <option value="<?= $e['id_event']; ?>">
                                    <?= htmlspecialchars($e['nama_event']); ?> (Klien: <?= htmlspecialchars($e['nama_klien'] ?? 'Tanpa Klien'); ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Tanggal Bayar -->
                    <div class="mb-3">
                        <label class="form-label">Tanggal Bayar</label>
                        <input type="date" name="tanggal_bayar" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>

                    <!-- Jumlah Bayar -->
                    <div class="mb-3">
                        <label class="form-label">Nominal / Jumlah Bayar (Rp)</label>
                        <input type="number" name="jumlah_bayar" class="form-control" placeholder="Masukkan jumlah nominal" required>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-select" required>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="Tunai / Cash">Tunai / Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="mb-3">
                        <label class="form-label">Status Pembayaran</label>
                        <select name="status_pembayaran" class="form-select" required>
                            <option value="DP">DP (Uang Muka)</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="pembayaran.php" class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-primary px-4">Simpan Pembayaran</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>