<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'crud');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link->connect_error) {
  die("Connection failed: " . $link->connect_error);
}

function tambahdatapenjualan($data)
{
  global $link;
  $nama_barang = htmlspecialchars($data['nama_barang']);
  $satuan = htmlspecialchars($data['satuan']);
  $harga = htmlspecialchars($data['harga']);
  $jumlah = htmlspecialchars($data['jumlah']);
  $total = $harga * $jumlah;

  $query = "INSERT INTO penjualan (nama_barang,satuan,harga,jumlah,total) VALUES ('$nama_barang','$satuan','$harga','$jumlah','$total')";
  mysqli_query($link, $query);
  return mysqli_affected_rows($link);
}

function editdatapenjualan($data)
{
  global $link;
  $id_barang = $_GET['id_barang'];
  $nama_barang = htmlspecialchars($data['nama_barang']);
  $satuan = htmlspecialchars($data['satuan']);
  $harga = htmlspecialchars($data['harga']);
  $jumlah = htmlspecialchars($data['jumlah']);
  $total = $harga * $jumlah;

  $query = "UPDATE penjualan SET nama_barang='$nama_barang', satuan='$satuan', harga='$harga', jumlah='$jumlah', total='$total' WHERE id_barang='$id_barang'";
  mysqli_query($link, $query);
  return mysqli_affected_rows($link);
}

function query($query)
{
  global $link;
  $result = mysqli_query($link, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function caripenjualan($search)
{
  $query = "SELECT * FROM penjualan WHERE nama_barang LIKE '%$search%' OR satuan LIKE '%$search%' OR harga LIKE '%$search%' OR jumlah LIKE '%$search%' OR total LIKE '%$search%'";
  return query($query);
}

?>
