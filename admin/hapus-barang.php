<?php
require 'functions-admin.php';

$id = $_GET["id"];

if (hapusBarang($id) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'daftar-barang.php';
		</script>
	";
} else {
  echo "
		<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'daftar-barang.php';
		</script>
	";
}
