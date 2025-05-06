<?php
session_start();
if (!isset($_SESSION['user'])) {
  $msg = "<p class='alert alert-warning'>Harap Login Terlebih Dahulu</p>";
  header("Location: ../login.php?msg=$msg");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SB Admin 2 - Cards</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet" />
  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for modal -->
  <link rel="stylesheet" href="../css/modal.css">
  <!-- Chart -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <!-- CKEditor -->
  <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
  <!-- modal -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Check if the success parameter is set to true
      var urlParams = new URLSearchParams(window.location.search);
      var successParam = urlParams.get('success');

      if (successParam === 'true') {
        // Show success modal
        $('#statusSuccessModal').modal('show');
      } else if (successParam === 'false') {
        // Show error modal
        $('#statusErrorsModal').modal('show');
      }
    });
  </script>
  <?php if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
  }
  ?>
</head>

<body id="page-top">
  <!-- Sidebar -->
  <?php
  require "nav.php"
    ?>
  <!-- End of Topbar -->
  <div id="content" class="pb-3">
    <!-- Begin Page Content -->
    <div class="container-fluid">