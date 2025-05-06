<?php
require "../connection/conn.php";
require "layout/top.php";
$query = "SELECT max(id_jadwal) as maxId FROM jadwal";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);
$maxId = $data['maxId'];
$noUrut = (int) substr($maxId, 3, 3);
$noUrut++;
$char = "J";
$id_jadwal = $char . sprintf("%04s", $noUrut);

$queryPJ = "SELECT * FROM user";
$resultPJ = mysqli_query($conn, $queryPJ);

$nip = $_SESSION['user']['nip'];
?>
<main>
  <div class="container-fluid px-4 bg-light">
    <h1 class="mb-2 text-gray-800 font-weight-bold">Buat Jadwal</h1>
    <hr>
    <form action="add-jadwal.php" method="post" enctype="multipart/form-data" novalidate>
      <div class="mb-3 form-group row">
        <label for="id_jadwal" class="col-sm-2 col-form-label">Id Jadwal</label>
        <input type="text" class="form-control col-sm-10" id="id_jadwal" name="id_jadwal" required
          value="<?= $id_jadwal ?>" readonly>
      </div>
      <div class="mb-3 form-group row">
        <label for="ruangan" class="col-sm-2 col-form-label">Ruangan</label>
        <?php
        $queryRuangan = "SELECT * FROM ruangan WHERE penanggung_jawab = '$nip'";
        $resultRuangan = mysqli_query($conn, $queryRuangan);
        ?>
        <select name="ruangan" id="ruangan" class="form-control col-sm-10">
          <option value="">Pilih Ruangan</option>
          <?php foreach ($resultRuangan as $dataRuangan): ?>
            <option value="<?= $dataRuangan['id_ruangan'] ?>">
              <?= $dataRuangan['nama'] ?>
            </option>
          <?php endforeach; ?>
        </select>
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
        <input type="date" class="form-control col-sm-10" id="tanggal" name="tanggal" oninput="cekHari()" required>
      </div>
      <div class="mb-3 form-group row">
        <label for="hari" class="col-sm-2 col-form-label">Hari</label>
        <input type="text" class="form-control col-sm-10" id="hari" name="hari" required
          placeholder="Otomatis Sesuai Tanggal" value="" readonly>
      </div>
      <script>
        function validateTimeInput(inputElement) {
          var inputValue = inputElement.value;
          if (!/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/.test(inputValue)) {
            // Format waktu tidak sesuai, hapus karakter terakhir
            inputElement.value = inputValue.slice(0, -1);
          }
        }

        document.getElementById('jam_mulai').addEventListener('input', function (event) {
          validateTimeInput(event.target);
        });

        document.getElementById('jam_selesai').addEventListener('input', function (event) {
          validateTimeInput(event.target);
        });
      </script>
      <div class="mb-3 form-group row">
        <label for="jam_mulai" class="col-sm-2 col-form-label">Jam Mulai</label>
        <input type="text" class="form-control col-sm-10" id="jam_mulai" name="jam_mulai"
          pattern="^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$" placeholder="hh:mm" required>
      </div>
      <div class="mb-3 form-group row">
        <label for="jam_selesai" class="col-sm-2 col-form-label">Jam Selesai</label>
        <input type="text" class="form-control col-sm-10" id="jam_selesai" name="jam_selesai"
          pattern="^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$" placeholder="hh:mm" required>
      </div>
      <div class="mb-3 form-group row">
        <label for="acara" class="col-sm-2 col-form-label">Acara</label>
        <input type="text" class="form-control col-sm-10" id="acara" name="acara" required placeholder="Judul Acara">
      </div>
      <div class="mb-3 form-group row">
        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
        <div class="col-sm-10 p-0"><textarea id="keterangan" name="keterangan" id="keterangan" required></textarea>
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
        $queryDinas = "SELECT nip, dinas FROM user";
        $resultDinas = mysqli_query($conn, $queryDinas);
        ?>
        <select class="form-control col-sm-10" id="dinas_peminjam" name="dinas_peminjam" required>
          <option value="">Pilih Dinas</option>
          <?php foreach ($resultDinas as $dataDinas): ?>
            <option value="<?= $dataDinas['nip'] ?>">
              <?= $dataDinas['dinas'] ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3 form-group row">
        <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
        <input type="text" class="form-control col-sm-10" id="telepon" name="telepon" required placeholder="No Telepon">
      </div>
      <div class="d-flex flex-row justify-content-between gap-auto">
        <div class="d-grid gap-2 d-md-block">
          <button type="submit" name="tambah_jadwal" class="btn btn-primary">Kirim</button>
          <button type="reset" class="btn btn-danger">Reset</button>
        </div>
        <a href="index.php" class="btn btn-success text-center" style="height: fit-content;">Kembali</a>
      </div>
    </form>
  </div>
</main>
<?php
require "layout/footer.php";
require "layout/bottom.php";
?>