<?php
session_start();
require "../connection/conn.php";

$nip = $_SESSION['user']['nip'];
if (isset($_POST['submit_berita'])) {
  $judul = $_POST['judul'];
  $gambar =  $_FILES['gambar']['name'];
  $tanggal = $_POST['tanggal'];
  $hari = $_POST['hari'];
  $isi = $_POST['isi'];
  $sumber = $_POST['sumber'];
  $pembuat = $nip;
  // var_dump ($judul,$gambar,$tanggal,$hari,$isi,$sumber);
  // die;

  if ($gambar != "") {
    $ekstensi_diperbolehkan = array('png','jpg','jpeg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];   
    $nama_gambar_baru = $gambar;
    
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
      $query = "INSERT INTO berita (judul, gambar, tanggal, hari, isi, sumber, pembuat) VALUES ('$judul', '$gambar', '$tanggal', '$hari', '$isi', '$sumber', '$pembuat')";
      $result = mysqli_query($conn, $query);
      if ($result) {
          $msg = "Berita berhasil buat";
          header("Location: berita.php?success=true&msg=$msg");
      } else {
          $msg = "Berita gagal dibuat" . mysqli_error($conn);
          header("Location: berita.php?success=false&msg=$msg");
      }
    } else {
        $msg = "Ekstensi gambar yang boleh hanya jpg, png, atau jpeg" . mysqli_error($conn);
        header("Location: tambah-berita.php?success=false&msg=$msg");
    }
  }
}
?>