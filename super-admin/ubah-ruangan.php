<?php
require "layout/top.php";
require "../connection/conn.php";
$id_ruangan = $_GET['id_ruangan'];
$query = "SELECT * FROM ruangan WHERE id_ruangan = '$id_ruangan'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mb-2 text-gray-800 font-weight-bold">Ubah Ruangan</h1>
    <hr>
    <form action="update-ruangan.php" method="post" enctype="multipart/form-data">
      <div class="mb-3 form-group row">
        <label for="id_ruangan" class="col-sm-2 col-form-label">Id Ruangan</label>
        <input type="text" class="form-control col-sm-10" id="id_ruangan" name="id_ruangan" value="<?= $id_ruangan ?>"
          required readonly>
      </div>
      <div class="mb-3 form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Ruangan</label>
        <input type="text" class="form-control col-sm-10" id="nama" name="nama" placeholder="Nama Ruangan" required
          value="<?= $data['nama'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
        <input type="text" class="form-control col-sm-10" id="alamat" name="alamat" placeholder="Alamat" required
          value="<?= $data['alamat'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="penanggung_jawab" class="col-sm-2 col-form-label">Penaggung Jawab</label>
        <?php
        $queryPJ = "SELECT * FROM user";
        $resultPJ = mysqli_query($conn, $queryPJ);
        $pjSelected = $data['penanggung_jawab'];
        ?>
        <select name="penanggung_jawab" id="penanggung_jawab" class="form-control col-sm-10">
          <option value="">Pilih Dinas</option>
          <?php foreach ($resultPJ as $dataPJ): ?>
            <?php
            $selected = $pjSelected == $dataPJ['nip'] ? 'selected' : '';
            ?>
            <option value="<?= $dataPJ['nip'] ?>" <?= $selected ?>>
              <?= $dataPJ['dinas'] ?>
            </option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="d-flex gap-2 justify-content-between">
        <div>
          <button class="btn btn-primary" type="submit" name="ubah_ruangan">Kirim</button>
          <button class="btn btn-danger" type="reset">Reset</button>
        </div>
        <a href="ruangan.php" class="btn btn-success" role="button">Kembali</a>
      </div>
    </form>
  </div>
</main>
<?php
require "layout/footer.php";
require "layout/bottom.php";
?>