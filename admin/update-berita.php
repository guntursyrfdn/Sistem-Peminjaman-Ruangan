<?php
session_start();
require "../connection/conn.php";

if (isset($_POST['ubah_berita'])) {
    $id_berita = $_POST['id_berita'];
    $gambar = $_FILES['gambar']['name'];
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];
    $hari = $_POST['hari'];
    $isi = $_POST['isi'];
    $sumber = $_POST['sumber'];
    $gambar_old = $_POST['gambar_old'];

    // var_dump($gambar, $tanggal, $hari, $judul, $isi, $sumber, $gambar_old);
    // die;

    if ($gambar == "") {
        $gambar = $gambar_old;
    } else {
        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg'); //ekstensi file gambar yang bisa diupload 
        $x = explode('.', $gambar); //memisahkan nama file dengan ekstensi yang diupload
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $nama_gambar_baru = $gambar;

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru); //memindah file gambar ke folder gambar
        } else {
            $msg = "Ekstensi gambar yang boleh hanya jpg, png, atau jpeg" . mysqli_error($conn);
            header("Location: ubah-berita.php?success=false&msg=$msg");
            exit;
        }
    }
    $query = "UPDATE berita SET `judul`='$judul',`gambar`='$gambar',`tanggal`='$tanggal',`hari`='$hari',`isi`='$isi',`sumber`='$sumber' WHERE id_berita= '$id_berita'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $msg = "Berita Berhasil Diubah";
        header("Location: berita.php?success=true&msg=$msg");
        exit;
    } else {
        $msg = "Berita Gagal Diubah" . mysqli_error($conn);
        header("Location: berita.php?success=false&msg=$msg");
        exit;
    }
    // var_dump($gambar, $tanggal, $hari, $judul, $isi, $sumber);
    // die;
}
