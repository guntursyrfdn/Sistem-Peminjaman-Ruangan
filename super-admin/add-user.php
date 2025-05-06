<?php
require "../connection/conn.php";
if (isset($_POST['submit_user'])) {
  $nip = $_POST['nip'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $dinas = strtoupper($_POST['dinas']);
  $telepon = $_POST['telepon'];
  $query = "INSERT INTO user VALUES ('$nip', '$username', '$email', '$password', '$dinas', '$telepon')";
  if (mysqli_query($conn, $query)) {
    $msg = "User Berhasil Ditambahkan";
    header("Location: index.php?success=true&msg=$msg");
  } else {
    $msg = "User Gagal Ditambahkan" . mysqli_error($conn);
    header("Location: index.php?success=false&msg=$msg");
  }
  mysqli_close($conn);
}
?>