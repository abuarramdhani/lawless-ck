<?php
$No_form = $_GET['No_form'];
$item_po = query("SELECT * FROM item_storebahan as isb
    JOIN barang as b ON isb.kodebahan = b.kodebarang 
    JOIN unit as u ON isb.unit = u.kodeunit
    WHERE isb.No_form = '$No_form' AND b.kodeoutlet='OUT002' ");

$detail = query("SELECT fsb.*,cp.nama
    FROM form_storebahan as fsb
    JOIN companypanel as cp
    ON fsb.kodeoutlet = cp.kodeoutlet
    WHERE fsb.No_form = '$No_form'")[0];

$sot = $detail['status_ot'];
$sck = $detail['status_ck'];
$grand_total =  query("SELECT sum(subtotal) as grand_total FROM item_storebahan WHERE No_form = '$No_form' ")[0];