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
    <title>ADMINISTRATOR</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
        <a class="navbar-brand" href="#">SELAMAT DATANG ADMIN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" datatarget="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline my-2 my-lg-0 ml-auto">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <div class="icon ml-4">
                <h5>
                    <i class="fas fa-envelope-square mr-3"></i>
                    <i class="fas fa-bell-slash mr-3"></i>
                    <i class="fas fa-sign-out-alt mr-3"></i>
                </h5>
            </div>
        </div>
    </nav>
    <div class="row no-gutters mt-5">
        <div class="col-md-2 bg-dark mt-2 pr-3 pt-4">
            <ul class="nav flex-column ml-3 mb-5">
                <li class="nav-item">
                    <a class="nav-link active text-white" href=""><i
                            class="fas fa-tachometer-alt mr2"></i>Dashboard</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href=""><i class="fas fa-user-graduate mr-2"></i>Daftar
                        Dosen</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href=""><i class="fas fa-users mr-2"></i>Daftar Pegawai</a>
                    <hr class="bg-secondary">
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href=""><i class="far fa-calendar-alt mr-2"></i>Jadwal Kuliah</a>
                    <hr class="bg-secondary">
                </li>
            </ul>
        </div>
        <div class="col-md-10 p-5 pt-2">
            <h3><i class="fas fa-user-graduate mr-2"></i> Input Data Baru</h3>
            <hr>
            <form action="simpan_jadwal.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>KODE JADWAL</label>
                        <input type="text" name="kode_jadwal" class="form-control" id="kode_jadwal">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>HARI</label>
                        <input type="text" name="hari" class="form-control" id="hari">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>JAM</label>
                        <input type="text" name="jam" class="form-control" id="jam">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>MAKUL</label>
                        <input type="text" name="makul" class="form-control" id="makul">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>DOSEN</label>
                        <input type="text" name="dosen" class="form-control" id="dosen">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>RUANG</label>
                        <input type="text" name="ruang" class="form-control" id="ruang">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </form>
        </div>
    </div>
</body>

</html>