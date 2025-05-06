<?php
require "./layout/top.php";
require "../connection/conn.php";

$id_berita = $_GET['id_berita'];
// var_dump($id_berita);
// die;
$query = "SELECT * FROM berita WHERE id_berita='$id_berita' ";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mb-2 text-gray-800 font-weight-bold">Ubah Berita</h1>
        <hr>
        <form action="update-berita.php" method="post" enctype="multipart/form-data">
            <div class="mb-3 form-group row">
                <label for="id_berita" class="col-sm-2 col-form-label">Id Berita</label>
                <input type="text" class="form-control col-sm-10" id="id_berita" name="id_berita" required
                    value="<?= $data['id_berita'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="gambar" class="col-sm-2 col-form-label">Gambar Berita</label>
                <input type="file" class="form-control col-sm-10" id="gambar" name="gambar" placeholder="Judul Berita">
            </div>
            <div class="mb-3 form-group row d-none">
                <label for="gambar_old" class="col-sm-2 col-form-label">Gambar Lama</label>
                <input type="text" class="form-control col-sm-10" id="gambar_old" name="gambar_old"
                    value="<?= $data['gambar'] ?>">
            </div>
            <div class="mb-3 form-group row">
                <label for="judul" class="col-sm-2 col-form-label">Judul Berita</label>
                <input type="text" class="form-control col-sm-10" id="judul" name="judul" required
                    placeholder="Judul Berita" value="<?= $data['judul'] ?>">
            </div>
            <script>
                function cekHari() {
                    var tanggalInput = document.getElementById("tanggal").value;
                    var hari = new Date(tanggalInput).toLocaleDateString('id-ID', { weekday: 'long' });
                    document.getElementById("hari").value = hari;
                }
            </script>
            <div class="mb-3 form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <input type="date" class="form-control col-sm-10" id="tanggal" name="tanggal" oninput="cekHari()"
                    required value="<?= $data['tanggal'] ?>">
            </div>
            <div class="mb-3 form-group row">
                <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                <input type="text" class="form-control col-sm-10" id="hari" name="hari" required
                    placeholder="Otomatis Sesuai Tanggal" readonly value="<?= $data['hari'] ?>">
            </div>
            <div class="mb-3 form-group row">
                <label for="isi" class="col-sm-2 col-form-label">isi Berita</label>
                <div class="col-sm-10 p-0">
                    <textarea type="text" id="isi" name="isi" required><?= $data['isi'] ?></textarea>
                </div>
            </div>
            <script>
                ClassicEditor
                    .create(document.querySelector('#isi'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>
            <div class="mb-3 form-group row">
                <label for="sumber" class="col-sm-2 col-form-label">Sumber</label>
                <input type="text" class="form-control col-sm-10" id="sumber" name="sumber" placeholder="Sumber Berita"
                    required value="<?= $data['sumber'] ?>">
            </div>
            <div class="d-flex justify-content-between gap-2">
                <button class="btn btn-warning" type="submit" name="ubah_berita" data-bs-toggle="modal">Ubah</button>
                <a href="berita.php" class="btn btn-success">Kembali</a>
            </div>
        </form>
    </div>
</main>
<?php
require "./layout/footer.php";
require "./layout/bottom.php";
?>