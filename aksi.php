<?php
session_start();
require "connection/conn.php";
if (isset($_POST['login_user'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = "SELECT * FROM `user` WHERE username='$username' && password='$password'";
  $result = mysqli_query($conn, $query);
  $isLogin = mysqli_num_rows($result);
  $data = mysqli_fetch_assoc($result);
  $_SESSION['user'] = $data;
  if ($isLogin > 0) {
    header("Location: admin/index.php");
  } else {
    $msg = "<p class='alert alert-danger'>User atau Password Anda Salah </p>";
    header("Location: login.php?msg=$msg");
    exit;
  }
} elseif (isset($_POST['login_admin'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = "SELECT * FROM `admin` WHERE username='$username' && password='$password'";
  $result = mysqli_query($conn, $query);
  $isLogin = mysqli_num_rows($result);
  $data = mysqli_fetch_assoc($result);
  $_SESSION['admin'] = $data;
  if ($isLogin > 0) {
    header("Location: super-admin/index.php");
  } else {
    $msg = "<p class='alert alert-danger'>User atau Password Anda Salah </p>";
    header("Location: login.php?msg=$msg");
    exit;
  }
} else {
  $id = $_POST['id'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_passworod = $_POST['confirm_password'];

  if ($password == $confirm_passworod) {
    $query = "INSERT INTO admin (`id`, `username`, `email`, `password`) VALUES ('$id','$username','$email','$password')";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $msg = "<p class='alert alert-success'>Registrasi Berhasil</p>";
      header("Location: login-admin.php?msg=$msg");
    } else {
      $msg = "data gagal" . mysqli_error($conn);
      header("Location: login-admin.php?msg=$msg");
    }
  } else {
    $msg = "<p class='alert alert-danger'>Password dan Confirm Password Tidak Cocok</p>";
    header("Location: register.php?msg=$msg");
    exit();
  }
}
?>