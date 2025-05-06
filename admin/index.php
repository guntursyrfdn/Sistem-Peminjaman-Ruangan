<?php
require "layout/top.php";
require "../connection/conn.php";
$nip = $_SESSION['user']['nip'];
$query = "SELECT * FROM jadwal WHERE penanggung_jawab = '$nip' ORDER BY id_jadwal DESC";
$result = mysqli_query($conn, $query);
// $data = mysqli_fetch_array($result);
// var_dump($data);
?>
<h1 class="mb-2 text-gray-800 font-weight-bold">Daftar Jadwal</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-2 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-success">Tabel Jadwal
            <?= $_SESSION['user']['dinas'] ?>
        </h6>
        <a href="tambah-jadwal.php" class="btn btn-success">Buat Jadwal</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Jadwal</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Acara</th>
                        <th>Dinas Peminjam</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $angka = 1; ?>
                    <?php foreach ($result as $data): ?>
                        <?php
                        // Anggap Anda memiliki ID acara pada parameter URL (ganti 'event_id' dengan nama parameter sebenarnya)
                        $id_jadwal = $data['id_jadwal'];
                        date_default_timezone_set('Asia/Jakarta');
                        // Tentukan apakah acara tersebut sedang berlangsung atau sudah selesai (Anda mungkin perlu menyesuaikan kondisi ini)
                        $now = date("Y-m-d H:i:s"); // Timestamp saat ini
                        // var_dump($now);
                        // die;
                        $queryStatus = "SELECT tanggal, jam_mulai, jam_selesai FROM jadwal WHERE id_jadwal = '$id_jadwal'";
                        $resultStatus = mysqli_query($conn, $queryStatus);

                        if ($row = mysqli_fetch_assoc($resultStatus)) {
                            $tanggal = $row['tanggal'];
                            $jam_mulai = $row['jam_mulai'];
                            $jam_selesai = $row['jam_selesai'];

                            $mulai_acara = $tanggal . " " . $jam_mulai;
                            $selesai_acara = $tanggal . " " . $jam_selesai;

                            // var_dump($mulai_acara, $now);
                            // die;
                    
                            if ($now >= $mulai_acara && $now <= $selesai_acara) {
                                $update_status_query = "UPDATE jadwal SET status = 'sedang dilaksanakan' WHERE tanggal = '$tanggal' AND jam_mulai = '$jam_mulai' AND jam_selesai = '$jam_selesai'";
                                mysqli_query($conn, $update_status_query);
                            }

                            // Perbarui status otomatis jika tanggal dan waktu acara telah selesai
                            if ($now > $selesai_acara) {
                                $update_status_query = "UPDATE jadwal SET status = 'sudah dilaksanakan' WHERE tanggal = '$tanggal' AND jam_mulai = '$jam_mulai' AND jam_selesai = '$jam_selesai'";
                                mysqli_query($conn, $update_status_query);
                            }
                        }
                        ?>
                        <tr>
                            <td>
                                <?= $angka ?>
                            </td>
                            <td>
                                <?= $data['id_jadwal'] ?>
                            </td>
                            <?php
                            $queryRuangan = "SELECT nama FROM ruangan WHERE id_ruangan = '$data[ruangan]'";
                            $resultRuangan = mysqli_query($conn, $queryRuangan);
                            $dataRuangan = mysqli_fetch_assoc($resultRuangan);
                            if ($data['ruangan'] == 0) {
                                $ruangan = "Belum Ada";
                            } else {
                                $ruangan = $dataRuangan['nama'];
                            }
                            ?>
                            <td>
                                <?= $ruangan ?>
                            </td>
                            <td>
                                <?= $data['tanggal'] ?>
                            </td>
                            <td>
                                <?= $data['jam_mulai'] ?>
                            </td>
                            <td>
                                <?= $data['jam_selesai'] ?>
                            </td>
                            <td>
                                <?= $data['acara'] ?>
                            </td>
                            <?php
                            $queryDinas = "SELECT dinas FROM user WHERE nip = '$data[dinas_peminjam]'";
                            $resultDinas = mysqli_query($conn, $queryDinas);
                            $dataDinas = mysqli_fetch_assoc($resultDinas);
                            if ($data['dinas_peminjam'] == 0) {
                                $dinas_peminjam = "Belum Ada";
                            } else {
                                $dinas_peminjam = $dataDinas['dinas'];
                            }
                            ?>
                            <td>
                                <?= $dinas_peminjam ?>
                            </td>
                            <td>
                                <?php
                                if ($data['status'] == "belum dilaksanakan") {
                                    ?>
                                    <span class="badge rounded-pill bg-danger text-white p-2">
                                        <?= $data['status'] ?>
                                    </span>
                                    <?php
                                } else if ($data['status'] == "sedang dilaksanakan") {
                                    ?>
                                        <span class="badge rounded-pill bg-warning text-white p-2">
                                        <?= $data['status'] ?>
                                        </span>
                                    <?php
                                } else if ($data['status'] == "sudah dilaksanakan") {
                                    ?>
                                            <span class="badge rounded-pill bg-success text-white p-2">
                                        <?= $data['status'] ?>
                                            </span>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a href="detail-jadwal.php?id_jadwal=<?= $data["id_jadwal"] ?>"
                                    class="btn btn-success">Detail</a>
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
?>
<script>
    setTimeout(function(){
        location.reload();
    }, 60000); // Reload the page every 60,000 milliseconds (60 seconds)
</script>
<?php
require "layout/bottom.php";
?>