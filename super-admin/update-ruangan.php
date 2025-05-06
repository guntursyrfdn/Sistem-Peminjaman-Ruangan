<?php
require "../connection/conn.php";
if (isset($_POST['ubah_ruangan'])) {
  $id_ruangan = $_POST['id_ruangan'];
  $nama = strtoupper($_POST['nama']);
  $alamat = $_POST['alamat'];
  $penanggung_jawab = $_POST['penanggung_jawab'];
  $query = "UPDATE ruangan SET nama = '$nama', alamat = '$alamat', penanggung_jawab = '$penanggung_jawab' WHERE id_ruangan = '$id_ruangan'";
  if (mysqli_query($conn, $query)) {
    $msg = "Ruangan Berhasil Diubah";
    header("Location: ruangan.php?success=true&msg=$msg");
  } else {
    $msg = "Ruangan Gagal Diubah" . mysqli_error($conn);
    header("Location: ruangan.php?success=false&msg=$msg");
  }
  mysqli_close($conn);
}
?>