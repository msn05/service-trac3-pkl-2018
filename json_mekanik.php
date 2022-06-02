<?php
include('koneksi.php');
$sql = "SELECT tbl_mekanik.id_mnk, tbl_mekanik.nama_mnk FROM tbl_mekanik WHERE nama_mnk LIKE '%".@$_GET['q']."%'
		LIMIT 5"; 

$result = $mysqli->query($sql);
$json[] = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['id_mnk'], 'text'=>$row['nama_mnk']];
}

echo json_encode($json);