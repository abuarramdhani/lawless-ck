<?php
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];

if (isset($keyword)) {

    $package = query("SELECT * FROM package WHERE namapackage LIKE '%$keyword%' ORDER BY id DESC ");
    // $bahan = query("SELECT * FROM bahan WHERE (kodeoutlet = 'OUT002' AND hargaj NOT IN ('0')) AND (namabahan LIKE '%$keyword%' OR kodebahan LIKE '%$keyword%') ORDER BY id DESC ");

    echo json_encode($package);
}
