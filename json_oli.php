<?php
include('koneksi.php');
$sql = "SELECT tbl_oli.id_oli, tbl_oli.nama_oli FROM tbl_oli 
		WHERE nama_oli LIKE '%".@$_GET['q']."%'
		LIMIT 5"; 

$result = $mysqli->query($sql);
$json[] = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['id_oli'], 'text'=>$row['nama_oli']];
}

echo json_encode($json);