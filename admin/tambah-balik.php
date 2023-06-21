<?php

require 'functions-admin.php';
$koneksi = koneksi();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
}



?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard Admin</title>

  <!-- Custom fonts for this template-->
  <link href="../sbAdmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../sbAdmin/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../sbAdmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Bootstrap Link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body id="page-top">

  <?php include("../layout/sidebar.php"); ?>

  <?php
  $s = $_POST['id_pinjam'];
  $x = explode('-', $s, 2);
  $id = $x[1];

  $query = $koneksi->query("SELECT * FROM peminjaman INNER JOIN stok_barang ON peminjaman.id_produk=stok_barang.id_produk INNER JOIN user ON peminjaman.id_user=user.id_user WHERE id_pinjam='$id'");
  $row = $query->fetch_array();



  ?>
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Form Pengembalian Barang</h1>
      <div class="my-2"></div>
    </div>

    <!-- Content Row -->
    <div class="row">
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-body">
            <form method="POST">
              <input type="hidden" value="<?= $row['id_pinjam']; ?>" name="id_pinjam">
              <input type="hidden" value="<?= $row['id_produk']; ?>" name="id_produk">
              <input type="hidden" value="<?= $row['jumlah_barang']; ?>" name="jumlah_barang">
              <div class="mb-3">

                <label for="select-barang" class="form-label">Nama Barang</label>
                <input type="nama_barang" class="form-control" id="exampleInputjumlah1" aria-describedby="jumlahHelp" value="<?= $row['nama_barang']; ?>" name="nama_barang" readonly>
              </div>
              <div class="mb-3">
                <label for="exampleInputjumlah1" class="form-label">Jumlah Barang Yang Dipinjam</label>
                <input type="jumlah" class="form-control" id="exampleInputjumlah1" aria-describedby="jumlahHelp" value="<?= $row['jumlah_pinjam']; ?>" name="jumlah_balik" readonly>
              </div>
              <div class="mb-3">
                <label for="select-user" class="form-label">UKM Peminjam</label>
                <input type="text" class="form-control" value="<?= $row['nama']; ?>" name="nama" readonly>
              </div>
              <div class="mb-3">
                <label for="exampleInputTangal" class="form-label">Tanggal Pinjam</label>
                <input type="text" class="form-control" value="<?= $row['tanggal_pinjam']; ?>" name="tanggal_balik" readonly>
              </div>
              <button type="submit" class="btn btn-success col-2 " name="simpan">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

  <?php
  $cek = $_POST['id_pinjam'];
  $t = time();
  $time = date("Y-m-d", $t);
  $pinjam = $koneksi->query("select * from pengembalian where id_pinjam='$cek'");
  while ($hpinjam = $pinjam->fetch_array()) {
    $hasil = $hpinjam;
  }

  if (isset($_POST['simpan'])) {
    $jumlahBarang = $_POST['jumlah_barang'];
    $totalJumlah = $jumlahBarang + $_POST['jumlah_balik'];
    $id = $_POST['id_produk'];

    // cek udah di input blum
    if ($cek !== $hasil['id_pinjam']) {

      $tambah = $koneksi->query("INSERT INTO pengembalian (id_pinjam,jumlah_balik,tanggal_balik) VALUES ('$_POST[id_pinjam]','$_POST[jumlah_balik]','$time')") or die($koneksi->connect_error);
      $jumlah = $koneksi->query("UPDATE stok_barang SET jumlah_barang='$totalJumlah' WHERE id_produk='$id'") or die($koneksi->connect_error);

      echo "
      <script>
        alert('data berhasil diubah!');
        document.location.href = 'daftar-balik.php';
      </script>
    ";
    } else {
      echo "
        <script>
          alert('data gagal diubah!');
          document.location.href = 'daftar-balik.php';
        </script>
      ";
    }
  }

  ?>

  <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; BEM Insan Pembangunan 2023</span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="../sbAdmin/vendor/jquery/jquery.min.js"></script>
  <script src="../sbAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../sbAdmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../sbAdmin/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../sbAdmin/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../sbAdmin/js/demo/chart-area-demo.js"></script>
  <script src="../sbAdmin/js/demo/chart-pie-demo.js"></script>

  <!-- Page level plugins -->
  <script src="../sbAdmin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../sbAdmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../sbAdmin/js/demo/datatables-demo.js"></script>

</body>

</html>