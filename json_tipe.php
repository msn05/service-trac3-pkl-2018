<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_trac');
$sql = "SELECT merk_b.id_tipe, merk_b.tipe FROM merk_b 
		WHERE tipe LIKE '%".$_GET['q']."%'
		LIMIT 5"; 

$result = $mysqli->query($sql);
$json = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['id_tipe'], 'text'=>$row['tipe']];
}

echo json_encode($json);