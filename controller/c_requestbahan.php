<?php
// session_start();
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];
// $kodeoutlet = $_SESSION['kodeoutlet'];

if (isset($keyword)) {

    $bahan = query("SELECT * FROM barang as b LEFT JOIN unit as u ON b.unitbeli = u.kodeunit
    WHERE b.namabarang LIKE '%" . $keyword . "%' AND (b.kodeoutlet='OUT002' )
    ORDER BY b.id DESC ");
    // $bahan = query("SELECT * FROM produk 
    // WHERE kodeoutlet = '$kodeoutlet' AND (namabahan LIKE '%" . $keyword . "%' OR kodebahan like '%" . $keyword . "%')
    // ORDER BY id DESC ");
    echo json_encode($bahan);
}