<?php
function koneksi()
{
  $conn = mysqli_connect('localhost', 'root', '', 'bem') or die('Koneksi ke DB GAGAL!');

  return $conn;
}
