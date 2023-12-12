<?php

$act = $_POST['act'];
$user_id = $_POST['id_user'];

include_once "../koneksi.php";

function getLastRecordbyUserId($userId, $conn){
    $sql = "SELECT * FROM data_record ORDER BY id_record DESC LIMIT 1";
    $result = mysqli_query($conn, $sql );
    $row = mysqli_fetch_row($result);
    return $row['id_record'];
}


if ($act == 'new') {
    $sql = "INSERT INTO data_record (id_user, berat_pukulan, kecepatan_pukulan, jarak, kategori) VALUES ('" . $user_id . "', 0.0, 0.0, 0.0, 'Waiting')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Success";
        // header("Location: ../index.php");
        exit();
    } else {
        echo "Error updating record: " . $koneksi->error;
    }

}elseif($act == 'cancel'){

    $sql = "SELECT * FROM data_record  WHERE id_user = '".$user_id."' ORDER BY id_record DESC LIMIT 1";
    $result = mysqli_query($koneksi, $sql );
    $row = mysqli_fetch_assoc($result);
    
    $cancelId = $row['id_record'];

    $sql = "DELETE FROM data_record WHERE id_record=" . $cancelId;
    if ($koneksi->query($sql) === TRUE) {
        echo "Success";
    }else{
        echo "Error deleting record: " . $koneksi->error;
    }
    
}elseif($act == 'add'){

    $kategori = 'OK';
    $sql = "SELECT * FROM data_record ORDER BY id_record DESC LIMIT 1";
    $result = mysqli_query($koneksi, $sql );
    $row = mysqli_fetch_assoc($result);
    
    $addId = $row['id_record'];
    
    $sql = "UPDATE data_recode SET berat_pukulan= ".$_POST['berat']. ", kecepatan_pukulan= ".$_POST['kecepatan']. ", jarak= " .$_POST['jarak']. ", kategori=".$kategori ." WHERE id_record=".$addId;
    if ($koneksi->query($sql) === TRUE) {
        echo "Success";
    }else{
        echo "Error update record: " . $koneksi->error;
    }
}



$koneksi->close();
