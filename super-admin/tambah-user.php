<?php
require "layout/top.php";
require "../connection/conn.php";
$query = "SELECT * FROM ruangan";
$result = mysqli_query($conn, $query);
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mb-2 text-gray-800 font-weight-bold">Tambah User</h1>
    <hr>
    <form action="add-user.php" method="post" enctype="multipart/form-data">
      <div class="mb-3 form-group row">
        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
        <input type="text" class="form-control col-sm-10" id="nip" name="nip" required
          placeholder="Nomor Induk Pegawai">
      </div>
      <div class="mb-3 form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <input type="text" class="form-control col-sm-10" id="username" name="username" placeholder="Nama Pegawai"
          required>
      </div>
      <div class="mb-3 form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <input type="email" class="form-control col-sm-10" id="email" name="email" placeholder="contoh@gmail.com"
          required>
      </div>
      <div class="mb-3 form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <input type="password" class="form-control col-sm-10" id="password" name="password" placeholder="********"
          required>
      </div>
      <div class="mb-3 form-group row">
        <label for="dinas" class="col-sm-2 col-form-label">Dinas Asal</label>
        <input type="text" class="form-control col-sm-10" id="dinas" name="dinas" placeholder="Nama Dinas" required>
      </div>
      <div class="mb-3 form-group row">
        <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
        <input type="text" class="form-control col-sm-10" id="telepon" name="telepon" placeholder="Nomor Telepon"
          required>
      </div>
      <div class="d-flex gap-2 justify-content-between">
        <div>
          <button class="btn btn-primary" type="submit" name="submit_user">Kirim</button>
          <button class="btn btn-danger" type="reset">Reset</button>
        </div>
        <a href="index.php" class="btn btn-success" role="button">Kembali</a>
      </div>
    </form>
  </div>
</main>
<?php
require "layout/footer.php";
require "layout/bottom.php";
?>