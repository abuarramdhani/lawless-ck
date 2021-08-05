<?php

if (isset($_POST['status'])) {
    $No_form = $_POST['No_form'];
    if (isset($_POST['sot'])) {
        $sot = $_POST['sot'] + 1;
        mysqli_query($conn, "UPDATE $tabel
        SET status_ot='$sot'
        WHERE No_form = '$No_form'");
    } elseif (isset($_POST['sck'])) {
        $sck = $_POST['sck'] + 1;
        mysqli_query($conn, "UPDATE $tabel
        SET status_ck='$sck' 
        WHERE No_form = '$No_form'");
    }
}
if (isset($_POST['status2'])) {
    $No_form = $_POST['No_form'];

    $status = $_POST['status'] + 1;
    mysqli_query($conn, "UPDATE $tabel
        SET status='$status'
        WHERE No_form = '$No_form'");
}
