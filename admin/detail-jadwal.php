<?php
require "../connection/conn.php";
require "layout/top.php";
if (isset($_SESSION['id_update'])) {
    $id_jadwal = $_SESSION['id_update'];
    // echo $id_jadwal;
} else {
    $id_jadwal = $_GET['id_jadwal'];
}
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
<main>
    <div class="container-fluid px-4 bg-light">
        <h1 class="mb-2 text-gray-800 font-weight-bold">Detail Jadwal</h1>
        <hr>
        <form action="ubah-jadwal.php" method="post" enctype="multipart/form-data">
            <div class="mb-3 form-group row">
                <label for="id_jadwal" class="col-sm-2 col-form-label">Id Jadwal</label>
                <input type="text" class="form-control col-sm-10" id="id_jadwal" name="id_jadwal" required
                    value="<?= $data['id_jadwal'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="ruangan" class="col-sm-2 col-form-label">Ruangan</label>
                <?php
                $queryRuangan = "SELECT * FROM ruangan WHERE id_ruangan = '{$data['ruangan']}'";
                $resultRuangan = mysqli_query($conn, $queryRuangan);
                $dataRuangan = mysqli_fetch_array($resultRuangan);
                ?>
                <input type="text" class="form-control col-sm-10" id="ruangan" name="ruangan" required
                    value="<?= $dataRuangan['nama'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                <input type="date" class="form-control col-sm-10" id="tanggal" name="tanggal" required
                    value="<?= $data['tanggal'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="hari" class="col-sm-2 col-form-label">Hari</label>
                <input type="text" class="form-control col-sm-10" id="hari" name="hari" required
                    placeholder="ex: Senin-Jumat" value="<?= $data['hari'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
                <input type="text" class="form-control col-sm-10" id="jam_mulai" name="jam_mulai" required
                    value="<?= $data['jam_mulai'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="jam_selesai" class="col-sm-2 col-form-label">Jam Selesai</label>
                <input type="text" class="form-control col-sm-10" id="jam_selesai" name="jam_selesai" required
                    value="<?= $data['jam_selesai'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="acara" class="col-sm-2 col-form-label">Acara</label>
                <input type="text" class="form-control col-sm-10" id="acara" name="acara" required
                    value="<?= $data['acara'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10 p-0"><textarea id="keterangan" name="keterangan" id="keterangan" required
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
            <div class="mb-3 form-group row">
                <label for="penanggung_jawab" class="col-sm-2 col-form-label">Penanggung Jawab</label>
                <?php
                $queryPJ = "SELECT * FROM user WHERE nip = '{$data['penanggung_jawab']}'";
                $resultPJ = mysqli_query($conn, $queryPJ);
                $dataPJ = mysqli_fetch_array($resultPJ);
                ?>
                <input type="text" class="form-control col-sm-10" id="penanggung_jawab" name="penanggung_jawab" required
                    value="<?= $dataPJ['dinas'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="dinas_peminjam" class="col-sm-2 col-form-label">Dinas Peminjam</label>
                <?php
                $queryPeminjam = "SELECT * FROM user WHERE nip = '{$data['dinas_peminjam']}'";
                $resultPeminjam = mysqli_query($conn, $queryPeminjam);
                $dataPeminjam = mysqli_fetch_array($resultPeminjam);
                ?>
                <input type="text" class="form-control col-sm-10" id="dinas_peminjam" name="dinas_peminjam" required
                    value="<?= $dataPeminjam['dinas'] ?>" readonly>
            </div>
            <div class="mb-3 form-group row">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                <input type="text" class="form-control col-sm-10" id="telepon" name="telepon" required
                    value="<?= $data['telepon'] ?>" readonly>
            </div>
            <div class="d-flex flex-row justify-content-between">
                <div class="d-grid gap-2 d-md-block">
                    <a href="ubah-jadwal.php?id_jadwal=<?= $data["id_jadwal"] ?>" class="btn btn-warning">Ubah</a>
                    <a href="delete-jadwal.php?id_jadwal=<?= $data["id_jadwal"] ?>" class="btn btn-danger">Hapus</a>
                </div>
                <a href="index.php" class="btn btn-success" style="height: fit-content;">Kembali</a>
            </div>
        </form>
    </div>
</main>
<?php
unset($_SESSION['id_update']);
require "layout/footer.php";
require "layout/bottom.php";
?>