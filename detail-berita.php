<?php
require "connection/conn.php";
$query = "SELECT * FROM berita WHERE id_berita = '$_GET[id_berita]'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
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
            <div class="row media w-100">
                <h2 class="my-5 mt-5 text-center">
                    <?= $data['judul'] ?>
                </h2>
                <div class="d-flex flex-row gap-3 ">
                    <div class="col-6 mt-3" style="height: 850px;">
                        <img src="admin/gambar/<?php echo $data['gambar']; ?>" alt=""
                            style="width: 100%; height: 50%; object-fit: cover; object-position: center">
                    </div>
                    <div class="col-6 text-justify p-0">
                        <p>
                            <?= $data['isi'] ?>
                        </p>
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
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="./js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
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