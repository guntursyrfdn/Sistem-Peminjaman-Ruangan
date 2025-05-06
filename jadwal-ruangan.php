<?php
require "connection/conn.php";
$id_ruangan = $_GET['id_ruangan'];
$query = "SELECT * FROM jadwal WHERE ruangan = '$id_ruangan' ORDER BY tanggal DESC, jam_mulai DESC";
$result = mysqli_query($conn, $query);

$query_ruangan = "SELECT * FROM ruangan WHERE id_ruangan = '$id_ruangan'";
$result_ruangan = mysqli_query($conn, $query_ruangan);
$nama_ruangan = mysqli_fetch_array($result_ruangan);

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
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-light sticky-top position-absolute"
        style="background-color: #00B066; z-index: 1; width: 100%;">
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
    <section class="text-center m-5">
        <div class="container-fluid">
            <div class="row">
                <h2 class="my-5">Jadwal Keseluruhan
                    <?php echo $nama_ruangan['nama'] ?>
                </h2>
                <div class="col-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-success">Tabel Jadwal
                                <?php echo $nama_ruangan['nama'] ?>
                            </h6>
                            <a href="login.php" class="btn btn-success">Buat Jadwal</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Jadwal</th>
                                            <th>Ruangan</th>
                                            <th>Tanggal</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Acara</th>
                                            <th>Dinas Peminjam</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $angka = 1; ?>
                                        <?php foreach ($result as $data): ?>
                                            <?php
                                            // Anggap Anda memiliki ID acara pada parameter URL (ganti 'event_id' dengan nama parameter sebenarnya)
                                            $id_jadwal = $data['id_jadwal'];
                                            date_default_timezone_set('Asia/Jakarta');
                                            // Tentukan apakah acara tersebut sedang berlangsung atau sudah selesai (Anda mungkin perlu menyesuaikan kondisi ini)
                                            $now = date("Y-m-d H:i:s"); // Timestamp saat ini
                                            // var_dump($now);
                                            // die;
                                            $queryStatus = "SELECT tanggal, jam_mulai, jam_selesai FROM jadwal WHERE id_jadwal = '$id_jadwal'";
                                            $resultStatus = mysqli_query($conn, $queryStatus);

                                            if ($row = mysqli_fetch_assoc($resultStatus)) {
                                                $tanggal = $row['tanggal'];
                                                $jam_mulai = $row['jam_mulai'];
                                                $jam_selesai = $row['jam_selesai'];

                                                $mulai_acara = $tanggal . " " . $jam_mulai;
                                                $selesai_acara = $tanggal . " " . $jam_selesai;

                                                // var_dump($mulai_acara, $now);
                                                // die;
                                        
                                                if ($now >= $mulai_acara && $now <= $selesai_acara) {
                                                    $update_status_query = "UPDATE jadwal SET status = 'sedang dilaksanakan' WHERE tanggal = '$tanggal' AND jam_mulai = '$jam_mulai' AND jam_selesai = '$jam_selesai'";
                                                    mysqli_query($conn, $update_status_query);
                                                }

                                                // Perbarui status otomatis jika tanggal dan waktu acara telah selesai
                                                if ($now > $selesai_acara) {
                                                    $update_status_query = "UPDATE jadwal SET status = 'sudah dilaksanakan' WHERE tanggal = '$tanggal' AND jam_mulai = '$jam_mulai' AND jam_selesai = '$jam_selesai'";
                                                    mysqli_query($conn, $update_status_query);
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= $angka ?>
                                                </td>
                                                <td>
                                                    <?= $data['id_jadwal'] ?>
                                                </td>
                                                <?php
                                                $queryRuangan = "SELECT nama FROM ruangan WHERE id_ruangan = '$data[ruangan]'";
                                                $resultRuangan = mysqli_query($conn, $queryRuangan);
                                                $dataRuangan = mysqli_fetch_assoc($resultRuangan);
                                                if ($data['ruangan'] == 0) {
                                                    $ruangan = "Belum Ada";
                                                } else {
                                                    $ruangan = $dataRuangan['nama'];
                                                }
                                                ?>
                                                <td>
                                                    <?= $ruangan ?>
                                                </td>
                                                <td>
                                                    <?= $data['tanggal'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['jam_mulai'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['jam_selesai'] ?>
                                                </td>
                                                <td>
                                                    <?= $data['acara'] ?>
                                                </td>
                                                <?php
                                                $queryDinas = "SELECT dinas FROM user WHERE nip = '$data[dinas_peminjam]'";
                                                $resultDinas = mysqli_query($conn, $queryDinas);
                                                $dataDinas = mysqli_fetch_assoc($resultDinas);
                                                if ($data['dinas_peminjam'] == 0) {
                                                    $dinas_peminjam = "Belum Ada";
                                                } else {
                                                    $dinas_peminjam = $dataDinas['dinas'];
                                                }
                                                ?>
                                                <td>
                                                    <?= $dinas_peminjam ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($data['status'] == "belum dilaksanakan") {
                                                        ?>
                                                        <span class="badge rounded-pill bg-danger text-white p-2">
                                                            <?= $data['status'] ?>
                                                        </span>
                                                        <?php
                                                    } else if ($data['status'] == "sedang dilaksanakan") {
                                                        ?>
                                                            <span class="badge rounded-pill bg-warning text-white p-2">
                                                            <?= $data['status'] ?>
                                                            </span>
                                                        <?php
                                                    } else if ($data['status'] == "sudah dilaksanakan") {
                                                        ?>
                                                                <span class="badge rounded-pill bg-success text-white p-2">
                                                            <?= $data['status'] ?>
                                                                </span>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="detail-jadwal.php?id_jadwal=<?= $data["id_jadwal"] ?>"
                                                        class="btn btn-success">Detail</a>
                                                </td>
                                            </tr>
                                            <?php $angka++ ?>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
    <!-- Auto Reload -->
    <script>
        setTimeout(function () {
            location.reload();
        }, 120000); // Reload the page every 120,000 milliseconds (120 seconds)
    </script>
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