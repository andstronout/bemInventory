<?php
session_start();
require 'functions.php';
$koneksi = koneksi();


if (isset($_POST['login'])) {
  // ambil data login
  $email = $_POST['email'];
  $password = $_POST['password'];


  // ambil data di database
  $query = $koneksi->query("SELECT * FROM user WHERE email='$email' AND `password`='$password'") or die(mysqli_error($koneksi));
  $hasil = $query->fetch_assoc();
  $hasilid_user = $hasil['id_user'];
  $hasilnama = $hasil['nama'];
  $hasilEmail = $hasil['email'];
  $hasilPassword = $hasil['password'];

  // coba login

  if ($hasilid_user != NULL) {
    $_SESSION["login"] = true;
    $_SESSION['idu'] = $hasilid_user;
    $_SESSION['nama'] = $hasilnama;
    $_SESSION['email'] = $_POST['email'];
    header("location:index.php");
  } else {
    echo "
      <script>
      alert('Username atau Password Salah!');
      document.location.href ='login.php';
      </script>
      ";
  }
}

if (isset($_SESSION["login"])) {
  header("Location: index.php");
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

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../sbAdmin/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-info">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center py-5 ">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    <form class="user" method="POST">
                      <div class="form-group">
                        <input type="text" name="email" class="form-control form-control-user" id="exampleInputemail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                      </div>
                      <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                      </div>
                      <button class="btn btn-primary btn-user btn-block" name="login">
                        Login
                      </button>
                      <hr>
                    </form>
                  </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>




    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>