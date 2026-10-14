<?php
// --- KONFIGURASI KONEKSI MARSYA ---

$host = "localhost";
$username = "root";
$password = "";
$database = "Event_Organizer";

$koneksi = mysqli_connect($host, $username, $password, $database);

if ($koneksi) {
    //echo "Koneksi Berhasil";
    $pilih_db = mysqli_select_db($koneksi, $database);
    if ($pilih_db) {
        //echo "Database Terpilih";
    }
} else {
    echo "Koneksi Gagal";
}   

// --- KONFIGURASI KONEKSI MERRY
/*
$host = "localhost";
$user = "root";
$password = "";
$database = "Event_Organizer";

$koneksi = mysqli_connect($host, $user, $password, $database);

if(!$koneksi){
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>
*/
