<?php
require "layout/top.php";
require "../connection/conn.php";
$query = "SELECT max(id_ruangan) as maxId FROM ruangan";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);
$maxId = $data['maxId'];
$noUrut = (int) substr($maxId, 3, 3);
$noUrut++;
$char = "R";
$id_ruangan = $char . sprintf("%04s", $noUrut);

$queryPJ = "SELECT * FROM user";
$resultPJ = mysqli_query($conn, $queryPJ);
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mb-2 text-gray-800 font-weight-bold">Tambah Ruangan</h1>
    <hr>
    <form action="add-ruangan.php" method="post" enctype="multipart/form-data">
      <div class="mb-3 form-group row">
        <label for="id_ruangan" class="col-sm-2 col-form-label">Id Ruangan</label>
        <input type="text" class="form-control col-sm-10" id="id_ruangan" name="id_ruangan" value="<?= $id_ruangan ?>"
          required readonly>
      </div>
      <div class="mb-3 form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama Ruangan</label>
        <input type="text" class="form-control col-sm-10" id="nama" name="nama" placeholder="Nama Ruangan" required>
      </div>
      <div class="mb-3 form-group row">
        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
        <input type="text" class="form-control col-sm-10" id="alamat" name="alamat" placeholder="Alamat" required>
      </div>
      <div class="mb-3 form-group row">
        <label for="penanggung_jawab" class="col-sm-2 col-form-label">Penanggung Jawab</label>
        <select name="penanggung_jawab" id="penanggung_jawab" class="form-control col-sm-10" required>
          <option value="">Pilih Dinas</option>
          <?php foreach ($resultPJ as $data): ?>
            <option value="<?= $data['nip'] ?>">
              <?= $data['dinas'] ?>
            </option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="d-flex gap-2 justify-content-between">
        <div>
          <button class="btn btn-primary" type="submit" name="submit_ruangan">Kirim</button>
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