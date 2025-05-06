<?php
session_start();
require "../connection/conn.php";
$penanggung_jawab_ruangan = $_SESSION['user']['nip'];
$tanggal_hari_ini = date("Y-m-d");
if (isset($_POST['tambah_jadwal'])) {
  $id_jadwal = $_POST['id_jadwal'];
  $ruangan = $_POST['ruangan'];
  $tanggal = $_POST['tanggal'];
  $hari = $_POST['hari'];
  $jam_mulai = $_POST['jam_mulai'];
  $jam_selesai = $_POST['jam_selesai'];
  $acara = strtoupper($_POST['acara']);
  $keterangan = $_POST['keterangan'];
  $penanggung_jawab = $penanggung_jawab_ruangan;
  $dinas_peminjam = $_POST['dinas_peminjam'];
  $telepon = $_POST['telepon'];

  // var_dump($ruangan, $tanggal, $hari, $jam_mulai, $jam_selesai, $acara, $keterangan, $penanggung_jawab, $dinas_peminjam, $telepon);
  // die;

  if (($jam_mulai >= $jam_selesai) && ($tanggal < $tanggal_hari_ini)) {
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
    $check_query = "SELECT * FROM jadwal WHERE ruangan = '$ruangan' AND tanggal = '$tanggal' AND ((jam_mulai <= '$jam_mulai' AND jam_selesai > '$jam_mulai') OR (jam_mulai < '$jam_selesai' AND jam_selesai > '$jam_selesai'))";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
      $msg = "Ruangan Sedang Digunakan, Mohon Cari Jam atau Hari Lain.";
      header("Location: tambah-jadwal.php?success=false&msg=$msg");
      exit;
    } else {
      $query = "INSERT INTO jadwal (id_jadwal, ruangan, tanggal, hari, jam_mulai, jam_selesai, acara, keterangan, penanggung_jawab,dinas_peminjam, telepon) VALUES ('$id_jadwal', '$ruangan', '$tanggal', '$hari', '$jam_mulai', '$jam_selesai', '$acara', '$keterangan', '$penanggung_jawab','$dinas_peminjam', '$telepon')";
      $result = mysqli_query($conn, $query);
      if ($result) {
        $msg = "Jadwal Berhasil Dibuat";
        header("Location: index.php?success=true&msg=$msg");
        exit;
      } else {
        $msg = "Jadwal Gagal Dibuat" . mysqli_error($conn);
        header("Location: index.php?success=false&msg=$msg");
        echo "Error: " . mysqli_error($conn);
        exit;
      }
    }
  }
}
?>