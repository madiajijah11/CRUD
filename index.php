<?php
require "control.php";

$sql = mysqli_query($link, "SELECT * FROM penjualan ORDER BY id_barang DESC");
if (isset($_POST['searchpenjualan'])) {
  $sql = caripenjualan($_POST['caripenjualan']);
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
    <h1 class="mt-4">Data Penjualan</h1>
    <div class="card mb-4">
      <form method="post">
        <div class="input-group px-2 py-2 float-end">
          <input class="form-control w-auto mx-2" type="search" name="caripenjualan" placeholder="Cari">
          <div class="btn-group">
            <button class="btn btn-warning" type="submit" name="searchpenjualan">Cari</button>
            <a href="index.php" class="btn btn-danger">Reset</a>
            <a href="tambah-data-penjualan.php" class="btn btn-primary">Tambah Data</a>
            <a href="printall-penjualan.php" class="btn btn-success" target="_blank">Print Semua</a>
          </div>
        </div>
      </form>
      <div class="card-body table-responsive">
        <table class="table table-hover table-bordered">
          <thead>
            <tr>
              <th>Nomor</th>
              <th>Nama Barang</th>
              <th>Satuan</th>
              <th>Harga persatuan</th>
              <th>Jumlah Barang</th>
              <th>Total Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($sql as $row) : ?>
              <tr>
                <td><?= $no++; ?>.</td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= $row['satuan']; ?></td>
                <td>Rp. <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= $row['jumlah']; ?></td>
                <td>Rp. <?= number_format($row['total'], 0, ',', '.'); ?></td>
                <td>
                  <div class="">
                    <a href="edit-data-penjualan.php?id_barang=<?= $row['id_barang']; ?>" class="btn btn-warning">Edit</a>
                    <a href="hapus-data-penjualan.php?id_barang=<?= $row['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    <a href="print-penjualan.php?id_barang=<?= $row['id_barang']; ?>" class="btn btn-success" target="_blank">Print</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" charset="utf-8"></script>
</body>
</html>
