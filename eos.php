<?php
require_once 'koneksi.php';
require_once 'assets/libs/PHPExcel-1.8/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator('MSN')
             ->setLastModifiedBy('MSN')
             ->setTitle("Data Servis Sparepart Mobil")
             ->setSubject("Rental Mobil")
             ->setDescription("Laporan Semua Data Servis Sparepart Mobil")
             ->setKeywords("Data Servis Sparepart Mobil");

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

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Data Servis Sparepart Mobil"); // Set kolom A1 dengan tulisan "DATA SISWA"
$objPHPExcel->getActiveSheet()->mergeCells('A1:N1'); // Set Merge Cell pada kolom A1 sampai F1
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

// Buat header tabel nya pada baris ke 3
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', "Kode Servis"); // Set kolom B3 dengan tulisan "NIS"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Karyawan"); // Set kolom C3 dengan tulisan "NAMA"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', "Nama Sparepart"); // Set kolom C3 dengan tulisan "NAMA"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', "Model Sparepart"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', "Harga"); // Set kolom E3 dengan tulisan "TELEPON"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', "Nama Mekanik"); // Set kolom F3 dengan tulisan "ALAMAT"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', "Nama Pelanggan"); // Set kolom F3 dengan tulisan "ALAMAT"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', "Email"); // Set kolom F3 dengan tulisan "ALAMAT"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J3', "Jumlah Barang"); // Set kolom F3 dengan tulisan "ALAMAT"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K3', "Tanggal Order"); // Set kolom F3 dengan tulisan "ALAMAT"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L3', "Total Bayar"); // Set kolom F3 dengan tulisan "ALAMAT"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M3', "Perkiraan Selesai"); // Set kolom F3 dengan tulisan "ALAMAT"
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N3', "Status"); // Set kolom F3 dengan tulisan "ALAMAT"

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
$objPHPExcel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);

// Set height baris ke 1, 2 dan 3
$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa
$tampil=$mysqli->query("SELECT *,tbl_os.status AS status_os FROM tbl_os  INNER JOIN tbl_sparepart ON tbl_sparepart.id_sp = tbl_os.id_sp INNER JOIN kustom ON kustom.kustom_id = tbl_os.kustom_id INNER JOIN tbl_mekanik ON tbl_mekanik.id_mnk = tbl_os.id_mnk inner join users on users.id_karyawan = tbl_os.id_karyawan ORDER BY tbl_os.id_servis");
$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while($data = mysqli_fetch_array($tampil)){ // Ambil semua data dari hasil eksekusi $sql
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['id_servis']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['nama']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['nama_sp']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['model_sp']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, number_format($data['harga'],2,',','.'));
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['nama_mnk']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data['kustom_nama']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data['email']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data['jumlah_b']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['tgl_masuk']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data['total_bayar']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data['perkiraan_selesai']);
  $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data['status']);
  
  // Khusus untuk no telepon. kita set type kolom nya jadi STRING
  
  
  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  $objPHPExcel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
  $objPHPExcel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
  
  $objPHPExcel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
  
  $no++; // Tambah 1 setiap kali looping
  $numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Set width kolom E
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom F
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom F
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom F
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30); // Set width kolom F
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30); // Set width kolom F
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30); // Set width kolom F
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30); // Set width kolom F
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30); // Set width kolom F

// Set orientasi kertas jadi LANDSCAPE
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$objPHPExcel->getActiveSheet(0)->setTitle("Laporan Data Servis Sparepart");
$objPHPExcel->setActiveSheetIndex(0);

// Proses file excel
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="Laporan Data Servis Sparepart.xls"');
    
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');

?>