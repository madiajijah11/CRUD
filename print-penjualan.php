<?php
include "tcpdf/tcpdf.php";

date_default_timezone_set("Asia/Makassar");

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

  //Page header
  public function Header()
  {
    // Logo
    $image_file = 'dist/assets/img/' . 'logobri.png';
    $this->Image($image_file, 10, 10, 35, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Set font
    $this->SetFont('helvetica', 'B', 14);
    // Title
    $this->SetX(50);
    $this->Cell(0, 15, 'Banjarmasin', 0, false, 'L', 0, '', 0, false, 'M', 'M');
    $this->ln(1);
    $this->SetX(50);
    $this->SetFont('helvetica', 'B', 10);
    $this->Cell(0, 15, 'Penjualan Saipur Rahman', 0, false, 'L', 0, '', 0, false, 'T', 'M');
    $this->ln(5);
    $this->SetX(50);
    $this->SetFont('helvetica', 'B', 10);
    $this->Cell(0, 15, '', 0, false, 'L', 0, '', 0, false, 'T', 'M');
    $this->ln(5);
  }

  // Page footer
  public function Footer()
  {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Saipur Rahman');
$pdf->SetTitle('Penjualan');
$pdf->SetSubject('Penjualan');
$pdf->SetKeywords('Penjualan');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->Cell(0, 0.7, '==========================================================================================', 0, 0, 'C');
$pdf->ln(10);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 0.7, 'Laporan Penjualan', 0, 0, 'C');
$pdf->ln(10);
$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->Cell(50, 10, "Print pada : " . date("d/m/Y"), 0, 0, 'C');
$pdf->ln(10);

// Set some content to print
$tbl_header = '
<table style="width: 100%; font-family: arial, sans-serif; border-collapse: collapse;" border="1" cellpadding="2" cellspacing="2">
<thead>
<tr style="text-align: center;">
<th>Nomor</th>
<th colspan="2">Nama Barang</th>
<th colspan="2">Satuan</th>
<th colspan="2">Harga</th>
<th colspan="2">Jumlah</th>
<th colspan="2">Total</th>
</tr>
</thead>
<tbody>';
$tbl_footer = '
</tbody>
</table>';
$tbl = '';

$con = mysqli_connect("localhost", "root", "", "crud");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id_barang = $_GET['id_barang'] ? $_GET['id_barang'] : "";
$result = mysqli_query($con, "SELECT * FROM penjualan WHERE id_barang='$id_barang'");
$no = 0;
while ($row = mysqli_fetch_array($result)) {
  $nama_barang = $row['nama_barang'];
  $satuan = $row['satuan'];
  $harga = $row['harga'];
  $jumlah = $row['jumlah'];
  $total = $row['total'];
  $no++;

  $tbl .= '<tr style="text-align: left;">
  <td style="text-align: center;">' . $no . '</td>
  <td colspan="2">' . $row['nama_barang'] . '</td>
  <td colspan="2">' . $row['satuan'] . '</td>
  <td colspan="2">Rp.' . number_format($row['harga'], 0, ',', '.') . '</td>
  <td colspan="2">' . $row['jumlah'] . '</td>
  <td colspan="2">' . number_format($row['total'], 0, ',', '.') . '</td>
  </tr>';
}

// Print text using writeHTMLCell()
$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('1by1-penjualan.pdf', 'I');
