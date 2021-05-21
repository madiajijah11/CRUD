<?php

require 'control.php';

$id_barang = $_GET['id_barang'] ? $_GET['id_barang'] : "";
$sql = mysqli_query($link, "SELECT * FROM penjualan WHERE id_barang='$id_barang'");
$row = mysqli_fetch_array($sql);

if (isset($_POST['editpenjualan'])) {
  if (editdatapenjualan($_POST) > 0) {
    echo "<script>
    alert('Edit data berhasil');
    window.location.href='index.php';
    </script>";
  } else {
    echo "<script>
    alert('Edit data gagal');
    window.location.href='edit-data-penjualan.php';
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
    <h1 class="mt-4">Edit Penjualan</h1>
    <div class="card">
      <div class="card-header">Edit Data
      </div>
      <div class="card-body">
        <form action="" method="post" role="form">
          <input type="hidden" name="id_barang" id="id_barang" value="<?= $row['id_barang'] ?>">

          <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" placeholder="e.g Apple" required="required" value="<?= $row['nama_barang'] ?>">
          </div>

          <div class="form-group row-cols-lg-5">
            <label for="satuan">Jumlah Pinjaman</label>
            <select name="satuan" id="" required="required" class="form-control">
              <option selected disabled>Pilih</option>
              <option value="Buah" <?php if(isset($row['satuan']) && ($row['satuan']) == 'Buah') echo 'selected="selected"'; ?>>Buah</option>
              <option value="Pack" <?php if(isset($row['satuan']) && ($row['satuan']) == 'Pack') echo 'selected="selected"'; ?>>Pack</option>
            </select>
          </div>

          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" name="harga" placeholder="e.g 10000" required="required" value="<?= $row['harga'] ?>">
          </div>

          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" placeholder="e.g 50" required="required" value="<?= $row['jumlah'] ?>">
          </div>

          <button type="submit" name="editpenjualan" class="btn btn-primary" onclick="return confirm('Simpan perubahan?')">Edit</button>
          <a href="index.php" class="btn btn-warning" onclick="return confirm('Yakin batal edit?')">Kembali</a>
        </form>
      </div>
    </div>
  </div>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" charset="utf-8"></script>
</body>
</html>
