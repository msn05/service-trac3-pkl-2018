<?php
include('koneksi.php');
$sql = "SELECT kustom.kustom_id, kustom.kustom_nama FROM kustom 
		WHERE kustom_nama  LIKE '%".@$_GET['q']."%' AND status='Perusahaan'
		LIMIT 5"; 

$result = $mysqli->query($sql);
$json[] = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['kustom_id'], 'text'=>$row['kustom_nama']];
}

echo json_encode($json);