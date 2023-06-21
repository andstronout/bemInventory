<?php require 'functions-admin.php';
$koneksi = koneksi(); ?>

<form method="POST">
  <div class="mb-3">
    <label for="select-barang" class="form-label">Nama Barang</label>
    <select class="form-select" aria-label=".form-select-lg example" id="select-barang" placeholder="Pick a state..." name="id_produk">
      <option value="">-- Pilih Barang --</option>
      <?php
      $sq = $koneksi->query("select * from stok_barang order by id_produk");
      while ($data = $sq->fetch_assoc()) {
        echo "<option value='$data[id_produk]'>$data[nama_barang]</option>";
      }
      ?>
    </select>
  </div>
  <input type="hidden" name="status" value="Belum Diproses">
  <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
</form>

<?php
if (isset($_POST['simpan'])) {
  echo ($_POST['id_produk']);
}

?>



// $query = mysqli_query($koneksi, "INSERT INTO peminjaman (id_produk,id_user,jumah_pinjam,tanggal_pinjam,`status`) VALUES ($id_produk,$id_user,$jumlah_pinjam,$tanggal_pinjam,$status)"); {
// ?>

// <script type="text/javascript">
  //       alert("Data Pinjam Berhasil Disimpan");
  //       window.location.href = "daftar-pinjam.php";
  //     
</script>
// <?php {
      $sekarang = $data['jumlah_barang'] - $_POST['jumlah_pinjam'];
      $updatestok = mysqli_query($koneksi, "UPDATE peminjaman SET jumlah_barang='$sekarang' WHERE id_produk='$_POST[id_p]'") or die(mysqli_error($koneksi));
    }

// 
    // $sq = mysqli_query($koneksi, "select * from stok_barang");
    // while ($dp = mysqli_fetch_array($sq)) {
    //   $idp = $dp['id_produk'];
    //   $dpm = $dp['nama_barang'];
    //   var_dump($idp, $dpm);
    // }