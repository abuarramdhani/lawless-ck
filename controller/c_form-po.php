<?php
session_start();
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];
$kodeoutlet = $_SESSION['kodeoutlet'];

if (isset($keyword)) {

    $bahan = query("SELECT * FROM bahan 
    -- WHERE kodeoutlet = '$kodeoutlet' AND (namabahan LIKE '%" . $keyword . "%' OR kodebahan like '%" . $keyword . "%')
    WHERE kodeoutlet = '$kodeoutlet' AND namabahan LIKE '%" . $keyword . "%'
    ORDER BY id DESC ");
    echo json_encode($bahan);
}
