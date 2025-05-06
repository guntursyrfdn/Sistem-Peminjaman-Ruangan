<?php
require "layout/top.php";
require "../connection/conn.php";
$query = "SELECT * FROM user ORDER BY nip DESC";
$queryRuangan = "SELECT nama FROM ruangan";
$result = mysqli_query($conn, $query);
?>
<h1 class="mb-2 text-gray-800 font-weight-bold">Daftar User</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-2 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-success">Tabel Data User</h6>
        <a href="tambah-user.php" class="btn btn-success">Tambah User</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Dinas</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $angka = 1; ?>
                    <?php foreach ($result as $data): ?>
                        <tr>
                            <td>
                                <?= $angka ?>
                            </td>
                            <td>
                                <?= $data['nip'] ?>
                            </td>
                            <td>
                                <?= $data['username'] ?>
                            </td>
                            <td>
                                <?= $data['email'] ?>
                            </td>
                            <td>
                                <?= $data['dinas'] ?>
                            </td>
                            <td>
                                <?= $data['telepon'] ?>
                            </td>
                            <td class="text-center">
                                <a href="ubah-user.php?nip=<?= $data["nip"] ?>" class="btn btn-warning">Ubah</a>
                                <a href="delete-user.php?nip=<?= $data["nip"] ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php $angka++ ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require "layout/footer.php";
require "layout/bottom.php";
?>