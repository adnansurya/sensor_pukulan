<?php

$act = $_POST['act'];
// $user_id = $_POST['id_user'];

include_once "../koneksi.php";

function getLastRecord($conn)
{
    $sql = "SELECT * FROM data_record ORDER BY id_record DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['id_record'];
}


if ($act == 'new') {
    $sql = "INSERT INTO data_record (id_user, berat_pukulan, kecepatan_pukulan, jarak, kategori) VALUES ('" . $_POST['id_user'] . "', 0.0, 0.0, 0.0, 'Waiting')";

    if ($koneksi->query($sql) === TRUE) {
        $last_id = getLastRecord($koneksi);
        echo ($last_id);
        // header("Location: ../index.php");
        exit();
    } else {
        echo "Error updating record: " . $koneksi->error;
    }
} elseif ($act == 'cancel') {

    $sql = "SELECT * FROM data_record  WHERE id_user = '" . $_POST['id_user'] . "' ORDER BY id_record DESC LIMIT 1";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);

    $cancelId = $row['id_record'];

    $sql = "DELETE FROM data_record WHERE id_record=" . $cancelId;
    if ($koneksi->query($sql) === TRUE) {
        echo "Success";
    } else {
        echo "Error deleting record: " . $koneksi->error;
    }
}  elseif ($act == 'delete') {  

    $sql = "DELETE FROM data_record WHERE id_record=" .  $_POST['id_record'];
    if ($koneksi->query($sql) === TRUE) {
        echo "Success";
        header("Location: ../data_record.php");
    } else {
        echo "Error deleting record: " . $koneksi->error;
    }
} 




$koneksi->close();
