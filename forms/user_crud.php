<?php

include_once "../koneksi.php";

$act = $_POST['act'];
if ($act != 'add') {
    $id_user = $_POST['id'];

    if ($act == 'edit') {
        $sql = "UPDATE user SET nama='" . $_POST['nama'] . "', username='" . $_POST['username'] . "', password='" . $_POST['password'] . "', id_role=" . $_POST['id_role'] . " WHERE id_user=" . $id_user;
    } elseif ($act == 'delete') {
        $sql = "DELETE FROM user WHERE id_user=" . $id_user;
    }
} else {
    $sql = "INSERT INTO user (nama, username, password, id_role) VALUES ('" . $_POST['nama'] . "','" . $_POST['username'] . "','" . $_POST['password'] . "'," . $_POST['id_role'] . ")";
}

if ($act) {
    echo $sql;
    if ($koneksi->query($sql) === TRUE) {
        echo "Success";
        header("Location: ../users.php");
        exit();
    } else {
        echo "Error updating record: " . $koneksi->error;
    }

    $koneksi->close();
} else {
    echo 'request error : no_act';
}
