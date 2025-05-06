<?php
require "../connection/conn.php";
$id_jadwal = $_GET['id_jadwal'];

$query = mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal'");
if ($query == 'true') {
    $msg = "jadwal berhasil dihapus";
    header("Location: jadwal.php?success=true&msg=$msg");
} else {
    $msg = "jadwal gagal dihapus" . mysqli_error($conn);
    header("Location: jadwal.php?success=false&msg=$msg");
}