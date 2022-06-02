<?php
include('koneksi.php');
$sql = "SELECT tbl_mobil.id_mobil, tbl_mobil.no_polisi FROM tbl_mobil 
		WHERE no_polisi LIKE '%".@$_GET['q']."%' AND status='Mobil Akan Dirental'
		LIMIT 5"; 
 	
$result = $mysqli->query($sql);
$json[] = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['id_mobil'], 'text'=>$row['no_polisi']];
}

echo json_encode($json);