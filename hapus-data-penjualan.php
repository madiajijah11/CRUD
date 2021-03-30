<?php
require 'control.php';

$id_barang = $_GET['id_barang'];
$hapus = mysqli_query($link, "DELETE FROM penjualan WHERE id_barang='$id_barang'");

if ($hapus) {
  ?>
  <script>
  alert("Data berhasil dihapus");
  window.location.href = "index.php";
  </script>
  <?php
} else {
  ?>
  <script>
  alert("Data gagal dihapus");
  window.location.href = "index.php";
  </script>
  <?php
}

?>
