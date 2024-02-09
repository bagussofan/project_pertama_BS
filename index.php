<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <!-- Bootstrap CSS and JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title></title>
</head>

<body>
<p>Welcome, <?php echo $_SESSION["username"]; ?>!</p>
    <a href="logout.php">Logout</a>

<h2>DATA MAHASISWA</h2>
        <a href="tambah_mhs.php" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahmhs">
        <i class="fa fa-plus-cicle mr-2"></i>TAMBAH DATA MAHASISWA</a>
        
        <table class="table table-bordered table-hover"> 
        <thead> 
            <tr> 
                <th scope="col">NO</th> 
                <th scope="col">NIM</th> 
                <th scope="col">NAMA MAHASISWA</th> 
                <th scope="col">ALAMAT</th> 
                <th scope="col">JURUSAN</th> 
                <th colspan="3" scope="col">AKSI</th> 
            </tr> 
        </thead> 
        <tbody> 
            
            <?php include "koneksi.php"; 
            
            $sql = "SELECT * FROM mahasiswa"; 
            
            $query = mysqli_query($koneksi, $sql); 
            
            if (mysqli_num_rows($query) < 1) : ?> 
                <tr> 
                    <td colspan="100%">Tidak ada data yang ditemukan !</td> 
                </tr>                
            <?php                
            endif; 
            foreach ($query as $key => $value) : 
            ?> 

                <tr> 
                    <td><?= $key + 1 ?></td> 
                    <td><?= htmlspecialchars( $value['nim'] ) ?></td> 
                    <td><?= htmlspecialchars( $value['nama'] ) ?></td> 
                    <td><?= htmlspecialchars( $value['alamat'] ) ?></td> 
                    <td><?= htmlspecialchars( $value['jurusan'] ) ?></td> 
                    <td> 
                        <a href="ubah_mhs.php?nim=<?= htmlspecialchars( $value['nim'] ) ?>"                       
                            class="btn btn-warning btn-sm p-2 text-white rounded"> 
                            <i class="fas fa-edit mr-2"></i> Edit</a>

                        <a href="hapus_mhs.php?nim=<?= htmlspecialchars( $value['nim'] ) ?>"                         
                            onclick="return confirm('Apakah Anda yakin ingin menghapus ?')"                          
                            class="btn btn-danger btn-sm p-2 text-white rounded">                        
                            <i class="fas fa-trash-alt mr-2"></i> Hapus</a> 
                    </td> 
                </tr> 

                <?php endforeach; ?> 

        </tbody> 
        </table> 

            <!-- simpan modal -->
            <div class="example-modal">
                <div id="tambahmhs" class="modal fade" role="dialog" style="display:none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Tambah Data Baru</h3>
                            </div>
                            <div class="modal-body">
                                <form action="simpan_mhs.php" method="post" role="form">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">NIM</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="nim"
                                                    placeholder="NIM" value=""></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">Nama Mahasiswa</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="nama"
                                                    placeholder="Nama Mahasiswa" value=""></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">Alamat</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="alamat"
                                                    placeholder="Alamat" id="alamat" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">Jurusan </label>
                                            <div class="col-sm-8"><input type="text" name="jurusan" class="form-control"
                                                    placeholder="Jurusan">
                                                </input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="nosave" type="button" class="btn btn-danger pull-left"
                                            data-dismiss="modal">Batal</button>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Update Modal -->
            
            <div class="example-modal">
            <div id="editmhs<?php echo $data['nim']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Data Mahasiswa</h3>
                            </div>
                            <div class="modal-body">
                                <form action="update_mhs.php" method="post" role="form">
                                    <?php
                                    $nim = $data['nim'];
                                    $query1 = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");
                                    while ($data1 = mysqli_fetch_assoc($query1)) {
                                        ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">NIM </label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="nim" value="<?php echo
                                                    $data1['nim']; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">Nama Mahasiswa</label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="nama" value="<?php echo
                                                    $data1['nama']; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">Alamat </label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="alamat"
                                                        value="<?php echo
                                                            $data1['alamat']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">Jurusan </label>
                                                <div class="col-sm-8"><input type="text" name="jurusan" class="form-control"
                                                        value="<?php echo
                                                            $data1['jurusan']; ?>">
                                                    </input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="noedit" type="button" class="btn btn-danger pull-left"
                                                data-dismiss="modal">Batal</button>
                                            <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal delete -->
        
            <div class="example-modal">
            <div id="deletemhs<?php echo $data['nim']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Konfirmasi Hapus Data</h3>
                            </div>
                            <div class="modal-body">
                                <h5 align="center">Apakah anda yakin ingin menghapus NIM
                                    <?php echo
                                        $data['nim']; ?><strong><span class="grt"></span></strong> ?
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left"
                                    data-dismiss="modal">Cancle</button>
                                <a href="hapus_mhs.php?nim=<?php echo $data['nim']; ?>" class="btn btn-primary">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        
        ?>     
        </table>
        <script src="js/bootstrap.min.js"></script>

    <h2> DATA DOSEN</h2>
    <a href="tambah_dosen.php" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahdosen">
        <i class="fa fa-plus-cicle mr-2"></i>TAMBAH DATA DOSEN </a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">NIDN</th>
                <th scope="col">NAMA DOSEN</th>
                <th scope="col">ALAMAT</th>
                <th scope="col">JABATAN</th>
                <th colspan="3" scope="col">AKSI</th>
            </tr>
        </thead>
        <?php

        include 'koneksi.php';

        $query = mysqli_query($koneksi, "SELECT * FROM dosen");
        $no = 1;
        while ($data = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td>
                    <?php echo $no++; ?>
                </td>
                <td>
                    <?php echo $data['nidn']; ?>
                </td>
                <td>
                    <?php echo $data['nama']; ?>
                </td>
                <td>
                    <?php echo $data['alamat']; ?>
                </td>
                <td>
                    <?php echo $data['jabatan']; ?>
                </td>
                <td>
                    <i class="fa fa-edit bg-success p-2 text-white rounded"></i>
                    <a href="#" data-toggle="modal" data-target="#editdosen<?php echo $data['nidn']; ?>">Edit</a>|
                    <i class="fa fa-trash-alt bg-danger p-2 text-white rounded"></i>
                    <a href="#" data-toggle="modal" data-target="#deletedosen<?php echo $data['nidn']; ?>">Delete</a>|

                </td>
            </tr>
            <!-- simpan modal -->
            <div class="example-modal">
                <div id="tambahdosen" class="modal fade" role="dialog" style="display:none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Tambah Data Baru</h3>
                            </div>
                            <div class="modal-body">
                                <form action="simpan_dosen.php" method="post" role="form">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">NIDN</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="nidn"
                                                    placeholder="NIDN" value=""></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">Nama Dosen</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="nama"
                                                    placeholder="Nama Dosen" value=""></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">Alamat</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="alamat"
                                                    placeholder="Alamat" id="alamat" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">Jabatan </label>
                                            <div class="col-sm-8"><input type="text" name="jabatan" class="form-control"
                                                    placeholder="Jabatan">
                                                </input>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button id="nosave" type="button" class="btn btn-danger pull-left"
                                            data-dismiss="modal">Batal</button>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Update Modal -->

            <div class="example-modal">
                <div id="editdosen<?php echo $data['nidn']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Data Dosen</h3>
                            </div>
                            <div class="modal-body">
                                <form action="update_dosen.php" method="post" role="form">
                                    <?php
                                    $nidn = $data['nidn'];
                                    $query1 = mysqli_query($koneksi, "SELECT * FROM dosen WHERE nidn='$nidn'");
                                    while ($data1 = mysqli_fetch_assoc($query1)) {
                                        ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">NIDN </label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="nidn" value="<?php echo
                                                    $data1['nidn']; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">Nama Dosen</label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="nama" value="<?php echo
                                                    $data1['nama']; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">Alamat </label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="alamat"
                                                        value="<?php echo
                                                            $data1['alamat']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">Jabatan </label>
                                                <div class="col-sm-8"><input type="text" name="jabatan" class="form-control"
                                                        value="<?php echo
                                                            $data1['jabatan']; ?>">
                                                    </input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="noedit" type="button" class="btn btn-danger pull-left"
                                                data-dismiss="modal">Batal</button>
                                            <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal delete -->

            <div class="example-modal">
                <div id="deletedosen<?php echo $data['nidn']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Konfirmasi Hapus Data</h3>
                            </div>
                            <div class="modal-body">
                                <h5 align="center">Apakah anda yakin ingin menghapus NIDN
                                    <?php echo
                                        $data['nidn']; ?><strong><span class="grt"></span></strong> ?
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left"
                                    data-dismiss="modal">Cancle</button>
                                <a href="hapus_dosen.php?nidn=<?php echo $data['nidn']; ?>"
                                    class="btn btn-primary">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </table>
    <script src="js/bootstrap.min.js"></script>


    <!-- pegawai -->
    <h2> DATA PEGAWAI</h2>
    <a href="tambah_pegawai.php" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahpegawai">
        <i class="fa fa-plus-cicle mr-2"></i>TAMBAH DATA PEGAWAI </a>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">NIK</th>
                <th scope="col">NAMA PEGAWAI</th>
                <th scope="col">BAGIAN</th>
                <th colspan="3" scope="col">AKSI</th>
            </tr>
        </thead>
        <?php

        include 'koneksi.php';

        $query = mysqli_query($koneksi, "SELECT * FROM pegawai");
        $no = 1;
        while ($data = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td>
                    <?php echo $no++; ?>
                </td>
                <td>
                    <?php echo $data['nik']; ?>
                </td>
                <td>
                    <?php echo $data['nama']; ?>
                </td>
                <td>
                    <?php echo $data['bagian']; ?>
                </td>

                <td>
                    <i class="fa fa-edit bg-success p-2 text-white rounded"></i>
                    <a href="#" data-toggle="modal" data-target="#editpegawai<?php echo $data['nik']; ?>">Edit</a>|
                    <i class="fa fa-trash-alt bg-danger p-2 text-white rounded"></i>
                    <a href="#" data-toggle="modal" data-target="#deletepegawai<?php echo $data['nik']; ?>">Delete</a>|

                </td>
            </tr>
            <!-- simpan modal -->
            <div class="example-modal">
                <div id="tambahpegawai" class="modal fade" role="dialog" style="display:none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Tambah Data Baru</h3>
                            </div>
                            <div class="modal-body">
                                <form action="simpan_pegawai.php" method="post" role="form">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">NIK</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="nik"
                                                    placeholder="NIK" value=""></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">Nama Pegawai</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="nama"
                                                    placeholder="Nama Pegawai" value=""></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-3 control-label text-right">Bagian</label>
                                            <div class="col-sm-8"><input type="text" class="form-control" name="bagian"
                                                    placeholder="Bagian" id="bagian" value="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button id="nosave" type="button" class="btn btn-danger pull-left"
                                            data-dismiss="modal">Batal</button>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Update Modal -->

            <div class="example-modal">
                <div id="editpegawai<?php echo $data['nik']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Edit Data Pegawai</h3>
                            </div>
                            <div class="modal-body">
                                <form action="update_pegawai.php" method="post" role="form">
                                    <?php
                                    $nik = $data['nik'];
                                    $query1 = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE nik='$nik'");
                                    while ($data1 = mysqli_fetch_assoc($query1)) {
                                        ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">NIK </label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="nik" value="<?php echo
                                                    $data1['nik']; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">Nama Pegawai</label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="nama" value="<?php echo
                                                    $data1['nama']; ?>"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">Bagian </label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="bagian"
                                                        value="<?php echo
                                                            $data1['bagian']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button id="noedit" type="button" class="btn btn-danger pull-left"
                                                data-dismiss="modal">Batal</button>
                                            <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal delete -->

            <div class="example-modal">
                <div id="deletepegawai<?php echo $data['nik']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Konfirmasi Hapus Data</h3>
                            </div>
                            <div class="modal-body">
                                <h5 align="center">Apakah anda yakin ingin menghapus NIK
                                    <?php echo
                                        $data['nik']; ?><strong><span class="grt"></span></strong> ?
                                </h5>
                            </div>
                            <div class="modal-footer">
                                <button id="nodelete" type="button" class="btn btn-danger pull-left"
                                    data-dismiss="modal">Cancle</button>
                                <a href="hapus_pegawai.php?nik=<?php echo $data['nik']; ?>"
                                    class="btn btn-primary">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
</table>
    <script src="js/bootstrap.min.js"></script>









        <!-- jadwal kuliah -->

        <h2> DATA JADWAL</h2>
        <a href="tambah_jadwal.php" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahjadwal">
            <i class="fa fa-plus-cicle mr-2"></i>TAMBAH DATA JADWAL </a>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">KODE JADWAL</th>
                    <th scope="col">HARI</th>
                    <th scope="col">JAM</th>
                    <th scope="col">MAKUL</th>
                    <th scope="col">DOSEN</th>
                    <th scope="col">RUANG</th>
                    <th colspan="3" scope="col">AKSI</th>
                </tr>
            </thead>
            <?php

            include 'koneksi.php';

            $query = mysqli_query($koneksi, "SELECT * FROM jadwal");
            $no = 1;
            while ($data = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td>
                        <?php echo $no++; ?>
                    </td>
                    <td>
                        <?php echo $data['kode_jadwal']; ?>
                    </td>
                    <td>
                        <?php echo $data['hari']; ?>
                    </td>
                    <td>
                        <?php echo $data['jam']; ?>
                    </td>
                    <td>
                        <?php echo $data['makul']; ?>
                    </td>
                    <td>
                        <?php echo $data['dosen']; ?>
                    </td>
                    <td>
                        <?php echo $data['ruang']; ?>
                    </td>
                    <td>
                        <i class="fa fa-edit bg-success p-2 text-white rounded"></i>
                        <a href="#" data-toggle="modal"
                            data-target="#editjadwal<?php echo $data['kode_jadwal']; ?>">Edit</a>|
                        <i class="fa fa-trash-alt bg-danger p-2 text-white rounded"></i>
                        <a href="#" data-toggle="modal"
                            data-target="#deletejadwal<?php echo $data['kode_jadwal']; ?>">Delete</a>|

                    </td>
                </tr>
                <!-- simpan modal -->
                <div class="example-modal">
                    <div id="tambahjadwal" class="modal fade" role="dialog" style="display:none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Tambah Data Baru</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="simpan_jadwal.php" method="post" role="form">
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">KODE JADWAL</label>
                                                <div class="col-sm-8"><input type="text" class="form-control"
                                                        name="kode_jadwal" placeholder="KODE JADWAL" value=""></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">HARI</label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="hari"
                                                        placeholder="Hari" value=""></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">JAM</label>
                                                <div class="col-sm-8"><input type="text" class="form-control" name="jam"
                                                        placeholder="Jam" id="jam" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">MAKUL </label>
                                                <div class="col-sm-8"><input type="text" name="makul" class="form-control"
                                                        placeholder="Makul">
                                                    </input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">DOSEN </label>
                                                <div class="col-sm-8"><input type="text" name="dosen" class="form-control"
                                                        placeholder="Dosen">
                                                    </input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="col-sm-3 control-label text-right">RUANG </label>
                                                <div class="col-sm-8"><input type="text" name="ruang" class="form-control"
                                                        placeholder="Ruang">
                                                    </input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button id="nosave" type="button" class="btn btn-danger pull-left"
                                                data-dismiss="modal">Batal</button>
                                            <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update Modal -->

                <div class="example-modal">
                    <div id="editjadwal<?php echo $data['kode_jadwal']; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Edit Data Jadwal</h3>
                                </div>
                                <div class="modal-body">
                                    <form action="update_jadwal.php" method="post" role="form">
                                        <?php
                                        $kode_jadwal = $data['kode_jadwal'];
                                        $query1 = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE kode_jadwal='$kode_jadwal'");
                                        while ($data1 = mysqli_fetch_assoc($query1)) {
                                            ?>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Kode Jadwal </label>
                                                    <div class="col-sm-8"><input type="text" class="form-control"
                                                            name="kode_jadwal" value="<?php echo
                                                                $data1['kode_jadwal']; ?>"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Hari</label>
                                                    <div class="col-sm-8"><input type="text" class="form-control" name="hari"
                                                            value="<?php echo
                                                                $data1['hari']; ?>"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Jam </label>
                                                    <div class="col-sm-8"><input type="text" class="form-control" name="jam"
                                                            value="<?php echo
                                                                $data1['jam']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-3 control-label text-right">Makul </label>
                                                    <div class="col-sm-8"><input type="text" name="makul" class="form-control"
                                                            value="<?php echo
                                                                $data1['makul']; ?>">
                                                        </input>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="noedit" type="button" class="btn btn-danger pull-left"
                                                    data-dismiss="modal">Batal</button>
                                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal delete -->

                <div class="example-modal">
                    <div id="deletejadwal<?php echo $data['kode_jadwal']; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">Konfirmasi Hapus Data</h3>
                                </div>
                                <div class="modal-body">
                                    <h5 align="center">Apakah anda yakin ingin menghapus KODE JADWAL
                                        <?php echo
                                            $data['kode_jadwal']; ?><strong><span class="grt"></span></strong> ?
                                    </h5>
                                </div>
                                <div class="modal-footer">
                                    <button id="nodelete" type="button" class="btn btn-danger pull-left"
                                        data-dismiss="modal">Cancle</button>
                                    <a href="hapus_jadwal.php?kode_jadwal=<?php echo $data['kode_jadwal']; ?>"
                                        class="btn btn-primary">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </table>
        <script src="js/bootstrap.min.js"></script>
</body>
</html>