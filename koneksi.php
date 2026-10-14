<?php

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