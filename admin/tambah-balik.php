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
              <div class="mb-3">
                <label for="select-barang" class="form-label">Nama Barang</label>
                <select class="form-select" aria-label=".form-select-lg example" id="select-barang" placeholder="Pick a state..." name="id_p">
                  <option value="">-- Pilih Barang --</option>
                  <?php
                  $sq = $koneksi->query("select * from stok_barang");
                  while ($data = $sq->fetch_assoc()) {
                    echo "<option value='$data[id_produk]'>$data[nama_barang]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputjumlah1" class="form-label">Jumlah Barang Yang Dipinjam</label>
                <input type="jumlah" class="form-control" id="exampleInputjumlah1" aria-describedby="jumlahHelp" name="jumlah_pinjam" required>
              </div>
              <div class="mb-3">
                <label for="select-user" class="form-label">UKM Peminjam</label>
                <select class="form-select" aria-label=".form-select-lg example" id="select-user" placeholder="Pick a state..." name="id_u">
                  <option value="">-- Pilih Nama UKM --</option>
                  <?php

                  $sq = $koneksi->query("select * from user");
                  while ($data = $sq->fetch_assoc()) {
                    echo "<option value='$data[id_user]'>$data[nama]</option>";
                  }
                  ?>

                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputTangal" class="form-label">Tanggal Pinjam</label>
                <input type="date" class="form-control" id="exampleInputTangal" aria-describedby="dateHelp" name="tanggal_pinjam" required>
              </div>
              <input type="hidden" name="status" value="Belum Diproses">
              <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
            </form>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
    </div>

  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <?php
  if (isset($_POST["simpan"])) {
    $status = 'Belum Terproses';

    if ($data['jumlah_barang'] > 0) {
      $s = mysqli_query($koneksi, "INSERT INTO peminjaman 
    (id_produk,id_user,jumlah_pinjam,tanggal_pinjam,`status`) VALUES 
    ('$_POST[id_p]','$_POST[id_u]','$_POST[jumlah_pinjam]','$_POST[tanggal_pinjam]','$status')")
        or die(mysqli_error($koneksi));

      echo "
      <script>
        alert('data berhasil diubah!');
        document.location.href = 'daftar-pinjam.php';
      </script>
    ";
    } else {
      echo "
      <script>
        alert('Barang Kosong!');
        document.location.href = 'daftar-pinjam.php';
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