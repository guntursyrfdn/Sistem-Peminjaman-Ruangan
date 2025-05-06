<?php
require "../connection/conn.php";
if (isset($_POST['submit_ruangan'])) {
  $id_ruangan = $_POST['id_ruangan'];
  $nama = strtoupper($_POST['nama']);
  $alamat = $_POST['alamat'];
  $penanggung_jawab = $_POST['penanggung_jawab'];
  $query = "INSERT INTO ruangan VALUES ('$id_ruangan', '$nama', '$alamat', '$penanggung_jawab')";
  if (mysqli_query($conn, $query)) {
    $msg = "Ruangan Berhasil Ditambahkan";
    header("Location: ruangan.php?success=true&msg=$msg");
  } else {
    $msg = "Ruangan Gagal Ditambahkan" . mysqli_error($conn);
    header("Location: ruangan.php?success=false&msg=$msg");
  }
  mysqli_close($conn);
}
?>