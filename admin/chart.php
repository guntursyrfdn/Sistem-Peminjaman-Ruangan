<?php
require "../connection/conn.php";
require "layout/top.php";

$nip = $_SESSION['user']['nip'];
$queryDinas = "SELECT dinas, nip FROM user";
$resultDinas = mysqli_query($conn, $queryDinas);
$namaDinasArray = array();
$idDinasArray = array();

while ($row = mysqli_fetch_assoc($resultDinas)) {
  $namaDinasArray[] = $row['dinas'];
  $idDinasArray[] = $row['nip'];
}

$queryRuanganDitanggung = "SELECT nama, id_ruangan FROM ruangan WHERE penanggung_jawab = '$nip'";
$resultRuanganDitanggung = mysqli_query($conn, $queryRuanganDitanggung);
$ruanganDitanggungArray = array();
$idRuanganArray = array();
while ($row = mysqli_fetch_assoc($resultRuanganDitanggung)) {
  $ruanganDitanggungArray[] = $row['nama'];
  $idRuanganArray[] = $row['id_ruangan'];
}

$queryPeminjam = "SELECT DISTINCT dinas_peminjam FROM jadwal WHERE penanggung_jawab = '$nip'";
$resultPeminjam = mysqli_query($conn, $queryPeminjam);
$peminjamArray = array();
while ($row = mysqli_fetch_assoc($resultPeminjam)) {
  $peminjamArray[] = $row['dinas_peminjam'];
}

?>

<?php foreach ($ruanganDitanggungArray as $index => $ruanganDitanggung) { ?>
  <?php
  $idRuangan = $idRuanganArray[$index];
  $peminjam = $peminjamArray[$index];

  if (isset($_GET['filterYear'])) {
    $filterYear = $_GET['filterYear'];
    $queryTotal = "SELECT ruangan, COUNT(*) as total FROM jadwal WHERE YEAR(tanggal) = $filterYear AND penanggung_jawab = '$nip' AND ruangan = '$idRuangan' AND dinas_peminjam = '$peminjam' GROUP BY ruangan, dinas_peminjam";
  } else {
    $queryTotal = "SELECT ruangan, COUNT(*) as total FROM jadwal WHERE penanggung_jawab = '$nip' AND ruangan = '$idRuangan' GROUP BY ruangan, dinas_peminjam";
  }

  $resultTotal = mysqli_query($conn, $queryTotal);
  $tahun = date("Y");
  ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Grafik
        <?= $ruanganDitanggung ?>
      </h6>
    </div>
    <div class="card-body">
      <!-- Filter Bulan dan Tahun -->
      <form action="chart.php" method="get">
        <div class="mb-3 form-group row">
          <label for="filterYear<?= $index ?>" class="col-sm-2 col-form-label">Filter per tahun:</label>
          <select class="form-control col-sm-2" style="margin-right: 10px" id="filterYear<?= $index ?>" name="filterYear">
            <option value="">Pilih Tahun</option>
            <?php
            for ($i = $tahun - 5; $i <= $tahun; $i++) {
              echo '<option value="' . $i . '">' . $i . '</option>';
            }
            ?>
          </select>

          <button class="btn btn-primary" style="height: fit-content" type="submit">Filter</button>
        </div>
      </form>

      <!-- Chart -->
      <div class="chart-bar" style="width: fit-cover; height: fit-content">
        <canvas id="myBarChart<?= $index ?>"></canvas>
      </div>

      <!-- Tombol Unduh -->
      <button class="btn btn-primary mt-3" onclick="downloadChart('myBarChart<?= $index ?>')">Unduh Grafik</button>

      <hr>
      <p>Grafik penggunaan ruangan
        <?= $ruanganDitanggung ?>
      </p>
    </div>
  </div>

  <script>
    var ctx<?= $index ?> = document.getElementById("myBarChart<?= $index ?>").getContext('2d');
    var myChart<?= $index ?> = new Chart(ctx<?= $index ?>, {
      type: 'bar',
      data: {
        labels: [
          <?php
          foreach ($namaDinasArray as $dinas) {
            echo "'" . $dinas . "', ";
          }
          ?>
        ],
        datasets: [{
          label: "Jumlah",
          data: [
            <?php
            mysqli_data_seek($resultTotal, 0);
            while ($row = mysqli_fetch_assoc($resultTotal)) {
              echo $row['total'] . ", ";
            }
            ?>
          ],
          backgroundColor: generateRandomColors(<?= count($namaDinasArray) ?>),
          borderColor: generateRandomColors(<?= count($namaDinasArray) ?>, 1),
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });

    function downloadChart(chartId) {
      var url = window[chartId].toBase64Image();
      var link = document.createElement('a');
      link.href = url;
      link.download = 'chart.png';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }

    function generateRandomColors(count, alpha = 0.5) {
      var colors = [];
      for (var i = 0; i < count; i++) {
        var randomColor = 'rgba(';
        for (var j = 0; j < 3; j++) {
          randomColor += Math.floor(Math.random() * 256) + ', ';
        }
        randomColor += alpha + ')';
        colors.push(randomColor);
      }
      return colors;
    }
  </script>
<?php } ?>

<?php
require "layout/footer.php";
require "layout/bottom.php";
?>