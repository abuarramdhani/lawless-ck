<?php
$No_form = $_GET['No_form'];
// $item_storebahan = query("SELECT sp.*, p.namabarang, u.namaunit FROM item_storebahan as sp
//     JOIN barang as p ON p.kodebarang = sp.kodebahan 
//     JOIN unit as u ON sp.unit = u.kodeunit
//     WHERE sp.No_form = '$No_form'");

$detail = query("SELECT *
    FROM form_po as sp
    JOIN companypanel as cp
    ON sp.kodeoutlet = cp.kodeoutlet
    WHERE sp.No_form = '$No_form'")[0];
// $sot = $detail['status_ot'];
// $sck = $detail['status_ck'];

// $No_form = $_GET['No_form'];
$item_storebahan = query("SELECT * FROM item_po
JOIN barang ON item_po.kodebahan = barang.kodebarang
JOIN unit ON item_po.unit = unit.kodeunit
WHERE No_form = '$No_form'");

// $detail = query("SELECT *
// FROM form_po
// JOIN supplier ON form_po.kodesupplier = supplier.kodesupplier
// WHERE No_form = '$No_form'")[0];

// $sot = $detail['status_ot'];
// $sck = $detail['status_ck'];

// $status = $detail['status'];
$sot = $detail['status_ot'];
$sck = $detail['status_ck'];
