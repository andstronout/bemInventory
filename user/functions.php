<?php
function koneksi()
{
  $conn = mysqli_connect('localhost', 'root', '', 'bem') or die('Koneksi ke DB GAGAL!');

  return $conn;
}

// function login()
// {
//   $conn = koneksi();
//   // ambil data loginnya 
//   $username = htmlspecialchars('email');
//   $password = htmlspecialchars('password');

//   // ambil data user dari database
//   $query = $conn->query("SELECT * FROM user");
//   $hasil = $query->fetch_assoc();

//   if ($username == $hasil['email'] && $password == $hasil['password']) {
//     $_POST['login'] = true;
//     // header("location: index.php");
//   }
  // else {
  //   return [
  //     'error' => true,
  //     'pesan' => 'Email / Password Salah!'
  //   ];
  // }
// }
