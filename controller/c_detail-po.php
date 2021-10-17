<?php
$No_form = $_GET['No_form'];
$item_po = query("SELECT ip.*, b.namabarang, u.namaunit FROM item_po ip
JOIN barang b ON ip.kodebahan = b.kodebarang
JOIN unit u ON ip.unit = u.kodeunit
WHERE ip.No_form = '$No_form' AND b.kodeoutlet='OUT002'");

$detail = query("SELECT *
FROM form_po
JOIN supplier ON form_po.kodesupplier = supplier.kodesupplier
WHERE No_form = '$No_form'")[0];

// $sot = $detail['status_ot'];
// $sck = $detail['status_ck'];

// $status = $detail['status'];
$sot = $detail['status_ot'];
$sck = $detail['status_ck'];

$grand_total =  query("SELECT sum(subtotal) as grand_total FROM item_po WHERE No_form = '$No_form'")[0];
// var_dump($grand_total);
// die;
