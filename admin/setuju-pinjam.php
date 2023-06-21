<?php
require 'functions-admin.php';
$koneksi = koneksi();
$id = $_GET["id"];

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
}

$query = "SELECT * FROM peminjaman INNER JOIN stok_barang ON peminjaman.id_produk=stok_barang.id_produk INNER JOIN user ON peminjaman.id_user=user.id_user WHERE id_pinjam ='$id'";

$sql = $koneksi->query($query);
$tampil = $sql->fetch_assoc();

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
      <h1 class="h3 mb-0 text-gray-800">Form Persetujuan peminjaman</h1>
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
              <input type="hidden" name="id_pinjam" value="<?= $id; ?>">
              <input type="hidden" name="jumlah_barang" value="<?= $tampil['jumlah_barang']; ?>">
              <input type="hidden" name="id_produk" value="<?= $tampil['id_produk']; ?>">
              <div class="mb-3">
                <label for="exampleInputName1" class="form-label">Nama Barang</label>
                <input type="nama" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" name="nama_barang" readonly value="<?= $tampil['nama_barang']; ?>">
              </div>
              <div class="mb-3">
                <label for="exampleInputjumlah1" class="form-label">Jumlah Barang Yang Dipinjam</label>
                <input type="jumlah" class="form-control" id="exampleInputjumlah1" aria-describedby="jumlahHelp" name="jumlah_pinjam" required value="<?= $tampil['jumlah_pinjam']; ?>">
              </div>
              <div class="mb-3">
                <label for="exampleInputUser" class="form-label">UKM Peminjam</label>
                <input type="nama" class="form-control" id="exampleInputUser" aria-describedby="userHelp" name="nama" readonly autocomplete="false" value="<?= $tampil['nama']; ?>">
              </div>
              <div class="mb-3">
                <label for="exampleInputTangal" class="form-label">Tanggal Pinjam</label>
                <input type="text" class="form-control" id="exampleInputTangal" aria-describedby="dateHelp" name="tanggal_pinjam" required value="<?= $tampil['tanggal_pinjam']; ?>" readonly>
              </div>
              <div class="mb-3">
                <label for="exampleInputStatus" class="form-label">Status</label>
                <input type="text" class="form-control" readonly value="<?= $tampil['status']; ?>" name="status">
              </div>
              <button type="submit" class="btn btn-primary" name="simpan">Setujui Peminjaman</button>
              <button type="submit" class="btn btn-danger" name="tolak">Tolak Peminjaman</button>
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

    $noAcc = $_POST['status'];
    $isAcc = 'Sudah Terproses';
    $id = $_POST['id_pinjam'];
    $idProduk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah_barang'];
    $pinjam = $_POST['jumlah_pinjam'];
    $total = $jumlah - $pinjam;

    // udah diproses blom
    if ($noAcc != $isAcc) {

      $update = $koneksi->query("UPDATE peminjaman SET `status`='$isAcc' WHERE id_pinjam='$id' ");
      $total = $koneksi->query("UPDATE stok_barang SET jumlah_barang='$total' WHERE id_produk=$idProduk");

      echo "
            <script>
              alert('Approval Berhasil');
              document.location.href = 'daftar-pinjam.php';
            </script>
          ";
    } else {
      echo "
            <script>
              alert('Approval hanya boleh dilakukan sekali');
              document.location.href = 'daftar-pinjam.php';
            </script>
          ";
    }
  }

  if (isset($_POST["tolak"])) {
    $decline = 'Peminjaman Ditolak';
    $id = $_POST['id_pinjam'];
    $tolak = $koneksi->query("UPDATE peminjaman SET `status`='$decline' WHERE id_pinjam='$id'");
    echo "
          <script>
              alert('Peminjaman berhasil Ditolak');
              document.location.href ='daftar-pinjam.php';
          </script>
    ";
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