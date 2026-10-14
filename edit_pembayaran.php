<?php
include 'koneksi.php';

$id = $_GET['id'];
$query_pembayaran = mysqli_query($koneksi, "SELECT * FROM pembayaran WHERE id_pembayaran '$id'");
$data_pembayaran = mysqli_fetch_assoc($query_pembayaran);

$event_pembayaran = mysqli_query($koneksi, "SELECT event.id_event, event.nama_event, klien.nama_klien FROM event JOIN klien ON event.id_klien = klien.id_klien");

if (isset($_POST['update'])) {
    $id_event = $_POST['id_event'];
    $tanggal_bayar = $_POST['tanggal_bayar'];
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $status_pembayaran = $_POST['status_pembayaran'];

    $sql = "UPDATE pembayaran SET id_event = '$id_event', tanggal_bayar = '$tanggal_bayar', jumlah_bayar = '$jumlah_bayar', metode_pembayaran = '$metode_pembayaran', status_pembayaran = '$status_pembayaran' WHERE id_pembayaran ='$id'";
    
    if (mysqli_query($koneksi, $sql)) {
        header("Location: pembayaran.php");
        exit;
    }else{
         echo "Gagal mengupdate pembayaran: " . mysqli_error($koneksi);
    }
    
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4 mb-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Edit Transaksi Pembayaran</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    
                    <div class="mb-3">
                        <label class="form-label">Pilih Event</label>
                        <select name="id_event" class="form-select" required>
                            <?php while ($e = mysqli_fetch_assoc($event_query)) : ?>
                                <option value="<?= $e['id_event']; ?>" <?= ($e['id_event'] == $data_pembayaran['id_event']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($e['nama_event']); ?> - (Klien: <?= htmlspecialchars($e['nama_klien']); ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Bayar</label>
                        <input type="date" name="tanggal_bayar" value="<?= $data_pembayaran['tanggal_bayar']; ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nominal Bayar (Rp)</label>
                        <input type="number" name="jumlah_bayar" value="<?= $data_pembayaran['jumlah_bayar']; ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" class="form-select" required>
                            <option value="Transfer Bank" <?= ($data_pembayaran['metode_pembayaran'] == 'Transfer Bank') ? 'selected' : ''; ?>>Transfer Bank</option>
                            <option value="Tunai / Cash" <?= ($data_pembayaran['metode_pembayaran'] == 'Tunai / Cash') ? 'selected' : ''; ?>>Tunai / Cash</option>
                            <option value="QRIS" <?= ($data_pembayaran['metode_pembayaran'] == 'QRIS') ? 'selected' : ''; ?>>QRIS</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Pembayaran</label>
                        <select name="status_pembayaran" class="form-select" required>
                            <option value="DP" <?= ($data_pembayaran['status_pembayaran'] == 'DP') ? 'selected' : ''; ?>>DP (Uang Muka)</option>
                            <option value="Lunas" <?= ($data_pembayaran['status_pembayaran'] == 'Lunas') ? 'selected' : ''; ?>>Lunas</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="pembayaran.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update" class="btn btn-warning">Update Transaksi</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>