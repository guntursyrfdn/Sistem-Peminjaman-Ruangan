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
    <h1 class="mb-2 text-gray-800 font-weight-bold">Ubah Jadwal</h1>
    <hr>
    <form action="update-jadwal.php" method="post" enctype="multipart/form-data">
      <div class="mb-3 form-group row d-none">
        <label for="id_jadwal" class="col-sm-2 col-form-label">Id Jadwal</label>
        <input type="text" class="form-control col-sm-10" id="id_jadwal" name="id_jadwal" required
          value="<?= $data['id_jadwal'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="ruangan" class="col-sm-2 col-form-label">Ruangan</label>
        <?php
        $queryRuangan = "SELECT * FROM ruangan WHERE penanggung_jawab = '{$data['penanggung_jawab']}'";
        $resultRuangan = mysqli_query($conn, $queryRuangan);
        $ruanganSelected = $data['ruangan'];
        ?>
        <select name="ruangan" id="ruangan" class="form-control col-sm-10">
          <option value="">Pilih Ruangan</option>
          <?php foreach ($resultRuangan as $dataRuangan): ?>
            <?php
            $selected = $ruanganSelected == $dataRuangan['id_ruangan'] ? 'selected' : '';
            ?>
            <option value="<?= $dataRuangan['id_ruangan'] ?>" <?= $selected ?>>
              <?= $dataRuangan['nama'] ?>
            </option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="mb-3 form-group row">
        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
        <input type="date" class="form-control col-sm-10" id="tanggal" name="tanggal" required
          value="<?= $data['tanggal'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="hari" class="col-sm-2 col-form-label">Hari</label>
        <input type="text" class="form-control col-sm-10" id="hari" name="hari" required placeholder="ex: Senin-Jumat"
          value="<?= $data['hari'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
        <input type="text" class="form-control col-sm-10" id="jam_mulai" name="jam_mulai" required
          value="<?= $data['jam_mulai'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="jam_selesai" class="col-sm-2 col-form-label">Jam Selesai</label>
        <input type="text" class="form-control col-sm-10" id="jam_selesai" name="jam_selesai" required
          value="<?= $data['jam_selesai'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="acara" class="col-sm-2 col-form-label">Acara</label>
        <input type="text" class="form-control col-sm-10" id="acara" name="acara" required
          value="<?= $data['acara'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
        <div class="col-sm-10 p-0"><textarea id="keterangan" name="keterangan" id="keterangan" required><?= $data['keterangan'] ?></textarea>
        </div>
      </div>
      <script>
        ClassicEditor
          .create(document.querySelector('#keterangan'))
          .catch(error => {
            console.error(error);
          });
      </script>
      <div class="mb-3 form-group row">
        <label for="dinas_peminjam" class="col-sm-2 col-form-label">Dinas Peminjam</label>
        <?php
        $queryPeminjam = "SELECT * FROM user";
        $resultPeminjam = mysqli_query($conn, $queryPeminjam);
        $dinasSelected = $data['dinas_peminjam'];
        ?>
        <select name="dinas_peminjam" id="dinas_peminjam" class="form-control col-sm-10">
          <option value="">Pilih Ruangan</option>
          <?php foreach ($resultPeminjam as $dataPJ): ?>
            <?php
            $selected = $dinasSelected == $dataPJ['nip'] ? 'selected' : '';
            ?>
            <option value="<?= $dataPJ['nip'] ?>" <?= $selected ?>>
              <?= $dataPJ['dinas'] ?>
            </option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="mb-3 form-group row">
        <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
        <input type="text" class="form-control col-sm-10" id="telepon" name="telepon" required
          value="<?= $data['telepon'] ?>">
      </div>
      <div class="d-flex flex-row justify-content-between">
        <button class="btn btn-warning" type="submit" name="ubah_jadwal" data-bs-toggle="modal">Ubah</button>
        <a href="index.php" class="btn btn-success ">Kembali</a>
      </div>
    </form>
  </div>
</main>
<?php
require "layout/footer.php";
require "layout/bottom.php";
?>