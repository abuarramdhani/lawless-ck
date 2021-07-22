<?php
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];

if (isset($keyword)) {

    $bahan = query("SELECT * FROM bahan 
    WHERE  namabahan LIKE '%" . $keyword . "%' OR kodebahan like '%" . $keyword . "%'
    ORDER BY id DESC ");
    echo json_encode($bahan);
}
