<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_trac');
$sql = "SELECT brandm.id_brand, brandm.brand FROM brandm 
		WHERE brand LIKE '%".$_GET['q']."%'
		LIMIT 5"; 

$result = $mysqli->query($sql);
$json = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['id_brand'], 'text'=>$row['brand']];
}

echo json_encode($json);