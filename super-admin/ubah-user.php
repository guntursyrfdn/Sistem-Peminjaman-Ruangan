<?php
require "layout/top.php";
require "../connection/conn.php";
$nip = $_GET['nip'];
$query = "SELECT * FROM user WHERE nip = '$nip'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_array($result);
?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mb-2 text-gray-800 font-weight-bold">Ubah User</h1>
    <hr>
    <form action="update-user.php" method="post" enctype="multipart/form-data">
      <div class="mb-3 form-group row">
        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
        <input type="text" class="form-control col-sm-10" id="nip" name="nip" required placeholder="Nomor Induk Pegawai"
          value="<?= $data['nip'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="username" class="col-sm-2 col-form-label">Username</label>
        <input type="text" class="form-control col-sm-10" id="username" name="username" placeholder="Nama Pegawai"
          required value="<?= $data['username'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <input type="email" class="form-control col-sm-10" id="email" name="email" placeholder="contoh@gmail.com"
          required value="<?= $data['email'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <input type="password" class="form-control col-sm-10" id="password" name="password" placeholder="********"
          required value="<?= $data['password'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="dinas" class="col-sm-2 col-form-label">Dinas Asal</label>
        <input type="text" class="form-control col-sm-10" id="dinas" name="dinas" placeholder="Nama Dinas" required
          value="<?= $data['dinas'] ?>">
      </div>
      <div class="mb-3 form-group row">
        <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
        <input type="text" class="form-control col-sm-10" id="telepon" name="telepon" placeholder="Nomor Telepon"
          required value="<?= $data['telepon'] ?>">
      </div>
      <div class="d-flex gap-2 justify-content-between">
        <button class="btn btn-warning" type="submit" name="ubah_user">Ubah</button>
        <a href="index.php" class="btn btn-success" role="button">Kembali</a>
      </div>
    </form>
  </div>
</main>
<?php
require "layout/footer.php";
require "layout/bottom.php";
?>