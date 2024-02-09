<?php
$hostname = "localhost"; // Sesuaikan dengan host database Anda
$username = "root";      // Sesuaikan dengan username database Anda
$password = "";          // Sesuaikan dengan password database Anda
$database = "db_akademik"; // Sesuaikan dengan nama database Anda

$koneksi = mysqli_connect($hostname, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
