<?php
require('../../fpdf185/fpdf.php');
include('../../config/database.php');

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'LAPORAN DATA UMKM LOKAL',0,1,'C');
$pdf->Ln(5);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,10,'No',1,0,'C');
$pdf->Cell(80,10,'Kategori',1,0,'C');
$pdf->Cell(40,10,'Jumlah UMKM',1,1,'C');

$query = mysqli_query($koneksi, "
  SELECT kategori.nama_kategori, COUNT(umkm.id_umkm) AS total_umkm
  FROM kategori
  LEFT JOIN umkm ON kategori.id_kategori = umkm.id_kategori
  GROUP BY kategori.id_kategori
");

$no = 1;
$pdf->SetFont('Arial','',12);
while($row = mysqli_fetch_assoc($query)) {
  $pdf->Cell(10,10,$no++,1,0,'C');
  $pdf->Cell(80,10,$row['nama_kategori'],1,0);
  $pdf->Cell(40,10,$row['total_umkm'],1,1,'C');
}

$pdf->Output();
?>
