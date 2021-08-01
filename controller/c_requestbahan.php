<?php
// session_start();
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];
// $kodeoutlet = $_SESSION['kodeoutlet'];

if (isset($keyword)) {

    $bahan = query("SELECT * FROM bahan 
    -- WHERE namaproduk LIKE '%" . $keyword . "%' OR kodeproduk like '%" . $keyword . "%'
    WHERE namabahan LIKE '%" . $keyword . "%' AND kodeoutlet='OUT002'
    ORDER BY id DESC ");
    // $bahan = query("SELECT * FROM produk 
    // WHERE kodeoutlet = '$kodeoutlet' AND (namabahan LIKE '%" . $keyword . "%' OR kodebahan like '%" . $keyword . "%')
    // ORDER BY id DESC ");
    echo json_encode($bahan);
}
