<?php

require 'control.php';

if (isset($_POST['datapenjualan'])) {
  if (tambahdatapenjualan($_POST) > 0) {
    echo "<script>
    alert('Tambah data berhasil');
    window.location.href='index.php';
    </script>";
  } else {
    echo "<script>
    alert('Tambah data gagal');
    window.location.href='tambah-data-penjualan.php';
    </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Penjualan</title>
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="mt-4">Data penjualan</h1>
    <div class="card">
      <div class="card-header">Tambah Data
      </div>
      <div class="card-body">
        <form action="" method="post" role="form">

          <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" placeholder="e.g Apple" required="required">
          </div>

          <div class="form-group row-cols-lg-5">
            <label for="satuan">Satuan</label>
            <select name="satuan" id="" required="required" class="form-control">
              <option selected disabled>Pilih</option>
              <option value="Buah">Buah</option>
              <option value="Pack">Pack</option>
            </select>
          </div>

          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" name="harga" placeholder="e.g 10000" required="required">
          </div>

          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" placeholder="e.g 50" required="required">
          </div>

          <button type="submit" name="datapenjualan" class="btn btn-primary" onclick="return confirm('Yakin ingin menyimpan?')">Simpan</button>
          <button type="reset" class="btn btn-warning">Clear</button>
          <a href="index.php" class="btn btn-success" onclick="return confirm('Yakin kembali?')">Kembali</a>

        </form>
      </div>
    </div>
  </div>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" charset="utf-8"></script>
</body>
</html>
