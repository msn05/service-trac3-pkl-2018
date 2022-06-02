<?php
require_once 'koneksi.php';
require_once 'assets/libs/PHPExcel-1.8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator('MSN')
             ->setLastModifiedBy('MSN')
             ->setTitle("Data Mekanik")
             ->setSubject("Mekanik")
             ->setDescription("Laporan Semua Data Mekanik")
             ->setKeywords("Data Mekanik");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
  'font' => array('bold' => true), // Set font nya jadi bold
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
  'alignment' => array(
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "DATA Mekanik"); // Set kolom A1 dengan tulisan "DATA SISWA"
$objPHPExcel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai F1
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

// Buat header tabel nya pada baris ke 3
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', "Kode Mekanik"); // Set kolom B3 dengan tulisan "NIS"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Mekanik"); // Set kolom C3 dengan tulisan "NAMA"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', "Nomor Telephone"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', "Alamat Email"); // Set kolom E3 dengan tulisan "TELEPON"

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);

// Set height baris ke 1, 2 dan 3
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
$tampil=$mysqli->query("SELECT * FROM tbl_mekanik");

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while($data = mysqli_fetch_array($tampil)){ // Ambil semua data dari hasil eksekusi $sql
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['id_mnk']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nama_mnk']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['no_telephone']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['alamat_mnk']);
  
  // Khusus untuk no telepon. kita set type kolom nya jadi STRING
  
  
  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
  
  $objPHPExcel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
  
  $no++; // Tambah 1 setiap kali looping
  $numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40); // Set width kolom E

// Set orientasi kertas jadi LANDSCAPE
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$objPHPExcel->getActiveSheet(0)->setTitle("Laporan Data Mekanik");
$objPHPExcel->setActiveSheetIndex(0);

// Proses file excel
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="Data KMekanik.xls"');
    
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');

?>