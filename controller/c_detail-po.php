<?php
$No_form = $_GET['No_form'];
$item_po = query("SELECT * FROM item_po
JOIN barang ON item_po.kodebahan = barang.kodebarang
JOIN unit ON item_po.unit = unit.kodeunit
WHERE No_form = '$No_form'");

$detail = query("SELECT *
FROM form_po
JOIN supplier ON form_po.kodesupplier = supplier.kodesupplier
WHERE No_form = '$No_form'")[0];

// $sot = $detail['status_ot'];
// $sck = $detail['status_ck'];

// $status = $detail['status'];
$sot = $detail['status_ot'];
$sck = $detail['status_ck'];
