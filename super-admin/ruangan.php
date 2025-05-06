<?php
require "layout/top.php";
require "../connection/conn.php";
$query = "SELECT * FROM ruangan ORDER BY id_ruangan ASC";
$result = mysqli_query($conn, $query);
?>
<h1 class="mb-2 text-gray-800 font-weight-bold">Daftar Ruangan</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-2 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-success">Tabel Data Ruangan</h6>
                            <a href="tambah-ruangan.php" class="btn btn-success">Tambah Ruangan</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Ruangan</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Penanggung Jawab</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $angka = 1; ?>
                                        <?php foreach ($result as $data) : ?>
                                        <tr>
                                            <td><?= $angka ?></td>
                                            <td><?= $data['id_ruangan'] ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['alamat'] ?></td>
                                            <?php
                                            $queryPJ = "SELECT dinas FROM user WHERE nip = '$data[penanggung_jawab]'";
                                            $resultPJ = mysqli_query($conn, $queryPJ);
                                            $dataPJ = mysqli_fetch_assoc($resultPJ);
                                            if ($data['penanggung_jawab'] == 0) {
                                                $penanggung_jawab = "Belum Ada";
                                            } else {
                                                $penanggung_jawab = $dataPJ['dinas'];
                                            }
                                            ?>
                                            <td><?= $penanggung_jawab ?></td>
                                            <?php
                                            ?>
                                            <td class="text-center">
                                                <a href="ubah-ruangan.php?id_ruangan=<?= $data["id_ruangan"] ?>" class="btn btn-warning">Ubah</a>
                                                <a href="delete-ruangan.php?id_ruangan=<?= $data["id_ruangan"] ?>" class="btn btn-danger">Hapus</a>
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