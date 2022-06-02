<?php
include('koneksi.php');
$sql = "SELECT tbl_sparepart.id_sp, tbl_sparepart.nama_sp FROM tbl_sparepart WHERE nama_sp LIKE '%".@$_GET['q']."%'
		LIMIT 5"; 

$result = $mysqli->query($sql);
$json[] = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['id_sp'], 'text'=>$row['nama_sp']];
}

echo json_encode($json);