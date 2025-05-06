<?php
session_start();
require "../connection/conn.php";
if (isset($_POST['ubah_jadwal'])) {
  $id_jadwal = $_POST['id_jadwal'];
  $ruangan = $_POST['ruangan'];
  $tanggal = $_POST['tanggal'];
  $hari = $_POST['hari'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];
  $acara = strtoupper($_POST['acara']);
  $keterangan = $_POST['keterangan'];
  $dinas_peminjam = $_POST['dinas_peminjam'];
  $telepon = $_POST['telepon'];
  // var_dump($id_jadwal,$ruangan, $tanggal, $hari, $jam_mulai, $jam_selesai, $acara, $keterangan, $dinas_peminjam, $telepon);
  // die;
  $tanggal_hari_ini = date('Y-m-d');

  if (($jam_mulai >= $jam_selesai) || ($tanggal < $tanggal_hari_ini)) {
    if ($jam_mulai >= $jam_selesai) {
      $msg = "Jam Mulai Tidak Boleh Lebih Besar Dari Jam Selesai";
      header("Location: tambah-jadwal.php?success=false&msg=$msg");
      exit;
    } else {
      $msg = "Tidak Bisa Membuat Jadwal yang Tanggalnya Sebelum Hari Ini";
      header("Location: tambah-jadwal.php?success=false&msg=$msg");
      exit;
    }
  } else {
    $check_query = "SELECT * FROM jadwal WHERE id_jadwal != '$id_jadwal' AND ruangan = '$ruangan' AND tanggal = '$tanggal' AND ((jam_mulai <= '$jam_mulai' AND jam_selesai > '$jam_mulai') OR (jam_mulai < '$jam_selesai' AND jam_selesai > '$jam_selesai'))";
    $check_result = mysqli_query($conn, $check_query);
    // $cek = mysqli_num_rows($check_result);
    // var_dump($cek);
    // die;

    if (mysqli_num_rows($check_result) > 0) {
      $msg = "Ruangan Sedang Digunakan, Mohon Cari Jam atau Hari Lain.";
      header("Location: ubah-jadwal.php?msg=success=false&$msg");
      exit;
    } else {
      $query = "UPDATE jadwal SET `ruangan`='$ruangan', `tanggal`='$tanggal',`hari`='$hari',`jam_mulai`='$jam_mulai',`jam_selesai`='$jam_selesai',`acara`='$acara',`keterangan`='$keterangan',`dinas_peminjam`='$dinas_peminjam',`telepon`='$telepon' WHERE id_jadwal = '$id_jadwal'";
      if (mysqli_query($conn, $query)) {
        $msg = "Jadwal Berhasil Diudah";
        $_SESSION['id_update'] = $id_jadwal;
        header("Location: index.php?success=true&msg=$msg");
      } else {
        $msg = "Jadwal gagal diubah" . mysqli_error($conn);
        header("Location: ubah-jadwal.php?success=false&msg=$msg");
      }
    }
  }
}

?>