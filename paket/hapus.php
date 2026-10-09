<?php
include "../config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$query = "DELETE FROM Paket_Event WHERE id_paket = '$id'";

if (mysqli_query($conn, $query)) {

    echo "<script>
            alert('PAKET BERHASIL DIHAPUS!');
            window.location='index.php';
          </script>";

} else {
    echo "Data gagal untuk dihapus: " . mysqli_error($conn);
}
?>