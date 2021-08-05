<?php
$No_form = $_GET['No_form'];
$item_produk = query("SELECT * FROM item_produkmasuk as pm 
    JOIN produk as p
    ON pm.kodeproduk = p.kodeproduk 
    WHERE pm.No_form = '$No_form'");

$detail = query("SELECT *
    FROM form_produkmasuk
    WHERE No_form = '$No_form'")[0];
