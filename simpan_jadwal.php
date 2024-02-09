<?php
include 'koneksi.php';
$kode_jadwal= $_POST['kode_jadwal'];
$hari=$_POST['hari'];
$jam=$_POST['jam'];
$makul=$_POST['makul'];
$dosen=$_POST['dosen'];
$ruang=$_POST['ruang'];
$input = mysqli_query($koneksi,"INSERT INTO jadwal
VALUES('$kode_jadwal','$hari','$jam','$makul', '$dosen', '$ruang' )") or die(mysqli_error($koneksi));
if($input){
echo "Data Berhasil Disimpan";
header("location:index.php");
}else{
echo "Gagal Disimpan";
}
?>