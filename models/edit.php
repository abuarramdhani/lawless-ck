<?php

require '../include/fungsi.php';
date_default_timezone_set('Asia/Jakarta');
$date = new DateTime();

if (isset($_POST["updateproyek"])) {
    //var_dump($_POST);
    $noproyek = htmlspecialchars($_POST["noproyek"]);
    $namaklien = htmlspecialchars($_POST["kodeklien"]);
    $outlet = htmlspecialchars($_POST["outlet"]);
    $tempat = htmlspecialchars($_POST["tempat"]);
    $nilaiproyek = htmlspecialchars($_POST["nilaiproyek"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $keterangan = htmlspecialchars($_POST["keterangan"]);

    $idp = query("SELECT id FROM proyek WHERE noproyek ='$noproyek'")[0];
    $idd = $idp['id'];

    $query = "UPDATE proyek SET
                namaklien = '$namaklien',
                outlet = '$outlet',
                tempat = '$tempat',
                pekerjaan = '$pekerjaan',
                keterangan = '$keterangan',
                nilaiproyek = '$nilaiproyek'
        WHERE id = $idd
    ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} else if (isset($_POST["updatemaintenance"])) {
    //var_dump($_POST);
    $noproyek = htmlspecialchars($_POST["noproyek"]);
    $namaklien = htmlspecialchars($_POST["kodeklien"]);
    $outlet = htmlspecialchars($_POST["outlet"]);
    $tempat = htmlspecialchars($_POST["tempat"]);
    $nilaiproyek = htmlspecialchars($_POST["nilaiproyek"]);
    $pekerjaan = htmlspecialchars($_POST["pekerjaan"]);
    $keterangan = htmlspecialchars($_POST["keterangan"]);

    $idp = query("SELECT id FROM maintenance WHERE noproyek ='$noproyek'")[0];
    $idd = $idp['id'];

    $query = "UPDATE maintenance SET
                namaklien = '$namaklien',
                outlet = '$outlet',
                tempat = '$tempat',
                pekerjaan = '$pekerjaan',
                keterangan = '$keterangan',
                nilaiproyek = '$nilaiproyek'
        WHERE id = $idd
    ";
    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {

        echo 3;
    } else {
        echo 1;
    }
} elseif (isset($_POST["updatemenu"])) {
    $id = $_POST['updatemenu'];
    $menu = $_POST['unama'];
    $url = $_POST['uurl'];

    // var_dump($url);
    $idmenu = query("SELECT id FROM user_menu WHERE id ='$id'")[0];
    $id = $idmenu['id'];

    $query = "UPDATE user_menu SET
                menu = '$menu',
                url = '$url'
        WHERE id = '$id'";

    $masuk_data = mysqli_query($conn, $query);
    if ($masuk_data) {
        echo 2;
    } else {
        echo 1;
    }
}
