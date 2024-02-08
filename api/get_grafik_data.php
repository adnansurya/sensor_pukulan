<?php

include_once '../koneksi.php';



function convertMysqlDateTimeToUnixTimeStamp($oldDate) {
    $date= date('Y-m-d H:i:s', strtotime($oldDate. ' -7 hours'));
    $yr=strval(substr($date,0,4));
    $mo=strval(substr($date,5,2));
    $da=strval(substr($date,8,2));
    $hr=strval(substr($date,11,2));
    $mi=strval(substr($date,14,2));
    $se=strval(substr($date,17,2));
    return mktime($hr,$mi,$se,$mo,$da,$yr);
}

$sql_filter = "";

if (isset($_GET['id_user'])) {
    $sql_filter = " AND user.id_user=" . $_GET['id_user'];
}

$sql = "SELECT data_record.*, user.nama FROM data_record INNER JOIN user ON data_record.id_user=user.id_user WHERE data_record.kategori != 'Waiting'" . $sql_filter;


// echo $sql;
$result = $koneksi->query($sql);

$rows = array();
$nomor = 0;
while($r = mysqli_fetch_assoc($result)) {
    $nomor++;
    $r['nomor'] = $nomor;
    $r['timestamp'] = convertMysqlDateTimeToUnixTimeStamp($r['waktu']);
    $rows[] = $r;
}
// $rows = $result->fetch_assoc();

echo json_encode($rows);


?>