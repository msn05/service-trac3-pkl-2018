<?php
include('koneksi.php');
$sql = "SELECT data_karyawan.id,data_karyawan.karyawan FROM data_karyawan 
		WHERE karyawan LIKE '%".@$_GET['q']."%'
		LIMIT 5"; 

$result = $mysqli->query($sql);
$json = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['id'], 'text'=>$row['karyawan']];
}

echo json_encode($json);