<?php
require "connection/conn.php";

$id_jadwal = $_GET['id_jadwal'];
// var_dump($id_jadwal);
// die;
$query = "SELECT * FROM jadwal WHERE id_jadwal='$id_jadwal' ";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo mysqli_error($conn);
}

$data = mysqli_fetch_assoc($result);

// var_dump($data);
// die;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Jadwal </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"
        type="text/css" />
    <!-- Google fonts-->

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-light sticky-top position-absolute" style="background-color: #00B066; width: 100%;">
        <div class="container d-flex ">
            <h2><a class="navbar-brand text-white" href="#!">Kabupaten Blora</a></h2>
            <div class="d-flex">
                <ul class="navbar-nav d-flex flex-row gap-5">
                    <li class="nav-item bg-success px-3 rounded-2 border border-light border-2"><a href="index.php"
                            class="nav-link text-white">Kembali</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Table -->
    <section class="ms-5 me-5" style="margin-top: 100px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-2 mt-2 text-gray-800 font-weight-bold text-center">Detail Jadwal</h2>
                    <hr>
                    <form>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Id Jadwal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_jadwal" name="id_jadwal" required
                                    value="<?= $data['id_jadwal'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Ruangan</label>
                            <div class="col-sm-10">
                                <?php
                                $queryRuangan = "SELECT * FROM ruangan WHERE id_ruangan = '{$data['ruangan']}'";
                                $resultRuangan = mysqli_query($conn, $queryRuangan);
                                $dataRuangan = mysqli_fetch_array($resultRuangan);
                                ?>
                                <input type="text" class="form-control" id="ruangan" name="ruangan" required
                                    value="<?= $dataRuangan['nama'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required
                                    value="<?= $data['tanggal'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Hari</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="hari" name="hari" required
                                    placeholder="ex: Senin-Jumat" value="<?= $data['hari'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Jam Mulai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jam_mulai" name="jam_mulai" required
                                    value="<?= $data['jam_mulai'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Jam Selesai</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jam_selesai" name="jam_selesai" required
                                    value="<?= $data['jam_selesai'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Acara</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="acara" name="acara" required
                                    value="<?= $data['acara'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10"><textarea id="keterangan" name="keterangan" id="keterangan" required
                                    readonly><?= $data['keterangan'] ?></textarea>
                            </div>
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#keterangan'))
                                    .then(editor => {
                                        editor.enableReadOnlyMode('keterangan');
                                        editor.isReadOnly;
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            </script>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Penanggung Jawab</label>
                            <div class="col-sm-10">
                                <?php
                                $queryPJ = "SELECT * FROM user WHERE nip = '{$data['penanggung_jawab']}'";
                                $resultPJ = mysqli_query($conn, $queryPJ);
                                $dataPJ = mysqli_fetch_array($resultPJ);
                                ?>
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                                    required value="<?= $dataPJ['dinas'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Dinas Peminjam</label>
                            <div class="col-sm-10">
                                <?php
                                $queryPeminjam = "SELECT * FROM user WHERE nip = '{$data['dinas_peminjam']}'";
                                $resultPeminjam = mysqli_query($conn, $queryPeminjam);
                                $dataPeminjam = mysqli_fetch_array($resultPeminjam);
                                ?>
                                <input type="text" class="form-control" id="dinas_peminjam" name="dinas_peminjam"
                                    required value="<?= $dataPeminjam['dinas'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="telepon" name="telepon" required
                                    value="<?= $data['telepon'] ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer text-white" id="footer" style="background: #00B066;">
        <div class="container">
            <div class="row d-flex flex-column justify-content-center align-items-center text-center gap-3">
                <h2>Kontak</h2>
                <img src="assets/img/logo kab blora.png" alt="" style="height: 140px; width: 165px;">
                <p class="m-0">Jl. Pemuda No.12, Mlangsen, Kec. Blora, Kabupaten Blora, Jawa Tengah 58215</p>
                <a href="" class="nav-link"><img src="./img/wa logo.svg" alt=""> 089123456789 (pesan)</a>
                <a href="" class="nav-link"><img src="./img/email logo.svg" alt=""> dinkominfo.blorakab.go.id</a>
                <div class="border-top pt-3 d-flex justify-content-center gap-4">
                    <a href=""><img src="./img/twt logo.svg" alt="" class="p-1 rounded-circle"
                            style="background-color: #006339A6; width: 30px;"></a>
                    <a href=""><img src="./img/ig logo.svg" alt="" class="p-1 rounded-circle"
                            style="background-color: #006339A6; width: 30px"></a>
                    <a href=""><img src="./img/yt logo.svg" alt="" class="p-1 rounded-circle"
                            style="background-color: #006339A6; width: 30px"></a>
                    <a href=""><img src="./img/fb logo.svg" alt="" style="width: 30px"></a>
                </div>
                <p><small>&copy; Dinas Komunikasi Dan Informatika Kabtupaten Blora </small></p>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="./js/scripts.js"></script>

    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>