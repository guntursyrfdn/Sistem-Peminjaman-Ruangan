<?php
require "./layout/top.php"
  ?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mb-2 text-gray-800 font-weight-bold">Buat Berita</h1>
    <hr>
    <form action="add-berita.php" method="post" enctype="multipart/form-data" novalidate>
      <div class="mb-3 form-group row">
        <label for="gambar" class="col-sm-2 col-form-label">Gambar Berita</label>
        <input type="file" class="form-control col-sm-10" id="gambar" name="gambar" required placeholder="Judul Berita">
      </div>
      <div class="mb-3 form-group row">
        <label for="judul" class="col-sm-2 col-form-label">Judul Berita</label>
        <input type="text" class="form-control col-sm-10" id="judul" name="judul" required placeholder="Judul Berita">
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
      <div class="mb-3 form-group row">
        <label for="isi" class="col-sm-2 col-form-label">isi Berita</label>
        <div class="col-sm-10 p-0"><textarea id="isi" name="isi" required></textarea></div>
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
          required>
      </div>
      <div class="d-flex flex-row justify-content-between gap-auto">
        <div class="d-grid gap-2 d-md-block">
          <button class="btn btn-primary" type="submit" name="submit_berita" data-bs-toggle="modal">Kirim</button>
          <button class="btn btn-danger" type="reset">Reset</button>
        </div>
        <a href="berita.php" class="btn btn-success text-center" style="height: fit-content;">Kembali</a>
      </div>
    </form>
  </div>
</main>
<?php
require "./layout/footer.php";
require "./layout/bottom.php";
?>