<?php
require "../connection/conn.php";
require "layout/top.php";
$nip = $_SESSION['user']['nip'];
$query = "SELECT * FROM berita WHERE pembuat= '$nip' ORDER BY id_berita";
$result = mysqli_query($conn, $query);
?>
<h1 class="mb-2 text-gray-800 font-weight-bold">Daftar Berita</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-2 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-success">Tabel Berita
            <?= $_SESSION['user']['dinas'] ?>
        </h6>
        <a href="tambah-berita.php" class="btn btn-success">Buat Berita</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Isi Berita</th>
                        <th>Sumber</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $angka = 1; ?>
                    <?php foreach ($result as $data): ?>
                        <tr>
                            <td style="height: 138px;">
                                <?= $angka ?>
                            </td>
                            <td
                                style="height: 138px; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; -webkit-line-clamp: 6; white-space: normal;">
                                <?= $data['judul'] ?>
                            </td>
                            <td style="height: 138px;"><img src="gambar/<?php echo $data['gambar']; ?>"
                                    style="max-width: 300px;"></td>
                            <td style="height: 138px;">
                                <?= $data['tanggal'] ?>
                            </td>
                            <td style="height: 138px;">
                                <?= $data['hari'] ?>
                            </td>
                            <td
                                style=" display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden; -webkit-line-clamp: 6; white-space: normal; height: 138px;">
                                <?= $data['isi'] ?>
                            </td>
                            <td style="height: 138px;">
                                <?= $data['sumber'] ?>
                            </td>
                            <td style="height: 138px;">
                                <a href="ubah-berita.php?id_berita=<?= $data['id_berita'] ?>"
                                    class="btn btn-warning mb-2">Ubah</a>
                                <a href="delete-berita.php?id_berita=<?= $data["id_berita"] ?>"
                                    class="btn btn-danger">Hapus</a>
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