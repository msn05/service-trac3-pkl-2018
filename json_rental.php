<?php
include('koneksi.php');
$sql = "SELECT tbl_oren.id_rental,tbl_oren.id_rental FROM tbl_oren 
		WHERE id_rental LIKE '%".@$_GET['q']."%'
		LIMIT 5"; 

$result = $mysqli->query($sql);
$json = [];
while($row = $result->fetch_assoc()){
      $json[] = ['id'=>$row['id_rental'], 'text'=>$row['id_rental']];
}

echo json_encode($json);