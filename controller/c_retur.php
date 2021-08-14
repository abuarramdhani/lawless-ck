<?php
session_start();
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];
$pilihretur = $_POST["pilihretur"];

$kodeoutlet = $_SESSION['kodeoutlet'];

if (isset($keyword)) {

    if ($pilihretur == 'bahan') {
        $bahan = query("SELECT * FROM bahan WHERE (kodeoutlet = 'OUT002' AND hargaj NOT IN ('0')) AND namabahan LIKE '%$keyword%' ORDER BY id DESC ");
        echo json_encode($bahan);
    } elseif ($pilihretur == 'produk') {
        $bahan = query("SELECT * FROM produk WHERE harga NOT IN ('0') AND namaproduk LIKE '%$keyword%' ORDER BY id DESC ");
        echo json_encode($bahan);
    }
}
