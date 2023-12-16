<?php

include_once "../koneksi.php";

$kategori = 'OK';
$sql = "SELECT * FROM data_record ORDER BY id_record DESC LIMIT 1";
$result = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($result);

$batasBeratBawah = 200;
$batasBeratAtas = 400;

$addId = $row['id_record'];

if ($row['kategori'] != 'Waiting') {
    echo "Database not standby";
} else {

    $berat_tinju = floatval($_POST["berat"]);

    if($berat_tinju < $batasBeratBawah){
        $kategori = 'Lemah';
    }elseif($berat_tinju >= $batasBeratBawah && $berat_tinju < $batasBeratAtas){
        $kategori = 'Sedang';
    }elseif($berat_tinju >= $batasBeratAtas){
        $kategori = 'Kuat';
    }
    $sql = "UPDATE data_record SET berat_pukulan= " . $_POST["berat"] . ", kecepatan_pukulan= " . $_POST["kecepatan"] . ", jarak= " . $_POST["jarak"] . ", kategori='" . $kategori . "' WHERE id_record=" . $addId;
    if ($koneksi->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error update record: " . $koneksi->error;
    }
}
