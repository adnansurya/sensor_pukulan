<?php
include_once '../koneksi.php';

$table = $_GET['table'];
$col= $_GET['col'];
$id = $_GET['id'];

$sql = "SELECT * FROM ".$table." WHERE ".$col."=".$id;
$result = $koneksi->query($sql);
$data = $result->fetch_assoc();

echo json_encode($data);

?>