<?php
require 'functions-admin.php';

$id = $_GET["id"];

if (hapus($id) > 0) {
  echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'daftar-user.php';
		</script>
	";
} else {
  echo "
		<script>
			alert('data gagal ditambahkan!');
			document.location.href = 'daftar-user.php';
		</script>
	";
}
