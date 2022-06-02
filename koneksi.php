<?php
// error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
// define(DB_HOST, "localhost");
// define(DB_USER, "root");
// define(DB_PASSWORD, "12345678");
// define(DB_DATABASE, "db_trac");

// $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$mysqli = new mysqli('localhost', 'root', '12345678', 'db_trac');


  $semua_halaman = array("hitung", "data_mobil","ubah_oli","ubah_sparepart","ubah_mobil","data_pelanggan","data_mekanik","data_servis","brand","tipek","data_oli","data_sparepart","hos","order_rental","order_sparepart","profile","data_karyawan","pengambilan","pengembalian","hor","data_o","data_or","hos","ho","laporan","pengambilan","pengembalian","data_os","ho","laporan","export_karyawan","emobil","data_orm","data_osp","data_osm"
                        );

  $cek_akses['admin']= array( "hitung", "data_mobil","ubah_oli","ubah_sparepart","ubah_mobil","data_pelanggan","data_mekanik","data_servis","brand","tipek","data_oli","data_sparepart","hos","order_rental","order_sparepart","profile","data_karyawan","pengambilan","pengembalian","hor","data_o","data_or","hos","ho","laporan","pengambilan","pengembalian","data_os","ho","laporan"
                        ,"export_karyawan","emobil","data_orm","data_osp","data_osm");
  $cek_akses['pimpinan']= array( "profile","laporan"
                        );
  
?>