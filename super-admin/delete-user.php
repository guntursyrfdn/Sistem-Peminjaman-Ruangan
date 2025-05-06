<?php
require "../connection/conn.php";
$nip = $_GET['nip'];
$query = "DELETE FROM user WHERE nip = '$nip'";
if (mysqli_query($conn, $query)) {
  $msg = "User Berhasil Dihapus";
  header("Location: index.php");
} else {
  $msg = "User Gagal Dihapus" . mysqli_error($conn);
  header("Location: index.php?success=false&msg=$msg");
}
mysqli_close($conn);
?>