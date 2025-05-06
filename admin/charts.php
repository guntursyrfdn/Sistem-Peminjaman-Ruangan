<?php
require "../connection/conn.php";
require "layout/top.php";
$nip = $_SESSION['user']['nip'];
$queryDinas = "SELECT nip, dinas FROM user";
$resultDinas = mysqli_query($conn, $queryDinas);
$namaDinasArray = array();

while ($row = mysqli_fetch_assoc($resultDinas)) {
  $namaDinasArray[] = $row['dinas'];
}

$queryRuanganDitanggung = "SELECT nama, id_ruangan FROM ruangan WHERE penanggung_jawab = '$nip'";
$resultRuanganDitanggung = mysqli_query($conn, $queryRuanganDitanggung);

if (isset($_GET['filterYear'])) {
  $filterYear = $_GET['filterYear'];
  // var_dump($filterYear);
  // die;
  $queryTotal = "SELECT ruangan, COUNT(*) as total FROM jadwal WHERE YEAR(tanggal) = $filterYear AND penanggung_jawab = '$nip'GROUP BY ruangan, dinas_peminjam";
} else {
  $queryTotal = "SELECT ruangan, COUNT(*) as total FROM jadwal WHERE penanggung_jawab = '$nip' AND dinas_peminjam='$nip' GROUP BY ruangan, dinas_peminjam";
}

$resultTotal = mysqli_query($conn, $queryTotal);
$totalRows = mysqli_num_rows($resultTotal);
var_dump($totalRows);
$tahun = date("Y");

// var_dump($bulan, $tahun, $bulanTahun);
// die;

?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
  </div>
  <div class="card-body">
    <!-- Filter Bulan dan Tahun -->
    <form action="chart.php" method="get">
      <div class="mb-3 form-group row">
        <label for="filterYear" class="col-sm-2 col-form-label">Filter per tahun:</label>
        <select class="form-control col-sm-2" style="margin-right: 10px" id="filterYear" name="filterYear">
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
      <canvas id="myBarChart"></canvas>
    </div>

    <!-- Tombol Unduh -->
    <button class="btn btn-primary mt-3" onclick="downloadChart()">Unduh Grafik</button>

    <script>
      function generateRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = 'rgba(';
        for (var i = 0; i < 3; i++) {
          color += Math.floor(Math.random() * 256) + ', ';
        }
        // Opasitas (alpha) diset ke 0.5 (50%)
        color += '0.5)';
        return color;
      }

      var labels = [
        <?php
        foreach ($namaDinasArray as $ruangan) {
          echo "'" . $ruangan . "', ";
        }
        ?>
      ];

      console.log('Labels:', labels); // Tambahkan ini untuk melihat data labels di konsol

      var datasets = [
        <?php
        mysqli_data_seek($resultRuanganDitanggung, 0); // Mengatur ulang posisi kursor ke awal
        while ($ruanganRow = mysqli_fetch_assoc($resultRuanganDitanggung)) {

          echo "{\n";
          echo 'label: "' . $ruanganRow['nama'] . '",';
          echo "data: [\n";

          mysqli_data_seek($resultTotal, 0);
          while ($totalRow = mysqli_fetch_assoc($resultTotal)) {
            if ($totalRow['ruangan'] === $ruanganRow['id_ruangan']) {
              echo $totalRow['total'] . ", ";
            } else {
              echo "0, ";
            }
          }

          echo "],\n";
          echo "backgroundColor: generateRandomColor(),\n";
          echo "borderColor: generateRandomColor().replace('0.5', '1'),\n";
          echo "borderWidth: 1\n";
          echo "},\n";
        }
        ?>
      ];


      console.log('Datasets:', datasets);

      var backgroundColor = [];
      var borderColor = [];
      for (var i = 0; i < labels.length; i++) {
        var randomColor = generateRandomColor();
        backgroundColor.push(randomColor);
        // Border color diatur menjadi warna yang sama dengan opasitas 1 (100%)
        borderColor.push(randomColor.replace('0.5', '1'));
      }

      function downloadChart() {
        // Logika untuk mengunduh grafik, misalnya menggunakan Chart.js built-in method
        var url = myChart.toBase64Image();
        var link = document.createElement('a');
        link.href = url;
        link.download = 'chart.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }

      var ctx = document.getElementById("myBarChart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: datasets,
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
    </script>


    <hr>
    <p>Grafik penggunaan semua ruangan Dinas Kabupaten Blora</p>
  </div>
</div>

<?php
require "layout/footer.php";
require "layout/bottom.php";
?>