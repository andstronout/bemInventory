<?php
session_start();

// koneksi
function koneksi()
{
  $conn = mysqli_connect('localhost', 'root', '', 'bem') or die('Koneksi ke DB GAGAL!');

  return $conn;
}

// login
function login($data)
{
  $email = htmlspecialchars($data['email']);
  $password = htmlspecialchars($data['password']);

  if ($email == 'asd@asd.com' && $password == 'asd') {
    $_SESSION["login"] = true;
    header("location: index.php");
  } else {
    return [
      'error' => true,
      'pesan' => 'Email / Password Salah!'
    ];
  }
}

// ubah user
function ubah($data)
{
  $conn = koneksi();

  $id = $data["id_user"];
  $nama = htmlspecialchars($data["nama"]);
  $email = htmlspecialchars($data["email"]);
  $password = htmlspecialchars($data["password"]);

  $query = "UPDATE user SET
              nama = '$nama',
              email = '$email',
              password = '$password'
            WHERE id_user = $id
           ";

  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

// hapus user

function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");
  return mysqli_affected_rows($conn);
}

// ubah barang
function ubahBarang($data)
{
  $conn = koneksi();

  $id = $data["id_produk"];
  $nama_barang = htmlspecialchars($data["nama_barang"]);
  $jumlah_barang = htmlspecialchars($data["jumlah_barang"]);


  $query = "UPDATE stok_barang SET
              nama_barang = '$nama_barang',
              jumlah_barang = '$jumlah_barang'
            WHERE id_produk = $id
           ";

  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

// hapus barang

function hapusBarang($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM stok_barang WHERE id_produk = $id");
  return mysqli_affected_rows($conn);
}

function accPinjam($data)
{
  $conn = koneksi();
  $id = $data['id_pinjam'];
  $status = htmlspecialchars($data['status']);

  $query = "UPDATE peminjaman SET `status` = '$status'
  WHERE id_pinjam = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}
