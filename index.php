<?php
require "connection/conn.php";

$query_berita = "SELECT * FROM berita ORDER BY id_berita DESC";
$result_berita = mysqli_query($conn, $query_berita);


$query_ruangan = "SELECT * FROM ruangan";
$result_ruangan = mysqli_query($conn, $query_ruangan);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kabupaten Blora</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet"
        type="text/css" />
    <!-- Google fonts-->

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add smooth scrolling to all links
            $("a").on('click', function (event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function () {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });
        });
    </script>
</head>

<body style="scroll-behavior: smooth;">
    <!-- Navigation-->
    <nav class=" navbar navbar-light static-top position-absolute"
        style="background-color: #00B06680; z-index: 1; width: 100%;">
        <div class="container d-flex ">
            <h2><a class="navbar-brand text-white" href="#!">Kabupaten Blora</a></h2>
            <div class="d-flex">
                <ul class="navbar-nav d-flex flex-row gap-5">
                    <li class="nav-item"><a href="index.php" class="nav-link text-white">Beranda</a></li>
                    <li class="nav-item"><a href="#jadwal" class="nav-link text-white">Jadwal</a></li>
                    <li class="nav-item"><a href="#berita" class="nav-link text-white">Berita</a></li>
                    <li class="nav-item"><a href="#footer" class="nav-link text-white">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead" style="max-height: 620px; width: 100%;">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-7">
                    <div class="text-center text-white d-flex flex-column justify-content-center align-items-center"
                        style="gap: 40px; margin-top: -50px;">
                        <!-- Page heading-->
                        <img src="assets/img/logo kab blora.png" alt="" width="220px">
                        <div class="text-center m-0 p-0">
                            <p class="fs-5 m-0 font-weight-bold">Selamat Datang Di</p>
                            <h2 class="fs-2 font-weight-bold">Sistem Penggunaan Ruangan Dinas</h2>
                            <h4>Kabupaten Blora</h4>
                        </div>
                        <!-- Signup form-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Icons Grid-->
    <section class="text-center">
        <div class="container">
            <div class="row">
                <marquee class="p-2" behavior="" direction="left" height="187px" onmouseout="this.start()"
                    onmouseover="this.stop()" scrollamount="5" width="100%">
                    <img src="assets/img/image 1.png" alt="">
                    <img src="assets/img/image 2.png" alt="">
                    <img src="assets/img/image 3.png" alt="">
                    <img src="assets/img/image 5.png" alt="">
                    <img src="assets/img/image 6.png" alt="">
                </marquee>
            </div>
        </div>
    </section>
    <!-- Table -->
    <section class="text-center" style="margin-bottom: 50px; margin-top: 50px" id="jadwal">
        <div class="container-fluid">
            <div class="d-flex flex-column justify-content-center">
                <h2 class="my-5">Jadwal Penggunaan Ruangan Dinas</h2>
                <div class="card-group">
                    <div class="w-25">
                        <div class="card ms-5 shadow pb-2" style="height: 480px;">
                            <h4 class="pt-3">Waktu Pelayanan</h4>
                            <div
                                class="card-body justify-content-center d-flex align-items-center flex-column gap-3 text-white">
                                <div class="col d-flex flex-column align-items-center justify-content-center rounded-4"
                                    style="background-color: #00B066; width: 170px; height: 90px;">
                                    <h6>Senin s.d Kamis</h6>
                                    <p class="m-0">07.00 - 16.30</p>
                                </div>
                                <div class="col d-flex flex-column align-items-center justify-content-center rounded-4"
                                    style="background-color: #00B066; width: 170px; height: 90px;">
                                    <h6>Jumat</h6>
                                    <p class="m-0">08.00 - 16.30</p>
                                </div>
                                <div class="col d-flex flex-column align-items-center justify-content-center rounded-4"
                                    style="background-color: #00B066; width: 170px; height: 90px;">
                                    <h6>Sabtu s.d Minggu</h6>
                                    <p class="m-0">Libur</p>
                                </div>
                                <div class="col d-flex flex-column align-items-center justify-content-center rounded-4"
                                    style="background-color: #00B066; width: 170px; height: 90px;">
                                    <h6>Libur Nasional</h6>
                                    <p class="m-0">Libur</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-75">
                        <div class="card ms-4 me-5 shadow">
                            <h4 class="pt-3">Pilih Ruangan</h4>
                            <div class="card-body">
                                <p class="m-0">Pilih ruangan di bawah ini untuk mengetahui jadwal pelayanan</p>
                                <div
                                    class="row row-cols-auto d-flex justify-content-center align-items-center gap-5 text-white card-body">
                                    <?php foreach ($result_ruangan as $ruangan): ?>
                                        <div class="col d-flex flex-column align-items-center justify-content-center rounded-4"
                                            style="background-color: #00B066; width: 170px; height: 90px;">
                                            <h6 class="m-0">
                                                <a href="jadwal-ruangan.php?id_ruangan=<?= $ruangan["id_ruangan"] ?>"
                                                    class="text-white text-decoration-none">
                                                    <?php echo $ruangan['nama'] ?>
                                                </a>
                                            </h6>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Berita -->
    <section class="text-center" id="berita" style="padding-top:50px">
        <div class="container-fluid">
            <h2 class="ms-5 me-5c:\xampp\htdocs\sb-admin2-refisi\detail-berita.php">Berita</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 m-4">
                <?php foreach ($result_berita as $berita): ?>
                    <div class="col">
                        <div class="card h-100 shadow">
                            <img src="admin/gambar/<?php echo $berita['gambar']; ?>" class="card-img-top" alt="..."
                                style="max-height: 250px;">
                            <div class=" card-body text-start align-middle">
                                <p
                                    style="background-color:  #00B066; padding: 3px 8px 3px 8px; width: fit-content; text-align: center; border-radius: 15px; color: white">
                                    <?php echo $berita['tanggal'] ?>
                                </p>
                                <h5 class="card-title"
                                    style=" display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; -webkit-line-clamp: 2; white-space: normal;">
                                    <?php echo $berita['judul'] ?>
                                </h5>
                                <div class="card-text"
                                    style=" display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; -webkit-line-clamp: 5; white-space: normal;">
                                    <?php echo $berita['isi'] ?>
                                </div>
                            </div>
                            <button class="btn  mx-3 mb-3" style="background-color:  #00B066; width: fit-content;"><a
                                    class="text-decoration-none text-white"
                                    href="detail-berita.php?id_berita=<?php echo $berita['id_berita'] ?>">Baca
                                    selengkapnya</a></button>
                        </div>
                    </div>
                <?php endforeach ?>
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
    <button id="kembaliKeAtasBtn" class="btn btn-secondary" onclick="scrollKeAtas()"
        style="display: none; position: fixed; bottom: 20px; right: 20px;">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script>
        // Show/Hide Back to Top Button
        window.onscroll = function () {
            scrollFunction();
        };

        function scrollFunction() {
            var kembaliKeAtasBtn = document.getElementById("kembaliKeAtasBtn");

            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                kembaliKeAtasBtn.style.display = "block";
            } else {
                kembaliKeAtasBtn.style.display = "none";
            }
        }

        // Scroll to Top
        function scrollKeAtas() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
        }
    </script>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
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