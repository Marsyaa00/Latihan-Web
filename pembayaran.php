<?php
include 'koneksi.php';

$sql = "SELECT pembayaran.*, event.nama_event, klien.nama_klien 
        FROM pembayaran
        LEFT JOIN event ON pembayaran.id_event = event.id_event
        LEFT JOIN klien ON event.id_klien = klien.id_klien
        ORDER BY pembayaran.id_pembayaran DESC";

$query = mysqli_query($koneksi, $sql);
if (isset($_POST['simpan'])) {
    $id_event = $_POST['id_event'];
    $tanggal_bayar = $_POST['tanggal_bayar'];
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $status_pembayaran = $_POST['status_ppembayaran'];

    $sql = "INSERT INTO pembayaran (id_event, tanggal_bayar, jumlah_bayar, metode_pembayaran, status_pembayaran)
    VALUES ('$id_event', '$tanggal_bayar', '$jumlah_bayar', '$metode_pembayaran', '$status_pembayaran')";

    if (mysqli_query($koneksi, $sql)) {
        header("Location: pembayaran.php");
        exit;
    }else{
        echo "Gagal menyimpan pembayaran: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4 mb-5">
    <div class="d-flex justify-content-between mb-3">
       <a href="index.php" class="btn btn-secondary mb-3">Kembali Ke Dashboard</a>
    </div>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Form Input Pembayaran</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Pilih Event</label>
                        <select name="id_event" class="fprm-select" required>
                            <option value="">--Pilih Event--</option>
                            <?php while ($e = mysqli_fetch_assoc($event_query)) : ?>
                                <option value="<?= $e['id_event']; ?>">
                                    <?= htmlspecialhars($e['nama_event']); ?> - (Klien: <?= htmlspecialhars ($e['nama_klien']); ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Bayar<label>
                        <input type="date" name="tanggal_bayar" class="form-control" value="<?= date('Y-m-d'); ?>" requires>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-select" required>
                            <option value="Transfer Bank">Transfer Bank</option>
                            <option value="Tunai / Cash">Tunai / Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status Pembayaran</label>
                        <select name="status_pembayaran" class="form-select" required>
                            <option value="DP">DP (Uang Muka)</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="pembayaran.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-success">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>