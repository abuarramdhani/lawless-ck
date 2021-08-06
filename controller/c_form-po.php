<?php
session_start();
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];
$kodeoutlet = $_SESSION['kodeoutlet'];

if (isset($keyword)) {

    $bahan = query("SELECT * FROM bahan as b
    JOIN unit as u
    ON b.unit = u.kodeunit
    -- WHERE kodeoutlet = '$kodeoutlet' AND (namabahan LIKE '%" . $keyword . "%' OR kodebahan like '%" . $keyword . "%')
    WHERE b.kodeoutlet = '$kodeoutlet' AND b.namabahan LIKE '%" . $keyword . "%'
    ORDER BY b.id DESC ");
    echo json_encode($bahan);
}
