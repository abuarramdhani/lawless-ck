<?php
$No_form = $_GET['No_form'];
$item_storeproduk = query("SELECT * FROM item_storeproduk as sp
    JOIN produk as p
    ON p.kodeproduk = sp.kodeproduk 
    WHERE sp.No_form = '$No_form'");

$detail = query("SELECT *
    FROM form_storeproduk as sp
    JOIN companypanel as cp
    ON sp.kodeoutlet = cp.kodeoutlet
    WHERE sp.No_form = '$No_form'")[0];


$sot = $detail['status_ot'];
$sck = $detail['status_ck'];
