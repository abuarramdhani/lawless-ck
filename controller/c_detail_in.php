<?php
$No_form = $_GET['No_form'];
$item_po = query("SELECT * FROM item_in 
    JOIN barang ON item_in.kodebahan = barang.kodebarang
JOIN unit ON item_in.unit = unit.kodeunit
    WHERE No_form = '$No_form'");

$detail = query("SELECT *
    FROM form_in
    JOIN supplier
    ON form_in.kodesupplier = supplier.kodesupplier
    WHERE No_form = '$No_form'")[0];
$sot = $detail['status_ot'];
$sck = $detail['status_ck'];

$grand_total =  query("SELECT sum(subtotal) as grand_total FROM item_in WHERE No_form = '$No_form' ")[0];
