<?php
$No_form = $_GET['No_form'];
$item_po = query("SELECT * FROM item_po
JOIN barang ON item_po.kodebahan = barang.kodebarang
JOIN unit ON item_po.unit = unit.kodeunit
WHERE item_po.No_form = '$No_form' AND item_po.kodeoutlet='OUT002'");

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
