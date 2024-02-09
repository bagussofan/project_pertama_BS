<?php
// include database connection file
include 'koneksi.php';
$kode_jadwal= $_POST['kode_jadwal'];
$hari=$_POST['hari'];
$jam=$_POST['jam'];
$makul=$_POST['makul'];
$dosen=$_POST['dosen'];
$ruang=$_POST['ruang'];
$result = mysqli_query($koneksi, "UPDATE jadwal SET
hari='$hari',jam='$jam',makul='$makul', dosen='$dosen', ruang='$ruang' WHERE kode_jadwal='$kode_jadwal'");
// Redirect to homepage to display updated user in list
header("Location: index.php");
?>
