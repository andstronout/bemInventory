<?php
require 'functions-admin.php';

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

</head>

<body id="page-top">

  <?php include("../layout/sidebar.php"); ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Daftar Barang Inventaris</h1>
      <div class="my-2"></div>
      <a href="tambah-barang.php" class="btn btn-info btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-info-circle"></i>
        </span>
        <span class="text">Tambah Data Barang</span>
      </a>
    </div>

    <!-- Content Row -->
    <div class="row">
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="data-Table" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Masuk</th>
                    <th width=20%>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = mysqli_query($koneksi, "SELECT * FROM stok_barang");
                  $no = 1;
                  while ($data = mysqli_fetch_assoc($sql)) {
                  ?>
                    <tr>
                      <td><?= $no++; ?></td>
                      <td><?= $data['nama_barang']; ?></td>
                      <td><?= $data['jumlah_barang']; ?></td>
                      <td><?= $data['tanggal_masuk']; ?></td>
                      <td>
                        <a href="edit-barang.php?id=<?= $data['id_produk']; ?>" class="btn btn-info btn-icon-split btn-sm">
                          <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                          </span>
                          <span class="text">Edit</span>
                        </a>
                        <a href="hapus-barang.php?id=<?= $data['id_produk']; ?>" class="btn btn-danger btn-icon-split btn-sm">
                          <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                          </span>
                          <span class="text">Hapus</span>
                        </a>
                      </td>
                    <?php } ?>
                    </tr>
                    </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
    </div>

  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

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