<?php
require '../include/fungsi.php';
$keyword = $_POST["keyword_form-po"];


if (isset($keyword)) {

    $bahan = query("SELECT * FROM bahan WHERE hargaj NOT IN ('0') AND (namabahan LIKE '%$keyword%' OR kodebahan LIKE '%$keyword%') ORDER BY id DESC ");

    echo json_encode($bahan);
}
