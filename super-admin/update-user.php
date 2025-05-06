<?php
require "../connection/conn.php";
if (isset($_POST['ubah_user'])) {
  $nip = $_POST['nip'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $dinas = strtoupper($_POST['dinas']);
  $telepon = $_POST['telepon'];
  $query = "UPDATE user SET username = '$username', email = '$email', password = '$password', dinas = '$dinas', telepon = '$telepon' WHERE nip = '$nip'";
  if (mysqli_query($conn, $query)) {
    $msg = "User Berhasil Diubah";
    header("Location: index.php?success=true&msg=$msg");
  } else {
    $msg = "User Gagal Diubah" . mysqli_error($conn);
    header("Location: index.php?success=false&msg=$msg");
  }
  mysqli_close($conn);
}
?>