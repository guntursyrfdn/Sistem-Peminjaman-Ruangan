<?php
require "../connection/conn.php";
$id_ruangan = $_GET['id_ruangan'];
$query = "DELETE FROM ruangan WHERE id_ruangan = '$id_ruangan'";
if (mysqli_query($conn, $query)) {
  $msg= "Ruangan Berhasil Dihapus";
  header("Location: ruangan.php?success=true&msg=$msg");
} else {
  $msg = "Ruangan Gagal Dihapus" . mysqli_error($conn);
  header("Location: ruangan.php?success=false&msg=$msg");
}
mysqli_close($conn);
?>