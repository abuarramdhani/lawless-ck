<?php
$No_form = $_GET['No_form'];
$item_po = query("SELECT * FROM item_storebahan as isb
    JOIN bahan as b
    ON isb.kodebahan = b.kodebahan 
    WHERE isb.No_form = '$No_form'");

$detail = query("SELECT fsb.*,cp.nama
    FROM form_storebahan as fsb
    JOIN companypanel as cp
    ON fsb.kodeoutlet = cp.kodeoutlet
    WHERE fsb.No_form = '$No_form'")[0];

$sot = $detail['status_ot'];
$sck = $detail['status_ck'];
