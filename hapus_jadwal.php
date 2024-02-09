<?php
// include database connection file
include 'koneksi.php';
$kode_jadwal = $_GET['kode_jadwal'];
$result = mysqli_query($koneksi, "DELETE FROM jadwal WHERE kode_jadwal='$kode_jadwal'");
header("Location:index.php");
?>