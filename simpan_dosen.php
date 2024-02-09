<?php
include 'koneksi.php';
$nidn = $_POST['nidn'];
$nama = $_POST['nama'];
$alamat= $_POST['alamat'];
$jabatan = $_POST['jabatan'];
$input = mysqli_query($koneksi,"INSERT INTO dosen
VALUES('$nidn','$nama','$alamat','$jabatan')") or die(mysqli_error($koneksi));
if($input){
echo "Data Berhasil Disimpan";
header("location:index.php");
}else{
echo "Gagal Disimpan";
}
?>