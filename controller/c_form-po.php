<?php

$keyword = $_POST["keyword_form-po"];

if ($keyword) {

    $bahan = query("SELECT * FROM bahan 
    WHERE  namabahan='$keyword' or kodebahan='$keyword'
    ORDER BY id DESC ");
}
