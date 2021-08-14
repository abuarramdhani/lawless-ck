<?php
session_start();
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];
$kodeoutlet = $_SESSION['kodeoutlet'];

if (isset($keyword)) {

    $bahan = query("SELECT * FROM barang as b 
    JOIN unit as u ON b.unitjual = u.kodeunit
    WHERE (b.kodeoutlet = 'OUT002' AND b.hargajual1 NOT IN ('0')) AND (b.namabarang LIKE '%$keyword%' AND b.kategoribarang != 'KAB003' ) ORDER BY b.id DESC ");
    // $bahan = query("SELECT * FROM bahan WHERE (kodeoutlet = 'OUT002' AND hargaj NOT IN ('0')) AND (namabahan LIKE '%$keyword%' OR kodebahan LIKE '%$keyword%') ORDER BY id DESC ");

    echo json_encode($bahan);
}
